
<h2 style=" color: #403333;font-size: 25px;letter-spacing: 0.3px;">Inscripción de cursos</h2>
  <hr>
  <table class="tabla">
    <thead>
    @if(!empty($data['name']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Nombre completo: <strong style="color: #846e6e;font-size: 26px;">{{ $data['name'] . ' ' . $data['lastname']}}</strong></h3><hr> </th>
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
    @if(!empty($data['course']))
      <tr style="text-align: left;">
          <th colspan="2"><h3 style="margin: 2px auto;">Curso: <strong style="color: #846e6e;font-size: 26px;">{{ $data['course'] }}</strong></h3><hr> </th>
      </tr>
    @endif
    </thead>
  </table>  

    DECLARO QUE HE LEÍDO Y ACEPTO LAS CONDICIONES DE TRATAMIENTO DE DATOS.

{{ config('app.name') }}