<?php

	namespace App\Shop;

	use App\Models\Cart as CartData;
	use App\Models\CartItem;
	use App\Models\Product;
	use App\Shop\Repositories\ProductRepository;
	use Illuminate\Support\Arr;
	/**
	 * 
	 */
	class Cart
	{
		
		protected $cart;
		protected $product;
		protected $cartItem;
	 
	  public function __construct(CartData $cart, CartItem $cartItem, Product $product) {
        $this->cart 		= $cart;
        $this->cartItem = $cartItem;
        $this->product 	= $product;
    }

		public function add($data){
			// $this->removeCart();dd('remove');			
			$product_id = $data['product'];

				// dd($data);	
			$cart = $this->getCart();
			if ($cart) {
				$ifExist = $this->checkIfItemExists($product_id);
				if ($ifExist) {
					$item = $this->cartItem->find($ifExist);				
					$result = $this->updateItem($ifExist, $data);
				}else{				
					$result = $this->createItem($product_id, $data);
				}				
			}else{
				 $result = $this->createAll($product_id, $data);
			}
			return $result;
		}
		
		public function createAll($product_id, $data){
			$cart_data = [];
			$cart_data['is_guest'] = 1;
			$cart_data['ip'] = request()->ip();
			$cart_data['session_id'] = session()->getId();
			$cart_data['last_activity'] = time();
			$result =  $this->cart->create($cart_data);
			$this->putCart($result);
			if ($result) {
				if($item = $this->createItem($product_id, $data)){
					return $item;
				}else{
					return false;
				}
			}
		}

		public function createItem($product_id, $data){
			$product = $this->product->where('codigo', $product_id)->first();
			$name_product = $product->nombre;
			$quantity = $data['quantity'];
			
			$product->quantity = $quantity;
			$product = (new ProductRepository)->prepareProduct($product);
			$price = $product->price - $product->tax_amount;

			$additional = [];

			$data_item = [
				'key' 							=> $product->codigo,
				'quantity' 					=> $quantity,
				'cart_id'						=> $this->getCart()->id,
				'name'							=> $name_product,
				'image' 						=> $product->image_main,
				'price'							=> $price,
				'base_price'				=> $price,
				'total'							=> $price * $quantity,
				'base_total'				=> $price * $quantity,
				'tax_percent'				=> $product->iva,
				'marca'							=> $product->marca,
				'tax_amount'				=> $product->tax_amount * $quantity,
				'base_tax_amount'		=> $product->tax_amount * $quantity,
				'weight'						=> $product->peso,
				'total_weight'			=> $product->peso * $quantity,
				'base_total_weight'	=> $product->peso * $quantity,
				'additional'				=> json_encode($additional),
				'product_id'				=> $product->codigo,
				'sku'								=> $product->SKU,
				'url_product'				=> route('product.view', $product->slug),
			];
			// dd($data_item);
		 	// $this->updateStockProduct($product_id, $quantity);
			$item = $this->cartItem->create($data_item);
			$this->updateLastActivity();
			return $item;
		}

		public function updateItem($item_id, $data, $action = 'product'){
		 	$item = $this->cartItem->find($item_id);
			$product = $this->product->where('codigo', $item->product_id)->first();
			$quantity = $data['quantity'];			
			if (!$product->haveSufficientStock($quantity)) {
        return false;
      }
    	// $this->updateStockProduct($product->codigo, $data['quantity']);
			$data['quantity'] += $item->quantity;
      $product->quantity = $quantity;
      $product = (new ProductRepository)->prepareProduct($product);
      $item->price = $product->price - $product->tax_amount;
      $item->discount_amount = $product->discount_amount;

			if ($action != 'cart') {
				$quantity += $item->quantity;
			}
      $result = $item->update([
      	'quantity'					=> $quantity,
      	'total'							=> $item->price * $quantity,
      	'base_total'				=> $item->price * $quantity,
      	'tax_amount'				=> $product->tax_amount * $quantity,
      	'base_tax_amount'		=> $product->tax_amount * $quantity,
      	'total_weight'			=> $item->weight * $quantity,
      	'base_total_weight' => $item->weight * $quantity
      ]);
      $this->collectTotals();
      return true;
		}

	 	public function removeItem($itemId) {
        if ($cart = $this->getCart()) {
            $item = $this->cartItem->find($itemId);
            // $this->updateStockProduct($item->product_id, -$item->quantity);
            $item->delete();
            //Eliminar el carrito sino hay mas items
            if ($cart->items()->get()->count() == 0) {
                $this->removeCart();
            }
            return true;
        }
        return false;
    }

		public function collectTotals(){
			if(!$cart = $this->getCart()){
				return false;
			}

			$cart->grand_total = $cart->base_grand_total = 0;
			$cart->sub_total = $cart->base_sub_total = 0;
			$cart->tax_total = $cart->base_tax_total = 0;

			foreach ($cart->items as $item) {
				$cart->grand_total += ($item->total + $item->tax_amount);
				$cart->base_grand_total += ($item->base_total + $item->base_tax_amount);
				$cart->sub_total += $item->total;
				$cart->base_sub_total += $item->base_total;
				$cart->tax_total += $item->tax_amount;
				$cart->base_tax_total += $item->base_tax_amount;
			}

			if ($cart->shipping_rate) {
				$cart->grand_total = (float) $cart->grand_total + $cart->shipping_rate;
				$cart->base_grand_total = (float) $cart->base_grand_total + $cart->shipping_rate;
			}

			$discount = 0;
			if($coupon = $this->hasCoupon()){
				if ($coupon->type_discount == 'percent') {
					$discount += ($coupon->discount * $cart->grand_total) / 100;
				}else{
					$discount += $coupon->discount;
				}
			}

			$cart->discount = $discount; 
			$cart->grand_total = $cart->grand_total - $discount;
			$quantities = 0;
			foreach ($cart->items as $item) {
				$quantities += $item->quantity;
			}

			$cart->items_count = $cart->items->count();
			$cart->items_qty 	 = $quantities;
			$cart->last_activity 	 = time();
			$cart->save();
		}

		public function updateStockProduct($product_id, $quantity){
			$this->product->where('codigo', $product_id)->increment('stock', ($quantity-1));
			$this->product->where('codigo', $product_id)->decrement('stock', $quantity);

			
		}

		public function checkIfItemExists($product_id){
			$items = $this->getCart()->items;
			foreach ($items as $item) {
				if ($product_id == $item->product_id) {
					return $item->id;
				}
			}
			return 0;
		}

		public function putCart($cart){
			session()->put('cart', $cart);
		}

		public function getCart(){
			$cart = false;
			if (session()->has('cart')) {
				$cart = $this->cart->with(['items', 'address'])->find(session()->get('cart')->id);
			}

			return $cart;
		}

		public function updateCart($data, $calculate = false){
			$cart = $this->cart->find(session()->get('cart')->id);
			$cart->fill($data);
			$cart->save();
			if ($calculate) {
				$this->collectTotals();
			}
		}

		public function totalWeight() {
        return $this->getCart()->items->sum('total_weight');
    }
    
		public function removeCart(){
			$cart = $this->getCart();
			if ($cart != null) {
				if($cart->address){
					$cart->address()->delete();
				}

				if($cart->items){
					$cart->items()->delete();
				}
				$cart->delete();

				if (session()->has('cart')) {
					session()->forget('cart');					
				}
				if (session()->has('coupon')) {
					session()->forget('coupon');					
				}
			}
		}

		public function setAddress($data_address){
			$cart = $this->getCart();
			if(!$cart->address){
				$address = $cart->address()->create($data_address);
			}else{
				// dd($cart->address->address);
				$cart->address()->update($data_address);
				$address = $cart->address;
			}
			$cart->update(['step' => 'shipping']);
			return $address;
		}

		public function forgetUserData() {
        $cart = $this->getCart();
        if ($cart->address) {
            $cart->address()->delete();
        }
        $data = [
            'customer_name' => null,
            'customer_mobile' => null,
            'customer_email' => null,
            'customer_document' => null,
            'customer_phone' => null,
        ];        
        $cart->update(['step' => 'cart']);
        $this->updateCart($data);
    }

		public function count() {
	 	 	if (isset($this->getCart()->items_qty)) {
	 	 			$this->updateLastActivity();
          return $this->getCart()->items_qty;        
      }
      return 0;	 		
		}

		public function exists() {
        return session()->has('cart');
    }

    public function setCoupon($coupon){
    	$this->updateCart(['coupon_code' => $coupon->code, 'has_coupon' => 1]);
    	session()->put('coupon', $coupon);
    	$this->collectTotals();
    }

    public  function removeCoupon(){
    	if (session()->has('coupon')) {
    		$this->updateCart(['coupon_code' => null, 'has_coupon' => 0]);
    		session()->forget('coupon');
    		$this->collectTotals();
    	}
    	return true;
    }

    public function hasCoupon(){
    	$coupon = null;
    	if (session()->has('coupon')) {
    		$coupon = session()->get('coupon');
    	}
    	return $coupon;
    }

    public function setShipping($carrier){
    	$cart = Cart::getCart();
    	$cart->shipping_method = $carrier->name;
  		$cart->store_pickup = 0;
    	$cart->info_store = null;
    	$cart->shipping_rate = $carrier->total;
    	$cart->step = 'payment';
    	$cart->save();
    	$this->collectTotals();
    	return true;
    }

    public function setStorePickup($text){
    	$cart = Cart::getCart();
    	$cart->shipping_method = 'Recogida en tienda';
    	$cart->shipping_rate = 0;
    	$cart->store_pickup = 1;
    	$cart->step = 'payment';
    	$cart->info_store = $text;
    	$cart->save();
    	$this->collectTotals();
    	return true;
    }

    public function setPaymentMethod($gateway){
    	$cart = Cart::getCart();
    	$cart->payment_method = $gateway['name'];
    	$cart->save();
    	return true;
    }

    public function hasError(){
    	if (!$this->getCart()) {
    		return true;
    	}
    	if (!$this->isItemsHaveSufficientQuantity()) {
    		return true;
    	}

    	return false;
    }

    public function isItemsHaveSufficientQuantity(){
    	foreach ($this->getCart()->items as $item) {
    		if(!$this->isItemHaveQuantity($item)){
    			return false;
    		}
    	}
    	return true;
    }

    public function isItemHaveQuantity($item){
    	$product =  $item->product;
    	if (!$product->haveSufficientStock($item->quantity)) {
    		return false;
    	}
    	return true;
    }

    public function prepareDataForOrder(){
    	$data = $this->toArray();
    	// dd($data);
    	$finalData = [
    		// 'reference'					=> core()->reference(),
    		'customer_email'		=> $data['customer_email'],
    		'customer_name'			=> $data['customer_name'],
    		'customer_document'	=> $data['customer_document'],
    		'customer_phone'		=> $data['customer_phone'],
    		'customer_mobile'		=> $data['customer_mobile'],
    		'customer_phone'		=> $data['customer_phone'],
    		'coupon_code'				=> $data['coupon_code'],
    		'shipping_method'		=> $data['shipping_method'],
    		'shipping_rate'			=> $data['shipping_rate'],
    		'payment_method'		=> $data['payment_method'],
    		'total_item_count'	=> $data['items_qty'],
    		'discount_amount'		=> $data['discount'],
    		'sub_total'					=> $data['sub_total'],
    		'tax_amount'				=> $data['tax_total'],
    		'grand_total'				=> $data['grand_total'],
    		'info_store'				=> $data['info_store'],
    		'address' 					=> Arr::except($data['address'], ['id', 'cart_id', 'name_address']),
    		'cart_id' 					=> $data['id'],
    	];
    	foreach ($data['items'] as $item) {
    			$finalData['items'][] = $this->prepareDataForOrderItem($item);
    	}

    	return $finalData;
    }

     public function prepareDataForOrderItem($data) {
        $finalData = [
        		'product'				=>  $this->product->find($data['product_id']),
            'name' 					=> $data['name'],
            'marca' 				=> $data['marca'],
            'image' 				=> $data['image'],
            'quantity' 			=> $data['quantity'],
            'tax_percent' 	=> $data['tax_percent'],
            'tax_amount' 		=> $data['tax_amount'],
            'price' 				=> $data['price'],
            'total' 				=> $data['total'],
            'total_weight' 	=> $data['total_weight']
        ];

        return $finalData;
    }

    public function toArray(){
    	$cart = $this->getCart();
    	$data = $cart->toArray();
    	$data['address'] = $cart->address->toArray();
    	$data['items'] = $cart->items->toArray();
    	return $data;
    }

    public function updateLastActivity(){
    	if($cart = $this->getCart()){
				$cart->last_activity = time();
				$cart->save();
			}
    }

		public function forgetFavorites() {
		 	if (session()->has('favorites')) {
		 			session()->forget('favorites');
		 	}		 		
		}
	}