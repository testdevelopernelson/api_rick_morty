<?php



namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {

 


    use AuthenticatesUsers;



    protected $redirectTo = '/account';


    public function __construct() {
        $this->middleware('guest', ['except' => 'logout']);

    }

    public function logout() {
        auth()->guard('web')->logout();
        return redirect('/');
    }

}

