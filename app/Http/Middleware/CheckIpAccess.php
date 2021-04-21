<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Ip;
use Illuminate\Support\Facades\Crypt;

class CheckIpAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         
       $ip = $this->getIp();
       $acceso = Ip::where('ip', $ip)->first();
       if(is_null($acceso)){ // Si la ip no está saca error
         return redirect()->route('admin.ip.not.valid');
       }

       if (!$acceso->state) {
          return redirect()->route('home');
       }
       
       return $next($request);
    }

    public function getIp(){
     foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
         if (array_key_exists($key, $_SERVER) === true){
             foreach (explode(',', $_SERVER[$key]) as $ip){
                 $ip = trim($ip); // just to be safe
                 if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                     return $ip;
                 }
             }
         }
     }
     return request()->ip(); // it will return server ip when no client ip found
 }
     // private function getIp() {

     //      if (!empty($_SERVER['HTTP_CLIENT_IP']))
     //                return $_SERVER['HTTP_CLIENT_IP'];
     //      if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
     //           return $_SERVER['HTTP_X_FORWARDED_FOR'];
     //      return $_SERVER['REMOTE_ADDR'];
     // }
}
