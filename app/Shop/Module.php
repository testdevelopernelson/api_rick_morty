<?php

namespace App\Shop;

use App\Models\City;
use App\Models\Module as TableModule;
use App\Modules\ShippingRange;
use App\Modules\Wompi;

class Module {


    public static function carriers($address) {
        $carrier = null;
        $address->data_city = City::where('id', $address->city_id)->with('state')->first();
        $dataModule = TableModule::carriers()->first();
        if ($dataModule) {
           $carrier = ShippingRange::calculate($dataModule, $address);
           // dd($carrier) ;
            if (!empty($carrier)) {
                $carrier['total_format'] = core()->currency($carrier['total']);
                $carrier['id'] = $dataModule->id;
                $carrier['is_free'] = isset($carrier['is_free']) ? $carrier['is_free'] : false;
                $dataCarriers = collect();
                $dataCarriers->push((object) $carrier);
                $carrier = (object) $carrier;
            }
        }  
        return $carrier;
    }

    //Obtener información de los medios de pago disponibles
    public static function gateways() {
        $module = TableModule::gateways()->select(['id', 'name', 'logo', 'description'])->first();
        return $module;
    }

    //Procesar un medio de pago en específico
    public static function gateway($code, $order) {
        $module = TableModule::where('id', $code)->first();
        $dataPayment = Wompi::getData($module, $order);
        return $dataPayment;
    }

    //Confirmar un pago
    public static function confirmPay($code) {
        $module = TableModule::whereCode($code)->first();

        if (!$module) {
            //El modulo no existe;
            return false;
        }
        //Llamar el método que confirma el pago
        $class = $module->getClass();
        $moduleClass = new $class;
        $moduleClass->setModule($module);
        return $moduleClass->confirm();

    }

    public static function processCarriers($dataCarriers) {
        $dataCarriers = $dataCarriers->sortBy('total')->values();
        $shippingFree = $dataCarriers->where('is_free', true)->first();
        if ($shippingFree) {
            $dataCarriers = $dataCarriers->filter(function ($value, $key) {
                if ($value->is_free == true) {
                    return true;
                }
            })->all();
        }
        return $dataCarriers;
    }

    public static function dispatch($event, $data) {

        $dataModule = TableModule::active()->get();

        foreach ($dataModule as $item) {
            $class = $item->getClass();

            $moduleClass = new $class;
            $moduleClass->setModule($item);
            if (isset($moduleClass->listen[$event])) {
                $methodName = $moduleClass->listen[$event];
                $moduleClass->{$methodName}($data);
            }

        }
    }

}