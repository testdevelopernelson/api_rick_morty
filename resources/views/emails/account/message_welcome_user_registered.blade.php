@component('emails.layouts.master')
    <h3 style="font-size: 20px; font-weight: 700; color: #8c8c8c; margin: 14px 0;">¡{{ config('app.name' )}} le da la bienvenida Señor(a) {{ $user->name }}!</h3><br>

    <p style="width: 100%;line-height: 21px;color: #333; font-size:16px;text-align: justify;">Gracias por registrarse en nuestra tienda, lo invitamos a comprar nuestros productos y aprovechar todas nuestras promociones.</p><br>
    

    <div style="width: 100%;position: relative;text-align: center;">
    	<a style="font-size: 16px; font-weight: 700; padding: 9px 9px; width: 17%; background-color: #0a51a1;color: #fff; margin: 0 0 14px 0; border-radius: 5px; text-align: center; text-decoration: none;" href="{{ route('home') }}" target="_blank">Ir a la tienda</a>
    </div>
@endcomponent