@php
    $message = '';
    if($errors->any()){
         foreach($errors->all() as $key => $error){
               $message .= '* ' .  $error .'\n';
         }
    }    
@endphp
@push('js')
@if (count($errors) > 0)        
  <script type="text/javascript">
     let id_form = '{{ $id_form }}';
     var errors = '{{ $message }}'
        swal({
              title: errors,
              type: "error",
              confirmButtonText: "Cerrar",
              confirmButtonColor: '#f98929'

     });
     var position = $("#"+id_form).offset().top - 150;
     $('html, body').animate( {scrollTop : position}, 1000 );
  </script>
@endif

@if ($send_form == 1)        
    <script type="text/javascript">
          let message_send = '{{ $message_send }}';
          swal({
              title: message_send,
              type: "success",
              confirmButtonText: "Cerrar",
              confirmButtonColor: '#f98929'
           })
    </script>
@elseif($send_form == -1)
     <script type="text/javascript">
        swal({
              title:'{{ __('messages.invalid_recaptcha') }}',
              type: "error",
              confirmButtonText: "Cerrar",
              confirmButtonColor: '#f98929'
           })
    </script>
@endif

<script>
     let action = '{{ $action }}';
     grecaptcha.ready(function () {
        grecaptcha.execute('{{  config('settings.recaptcha_key_site') }}', {
            action : action
        }).then(function(token){
              if(token){
                   document.getElementById('recaptcha').value = token;
              }
         });

        
     });

     //Every 90 Seconds
    setInterval(function () {
       grecaptcha.ready(function () {
          grecaptcha.execute('{{  config('settings.recaptcha_key_site') }}', {action: action}).then(function (token) {
             document.getElementById('recaptcha').value = token;
          });
        });
    }, 90 * 1000);
  </script>
@endpush