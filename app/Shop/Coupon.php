<?php

namespace App\Shop;

use App\Models\Coupon as CouponData;
use Cart;

class Coupon
{
	protected $coupon;
	private $message;

	function __construct(CouponData $coupon)
	{
			$this->coupon = $coupon;
	}

	public function redeem($code){
		$coupon = $this->coupon->whereCode($code)->first();

		if (!$coupon) {
			$this->message = 'Ingrese un cupón válido';
			return false;
		}

		if (!$coupon->isActive()) {
			$this->message = 'Este cupón se encuentra desactivado';
			return false;
		}

		if($coupon->limited){
			if($coupon->quantity_redeem == $coupon->quantity){
				$this->message = 'El cupón ya no está disponible';
				return false;
			}
		}

		if($coupon->customer_id){
			if(!auth()->check()){
				$this->message = 'Debe iniciar sesión para usar el cupón';
				return false;
			}
			if (auth()->user()->id != $coupon->customer_id) {
				$this->message = 'No puede hacer uso de este cupón';
				return false;
			}
		}

		$cart = Cart::getCart();

		if($cart->grand_total < $coupon->min_amount){
			$this->message = 'El valor mínimo de compra para este cupón es de ' . core()->currency($coupon->min_amount);
			return false;
		}

		if($cart->items_qty < $coupon->min_quantity){
			$this->message = 'La cantidad mínima de productos para este cupón es de ' . $coupon->min_quantity;
			return false;
		}

		Cart::setCoupon($coupon);

		$this->message = 'Se aplicó el cupón correctamente';
		return true;

	}

	public function getMessage(){
		return $this->message;
	}
}