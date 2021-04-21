<?php 

namespace App\Modules;

class Wompi {
	

	public static function getData($module, $order) {
				$urlWompi= "https://checkout.wompi.co/p/";
        $params = (object) $module->settings; 
        $confirmationUrl = route('confirm_pay');
        $test = $params->test;
        $amount = intval(str_replace(".", "", $order->grand_total));
        $public_key = $test ? $params->key_test : $params->key_prod;
        $dataWompi = array(
            'public-key' => $public_key,
            'reference' => $order->id,
            'amount-in-cents' => $amount,
            'currency' => 'COP',
            'redirect-url' => $confirmationUrl,
        );
        $urlPay = $urlWompi;
        $data['type'] = 'checkout';
        $data['url_pay'] = $urlPay;
        $data['fields'] = $dataWompi;
        return $data;
    }
	
}