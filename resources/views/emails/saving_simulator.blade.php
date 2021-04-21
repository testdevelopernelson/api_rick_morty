<h2 style=" color: #403333;font-size: 25px;letter-spacing: 0.3px;">Simulador de ahorro ({{ $data['product'] }})</h2>
  <hr>
<table class="tabla">
    <thead>
    @if(!empty($data['name']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Nombre completo: <strong style="color: #846e6e;font-size: 26px;">{{ $data['name'] . ' ' . $data['lastname'] }}</strong></h3><hr> </th>
      </tr>
    @endif  
    @if(!empty($data['document']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Número de identificación: <strong style="color: #846e6e;font-size: 26px;">{{ $data['document'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['email']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Correo: <strong style="color: #846e6e;font-size: 26px;">{{ $data['email'] }}</strong></h3><hr> </th>
      </tr>
    @endif   
    @if(!empty($data['phone']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Teléfono: <strong style="color: #846e6e;font-size: 26px;">{{ $data['phone'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['mobile']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Celular: <strong style="color: #846e6e;font-size: 26px;">{{ $data['mobile'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['agency']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Agencia: <strong style="color: #846e6e;font-size: 26px;">{{ $data['agency'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['value']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">{{ !empty($data['period']) ? 'Capital' : 'Cuota mensual' }}: <strong style="color: #846e6e;font-size: 26px;">${{ number_format($data['value'], 0, ',', '.') }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['period']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Período de liquidación de intereses: <strong style="color: #846e6e;font-size: 26px;">{{ $data['period'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['term']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Plazo: <strong style="color: #846e6e;font-size: 26px;">{{ $data['term'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    </thead>
</table>   
DECLARO QUE HE LEÍDO Y ACEPTO LAS CONDICIONES DE TRATAMIENTO DE DATOS.
<br><br>
{{ config('app.name') }}