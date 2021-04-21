<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth; 

class Authenticate extends Middleware
{

    
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }

        if(Auth::check()){ 
            if(Auth::user()->change_password && request()->route()->getName() != 'account.change_password'){
                return redirect()->route('account.change_password');
            }
        }


    }
}
