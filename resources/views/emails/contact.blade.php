<h2 style=" color: #403333;font-size: 25px;letter-spacing: 0.3px;">Mensaje de contacto</h2>
  <hr>
<table class="tabla">
    <thead>
     @if(!empty($data['cooperative_relation']))
     <tr style="text-align: left;">
         <th colspan="2"><h3 style="margin: 2px auto;">Relación con la cooperativa: <strong style="color: #846e6e;font-size: 26px;">{{ $data['cooperative_relation'] }}</strong></h3><hr> </th>
     </tr>
   @endif
    @if(!empty($data['name']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Nombre completo: <strong style="color: #846e6e;font-size: 26px;">{{ $data['name'] . ' ' . $data['lastname'] }}</strong></h3><hr> </th>
      </tr>
    @endif   
    @if(!empty($data['type_document']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Tipo de documento: <strong style="color: #846e6e;font-size: 26px;">{{ $data['type_document'] }}</strong></h3><hr> </th>
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
    @if(!empty($data['reason_contact']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Motivo de contacto: <strong style="color: #846e6e;font-size: 26px;">{{ $data['reason_contact'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['city']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Ciudad: <strong style="color: #846e6e;font-size: 26px;">{{ $data['city'] }}</strong></h3><hr> </th>
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