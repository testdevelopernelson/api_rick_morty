<h2 style=" color: #403333;font-size: 25px;letter-spacing: 0.3px;">PQRS</h2>
  <hr>
<table class="tabla">
    <thead>
     @if(!empty($data['type_request']))
     <tr style="text-align: left;">
         <th colspan="2"><h3 style="margin: 2px auto;">Tipo de solicitud: <strong style="color: #846e6e;font-size: 26px;">{{ $data['type_request'] }}</strong></h3><hr> </th>
     </tr>
   @endif
    @if(!empty($data['name']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Nombre completo: <strong style="color: #846e6e;font-size: 26px;">{{ $data['name'] . ' ' .   $data['lastname']}}</strong></h3><hr> </th>
      </tr>
    @endif   
    @if(!empty($data['document']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">{{ $data['type_document']}}: <strong style="color: #846e6e;font-size: 26px;">{{ $data['document'] }}</strong></h3><hr> </th>
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
    @if(!empty($data['address']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Dirección: <strong style="color: #846e6e;font-size: 26px;">{{ $data['address'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['vinculo']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Tiene vínvulo con la cooperativa: <strong style="color: #846e6e;font-size: 26px;">{{ $data['vinculo'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['reply_by']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Recibir respuesta por: <strong style="color: #846e6e;font-size: 26px;">{{ $data['reply_by'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['department']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Departamento - Ciudad: <strong style="color: #846e6e;font-size: 26px;">{{ $data['department'] . ' - ' . $data['city'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['message']))
         <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Perfil: <strong style="color: #846e6e;font-size: 26px;">{{ $data['message'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    </thead>
</table>   
    DECLARO QUE HE LEÍDO Y ACEPTO LAS CONDICIONES DE TRATAMIENTO DE DATOS.
     <br><br>
{{ config('app.name') }}