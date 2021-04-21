<h2 style=" color: #403333;font-size: 25px;letter-spacing: 0.3px;">Trabaja con nosotros</h2>
  <hr>
<table class="tabla">
    <thead>
     @if(!empty($data['position']))
     <tr style="text-align: left;">
         <th colspan="2"><h3 style="margin: 2px auto;">Cargo al que aspira: <strong style="color: #846e6e;font-size: 26px;">{{ $data['position'] }}</strong></h3><hr> </th>
     </tr>
   @endif
    @if(!empty($data['name']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Nombre completo: <strong style="color: #846e6e;font-size: 26px;">{{ $data['name'] . ' ' .   $data['lastname']}}</strong></h3><hr> </th>
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
    @if(!empty($data['birthdate']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Fecha de nacimiento: <strong style="color: #846e6e;font-size: 26px;">{{ $data['birthdate'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['civil_status']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Estado civil: <strong style="color: #846e6e;font-size: 26px;">{{ $data['civil_status'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['vinculo']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Tiene vínvulo con la cooperativa: <strong style="color: #846e6e;font-size: 26px;">{{ $data['vinculo'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['experience']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Tiene experiencia laboral: <strong style="color: #846e6e;font-size: 26px;">{{ $data['experience'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['department']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Departamento - Ciudad: <strong style="color: #846e6e;font-size: 26px;">{{ $data['department'] . ' - ' . $data['city'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['scholarship']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Nivel de escolaridad: <strong style="color: #846e6e;font-size: 26px;">{{ $data['scholarship'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    @if(!empty($data['training']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Formación en: <strong style="color: #846e6e;font-size: 26px;">{{ $data['training'] }}</strong></h3><hr> </th>
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