<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ShopServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cart', function ($app){
            return new \App\Shop\Cart(
                $app->make('\App\Models\Cart'),
                $app->make('\App\Models\CartItem'),
                $app->make('\App\Models\Product'),
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
