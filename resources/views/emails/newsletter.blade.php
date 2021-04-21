
<h2 style=" color: #403333;font-size: 25px;letter-spacing: 0.3px;">Mensaje de suscripción al boletín</h2>
  <hr>
  <table class="tabla">
    <thead>
    @if(!empty($data['email']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Correo: <strong style="color: #846e6e;font-size: 26px;">{{ $data['email'] }}</strong></h3><hr> </th>
      </tr>
    @endif 
    </thead>
  </table>   

{{ config('app.name') }}