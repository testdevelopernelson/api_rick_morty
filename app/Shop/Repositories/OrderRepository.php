<?php

namespace App\Shop\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OrderRepository{

	protected $modelOrder;
	protected $user;
	protected $coupon;

	public function __construct(Order $order, OrderItem $order_item, User $user, Coupon $coupon){
		$this->modelOrder = $order;
		$this->orderItem = $order_item;
		$this->user = $user;
		$this->coupon = $coupon;
	}

	public function create(array $data){
		DB::beginTransaction();
		try {
			$data['status_id'] = 1;
			$data['ip'] = request()->ip();
			$data['customer_id'] = auth()->user()->id;
			$reference = $this->modelOrder::max('reference');
			if ($reference == null) {
				$reference = 100000;
			}else{
				$reference++;
			}
			$data['reference'] = $reference;
			if (!empty($data['coupon_code'])) {
				$coupon = $this->coupon->whereCode($data['coupon_code'])->first();
				$coupon->quantity_redeem++;
				$coupon->save();
			}

			$order = $this->modelOrder->create($data);
			$order->address()->create($data['address']);
			foreach ($data['items'] as $item) {
				 $orderItem = $this->createItem(array_merge($item, ['order_id' => $order->id]));
			}
		}catch (Exception $e) {
			 	DB::rollBack();
        throw $e;
		}
		DB::commit();
		return $order;
	}

	public function createItem(array $data){
		 	if (isset($data['product']) && $data['product']) {
          $data['codigo_product'] = $data['product']->codigo;
          $data['sku'] = $data['product']->SKU;
          $data['url_product'] = route('product.view', $data['product']->slug);
          unset($data['product']);
      }

       return $this->orderItem->create($data);
	}
}