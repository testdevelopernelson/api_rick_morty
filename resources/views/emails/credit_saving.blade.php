<h2 style=" color: #403333;font-size: 25px;letter-spacing: 0.3px;">Mensaje de la sección {{ $data['section'] == 'credit' ? 'Crédito' : 'Ahorro' }}</h2>
  <hr>
<table class="tabla">
    <thead>
    @if(!empty($data['name']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Nombre completo: <strong style="color: #846e6e;font-size: 26px;">{{ $data['name'] . ' ' . $data['lastname'] }}</strong></h3><hr> </th>
      </tr>
    @endif   
    @if(!empty($data['email']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Correo: <strong style="color: #846e6e;font-size: 26px;">{{ $data['email'] }}</strong></h3><hr> </th>
      </tr>
    @endif   
    @if(!empty($data['phone']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Teléfono / Celular: <strong style="color: #846e6e;font-size: 26px;">{{ $data['phone'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['department']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Departamento - Ciudad: <strong style="color: #846e6e;font-size: 26px;">{{ $data['department'] . ' - ' . $data['city'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['message']))
         <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Mensaje: <strong style="color: #846e6e;font-size: 26px;">{{ $data['message'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    </thead>
</table>   
    DECLARO QUE HE LEÍDO Y ACEPTO LAS CONDICIONES DE TRATAMIENTO DE DATOS.
     <br><br>
{{ config('app.name') }}