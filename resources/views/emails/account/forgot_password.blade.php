@component('emails.layouts.master')
    <h3 style="font-size: 20px; font-weight: 700; color: #8c8c8c; margin: 14px 0;">Hola {{ $user->name }}!</h3>

    <h2 style="width: 100%;text-align: center;color: #0a51a1; font-size:16px;">Esta es la contraseña temporal para  {{ config('app.name' )}}</h2>

    <p style="text-align: center;font-size: 25px;font-weight: 600; color: #5e5f6b;">{{ $password_temporary }}</p>

    <p style="font-size: 16px;color: #000">Cuando ingrese a la tienda, inicie sesión utilizando esta contraseña, después se le pedirá cambiar la contraseña por una que recuerde fácilmente.</p>

    <div style="width: 100%;position: relative;text-align: center;">
    	<a style="font-size: 16px; font-weight: 700; padding: 9px 9px; width: 17%; background-color: #0a51a1;color: #fff; margin: 0 0 14px 0; border-radius: 5px; text-align: center; text-decoration: none;" href="{{ route('login') }}" target="_blank">Iniciar sesión aquí</a>
    </div>
@endcomponent