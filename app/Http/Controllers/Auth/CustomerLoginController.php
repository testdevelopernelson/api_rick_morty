<?php 

namespace App\Http\Controllers\Auth;

use App\Events\UpdateLastLogin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class CustomerLoginController extends Controller{

	 	public function login() {
        $credentials = request()->all();
        if (Auth::attempt($credentials)) {
        	$user = Auth::user();
          $user->assignRole('Guest');
        	event(new UpdateLastLogin($user));
          return response()->json(['status' => true]);
        }
        return response()->json(['status' => false, 'message' => 'Correo y/o contraseña incorrectos'], 422);
    }
}