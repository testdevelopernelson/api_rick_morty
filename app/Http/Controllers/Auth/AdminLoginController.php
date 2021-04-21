<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use DateTime;

class AdminLoginController extends Controller {

    use AuthenticatesUsers;

    protected $redirectTo = '/admin/sections';
    protected $loginPath = '/admin';
    public $maxOportunity = 3; //3 Intentos fallidos bloquea
    public $timeBlocked = 10;


    public function __construct() {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function showLoginForm() {
        // $admin = Admin::whereEmail('nelson@webcreativa.com.co')->first();
        // $admin->password = 'admon7';
        // $admin->save();
        // dd('actualizado');
        $activedTimeout = false;
        $timeLeft = '';
        session()->forget('login.timeout');
        if (session()->has('login.timeout')) {
            $activedTimeout = true;
            $timeout = session()->get('login.timeout');
            $timenow = new DateTime();
            $intervalo = $timeout->diff($timenow);
            $minutes = $this->timeBlocked - $intervalo->format('%i');
            $timeLeft = 'Superó el intento máximo para ingresar, tiempo restante para volver a Intentarlo: ' . $minutes . ' Minuto(s)';
            if ($minutes == 0) {
                session()->forget('login.timeout');
                $activedTimeout = false;
            } 
        }       
        return view('auth.admin_login', compact('activedTimeout', 'timeLeft'));
    }


    public function login(Request $request) {
        // Validate the form data

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);   
        // Log in administrador
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::guard('admin')->user();

            if (!$user->active) {
                Auth::guard('admin')->logout();
                 return redirect()->back()->with('data_invalid', 'El usuario no está activo');
            }
            //Datos validos redirigir dashboard
            // $user = Auth::guard('admin')->user();
            // $user->assignRole('search');
            date_default_timezone_set('America/Bogota');
            Admin::find($user->id)->update(['last_login' => date('Y-m-d H:i:s'), 'last_ip' => request()->ip()]);
            setcookie("login_admin", "ok");
            return redirect()->route('sections.index');
        }        
        // 
        $attempts = session()->get('login.attempts', $this->maxOportunity); // obtener intentos, default: 0
        if (!session()->has('login.timeout')) {
            if ($attempts > 1) {
                session()->put('login.attempts', $attempts - 1); // incrementrar intentos 
                return redirect()->back()->with(['data_invalid'=> 'Correo y/o contraseña inválidos', 'attempts' => 'intentos disponibles  ' . ($attempts-1)]);           
            }else{
                session()->forget('login.attempts');
                session()->put('login.timeout',  new DateTime());
                return redirect()->back(); 
            }
        }
        
        return redirect()->back()->with('data_invalid', 'Correo y/o contraseña inválidos.');

    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function admin_errors(){
         return view('auth.admin_errors');
    }
}

