<?php

namespace App\Modules;

use Cart;

class ShippingRange
{		

	public static function calculate($module, $address){
			$settings = (object) $module->settings;
		 	$state = $address->data_city->state->name;
      $city = $address->data_city->name;
			$records_shipping= self::parse_data($settings->rate);
      $weight = Cart::totalWeight();
			foreach ($records_shipping as $key => $item) {
				 $shipping = explode('|', $item);
				 if ($weight >= $shipping[0]) {
				 		if ($shipping[1] == 0) {
                if (isset($shipping[3])) {
                    if (stripos($city, $shipping[3]) !== false) {
                        $total_rate = $shipping[2];
                        break;
                    }
                } else {
                    $total_rate = $shipping[2];
                    break;
                }
            } elseif ($weight <= $shipping[1]) {
                if (isset($shipping[3])) {
                    if (stripos($city, $shipping[3]) !== false) {
                        $total_rate = $shipping[2];
                        break;
                    }
                } else {
                    $total_rate = $shipping[2];
                    break;
                }
            }

				 }
			}
      // dd($total_rate);
		 	$data = [];
      if (!empty($total_rate)) {
          $data['total'] = $total_rate;
          $data['name'] = $module->name;
          $data['description'] = $settings->info;
      }

      return $data;
	}

	private static function parse_data($data) {
        $lines = [];
        foreach (preg_split("/((\r?\n)|(\r\n?))/", $data) as $line) {
            $lines[] = $line;
        }
        return $lines;

    }
}