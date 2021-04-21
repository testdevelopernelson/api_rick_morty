<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\UpdateLastLogin::class => [
            \App\Listeners\UpdateLastLogin::class
        ],
        \App\Events\UserRegistered::class => [
            \App\Listeners\UserRegistered::class
        ], 
        \App\Events\ChangeStatusDevolution::class => [
            \App\Listeners\ChangeStatusDevolution::class,
        ],
         \Illuminate\Auth\Events\Logout::class => [
            \App\Listeners\LogoutUser::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
