<?php

	namespace App\Shop;

  use Illuminate\Support\Str;

	class Core{

		public function currency($amount = 0) {
        if (is_null($amount)) {
            $amount = 0;
        }
        return '$' . number_format($amount, 0, null, '.');
    } 

    public function reference(){
    	return strtoupper(Str::random(2) . rand(1000, 999999));
    }
	}