

$(document).ready(function (){
     if (window.history.replaceState) { // verificamos disponibilidad
          window.history.replaceState(null, null, window.location.href);
     }     
    setTimeout(function() {$('.loader-vuejs').fadeOut()}, 1500);

    $('.form-load').submit(function (event){
          $('.loader').fadeIn();
    });

     $('.max-lenght').keypress(function(event) {
          let length = $(this).val().length;
          if (length <= 300) {
               if (length > 250) {
               $('.message-maxlength').fadeIn()        
               $('#length').text(300-length);
               }else{
               $('.message-maxlength').fadeOut()
               }
          }else{
          return false;
          }
     });
    
     $('.validate-characteres').keypress(function(event){
          let charCode = event.charCode;
          let array = [13,16,32,33,40,41,44,46,49,58,63,64,161,168,186,191,192,209,239,241];
          if((charCode >= 48 && charCode <= 57) || (charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122) || ($.inArray(charCode, array ) != -1)){
               return true;
          }else{
               return false;
          }
     });

     $(".validate-characteres").on('paste', function(e){
          e.preventDefault();
          return false;
     })

     $('.only-number').mask("#", {reverse: true});

     $('#btnSendContact').click(function(event) {
          if(validateInput($('#cooperative_relation')) & validateInput($('#name')) & validateInput($('#lastname')) & validateInput($('#type_document')) & validateInput($('#document')) & validateInput($('#email'))  & validateEmail($('#email'))  & validateInput($('#mobile'))  &  validateInput($('#cities')) &  validateInput($('#reason_contact')) ){  
               $('#formContact').submit();
          }
     });

     function validateInput(object){
          let valid = true;
          if(object.val() == '' || object.val() == null){
               valid = false;
               object.removeClass('is-valid1');
               object.addClass('not-valid');
          }else{               
               object.removeClass('not-valid');
               object.addClass('is-valid1');
          }
          return valid;
     } 

     function validateRadio(object){
          let valid = true;
          if (!object.is(':checked')){
               valid = false;
               object.removeClass('is-valid1');
               object.addClass('not-valid')
          }else{
                object.removeClass('not-valid');
                object.addClass('is-valid1');
          }
          return valid;
     }

     function validateFile(object){
          let valid = true;
          if(object.val() == '' || object.val() == null){
               valid = false;
               object.removeClass('is-valid1');
               object.addClass('not-valid');
          }else{
               var file = object.val();
               var fileSize = object[0].files[0].size;
               var sizeMegaBytes = (fileSize / 1024) / 1024;
               title_swal = '';
               if (sizeMegaBytes > 3) {
                    title_swal = size_file + '\n';
               }
               var ext = file.slice((file.lastIndexOf(".") - 1 >>> 0) + 2);
               var array = ['pdf', 'PDF', 'doc', 'DOC', 'docs', 'DOCS', 'docx', 'DOCX', 'jpg', 'jpeg']
               if (jQuery.inArray( ext, array) == -1) {
                  title_swal = mimes_file + '\n'; 
               }
               if (title_swal != '') {
                    swal({
                       title:title_swal,
                       type: "error",
                       confirmButtonText: "Cerrar",
                       confirmButtonColor: '#f98929'
                     });
                  object.val('');
                  valid = false;
                  object.removeClass('is-valid1');
                  object.addClass('not-valid');
               }else{
                    object.removeClass('not-valid');
                    object.addClass('is-valid1');
               }
          }
          return valid;
     }

     function validateFiles(object){
        let colorBtn = '#f98929';
        let valid = true;
        var array = ['pdf', 'PDF', 'doc', 'DOC', 'docs', 'DOCS', 'docx', 'DOCX', 'jpg', 'JPG', 'jpeg'];
        let size = 0;
        let title_swal = '';
        var files = object.get(0).files;
        var quantity = object.get(0).files.length;
        if (quantity <= 3) {
          for (var i = 0; i < quantity; ++i) {
                var fileSize = object.get(0).files[i].size;
                var fileName = object.get(0).files[i].name;        
                var ext = fileName.slice((fileName.lastIndexOf(".") - 1 >>> 0) + 2);
                var number = (fileSize / 1024) / 1024;
                size =   parseFloat(number.toFixed(3));
                if (jQuery.inArray( ext, array) == -1) {
                 title_swal += mimes_file  + ' => ' + object.get(0).files[i].name + '\n'; 
                }
                if (size > 2) {
                  title_swal +=size_file_pqrs + ' => ' + object.get(0).files[i].name + '\n'; 
                }
            }
          }else{
            title_swal += max_file_pqrs;
          }
          
       // console.log(size_uploads_total);
        if (title_swal != '') {
           swal({
              title:title_swal,
              type: "error",
              confirmButtonText: "Cerrar",
              confirmButtonColor: colorBtn

            });
           $('#files').val('');
          size_perfil = 0;
          valid = false;
        }
        return valid;
     }

     function validateEmail(object){
          let valid = true;
          if(!isValidEmail(object.val())){
            valid = false;
            object.removeClass('is-valid1');
            object.addClass('not-valid');
            }else{
              object.removeClass('not-valid');
              object.addClass('is-valid1');
            }
            return valid;
     }

     function validateNumber(object){
          let valid = true;
          if(isNaN(object.val())){
            valid = false;
            object.removeClass('is-valid1');
            object.addClass('not-valid');
            }else{
              object.removeClass('not-valid');
              object.addClass('is-valid1');
            }
            return valid;
     }

     function validateCheck(object){
          let valid = true;
          if(!object.prop('checked')){
            valid = false;
            object.removeClass('is-valid1');
            object.addClass('not-valid');
            }else{
              object.removeClass('not-valid');
              object.addClass('is-valid1');
            }
            return valid;
     }

     $('#email_newsletter').keyup(function(event) {
          if(event.which === 13){
            sendNewsletter();       
           }
       });

       $("#send_newsletter").click(function(event) {
          sendNewsletter();  
     })

     function sendNewsletter(){
               var email = $('#email_newsletter').val();
               let colorBtn = '#f98929';
               message = '';
               if(email == ''){
                    message = required_email;
               }else if(!isValidEmail(email)){
               message = email_invalid;
               }
               if(message == ''){
               //if(seguir == 1){
               $.ajax({
               url : baseRoot +'/send-newsletter',
               type : 'GET',
               dataType : 'json',
               data : {email : email},
               beforeSend: function () {
                    $('.loader').fadeIn();
                    },
               success : function(response){
                    $('#email_newsletter').val('');
                    $('.loader').fadeOut();
                    if (response.status == 1) {
                         swal({
                         title: title_envio_newsletter,
                         type: "success",
                         confirmButtonText: "Cerrar",
                         confirmButtonColor: colorBtn

                         });
                    }else if(response.status == -1){
                         swal({
                         title: title_registered_mail,
                         type: "error",
                         confirmButtonText: "Cerrar",
                         confirmButtonColor: colorBtn

                         });
                    }else{
                         swal({
                         title: title_error,
                         type: "error",
                         confirmButtonText: "Cerrar",
                         confirmButtonColor: colorBtn

                         });
                    }
               }    
               });
               } else{
               swal({
                    title: message,
                    type: "error",
                    confirmButtonText: "Cerrar",
                    confirmButtonColor: colorBtn

               });
          } 
     } 
       

  
     function isValidEmail(mail){
          return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(mail);
     }
      
      
});
      
      
      
      
      