<?php 

namespace App\Shop\Repositories;

use Cart;

class UserRepository
{
	
	public static function fillUserCart($user){
		$data = [
			'customer_name' => $user->name,
			'customer_email' => $user->email,
			'customer_document' => $user->document,
			'customer_phone' => $user->phone,
			'customer_mobile' => $user->mobile,
		];
		Cart::updateCart($data);
		$address = $user->address()->with(['state', 'city'])->principal();
		// dd($address);
		if(!empty($address)){
			 	$dataAddress = [
            'name_address' => $address->name_address,
            'address' => $address->address,
            'complement' => $address->complement,
            'state_id' => $address->state_id,
            'state' => $address->state->name,
            'city_id' => $address->city_id,
            'city' => $address->city->name,
            'name_person' => $address->name_person,
        ];
 		Cart::setAddress($dataAddress);
		}
	}
}
