<h2 style=" color: #403333;font-size: 25px;letter-spacing: 0.3px;">Simulador de crédito ({{ $data['type_credit'] }})</h2>
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
    @if(!empty($data['warranty']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Tipo de garantía: <strong style="color: #846e6e;font-size: 26px;">{{ $data['warranty'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['ocupation']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Ocupación: <strong style="color: #846e6e;font-size: 26px;">{{ $data['ocupation'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['way_to_pay']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Forma de pago: <strong style="color: #846e6e;font-size: 26px;">{{ $data['way_to_pay'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['variable_calculate']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Variable a calcular: <strong style="color: #846e6e;font-size: 26px;">{{ $data['variable_calculate'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['value_credit']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Valor del crédito: <strong style="color: #846e6e;font-size: 26px;">{{ number_format($data['value_credit'], 0, ',', '.') }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['monthly_fee']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Cuota mensual: <strong style="color: #846e6e;font-size: 26px;">{{ number_format($data['monthly_fee'], 0, ',', '.') }}</strong></h3><hr> </th>
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