@extends('layouts.master')
@push('css')
     <link rel="stylesheet" href="{{ asset('mng/css/jquery.ui.css') }}">
     <link rel="stylesheet" href="{{ asset('mng/css/jquery-ui-timepicker-addon.css') }}">
     <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@endpush
@section('content')
	
@include('_partials.banner')

<div class="cont_ly1">
     <div class="container_sd">

          <div class="cont_bleft_w">
               <div class="cont_bleft">
                    {!! $section->contents[1]->text_1 !!}                    
                    <a class="active" >{{ __('menu.work_us') }}</a>
               </div>
               <div class="cont_bleft_btn"><div class="icon nav-icon-6"><span></span><span></span><span></span></div></div>
          </div>
          <div class="cont_bcenter cont_bcenter_ca">
               {!! $section->contents[2]->text_1 !!} 
          <div class="b_contactr">
               <div class="cntar_form">
                    <form action="{{ url()->current() }}" id="formWorkUs" class="form-load"  method="POST" enctype="multipart/form-data">
                         {{ csrf_field() }}
                         <div class="cntar_form_r2">
                         <p>{{ __('forms.fields_required') }}</p>
                         </div>
                         <div class="cntar_form_r2">
                              <input class="cntar_forminpt only-number" type="text" id="document" name="document" placeholder="{{ __('forms.document') }}*" value="{{ old('document') }}">
                              <select name="position" id="position" class="cntar_forminpt">
                                   <option value="" {{ old('position') == '' ? 'selected' : ''}} disabled>{{ __('forms.position') }}*</option>
                                   @foreach($jobs as $key => $item)
                                        <option value="{{ $item->title }}" {{ old('position') == $item->title ? 'selected' : ''}}>{{ $item->title }}</option>
                                   @endforeach
                              </select>
                         </div>
                         <div class="cntar_form_r2">
                              <input class="cntar_forminpt" id="name" name="name" type="text" placeholder="{{ __('forms.name') }}*" value="{{ old('name') }}">
                              <input class="cntar_forminpt" id="lastname" name="lastname" type="text" placeholder="{{ __('forms.lastname') }}*" value="{{ old('lastname') }}">
                         </div>

                         <div class="cntar_form_r2">
                              <input class="cntar_forminpt" id="birthdate" name="birthdate" type="text" placeholder="{{ __('forms.birthdate') }}*" value="{{ old('birthdate') }}">
                              <select name="civil_status" id="civil_status" class="cntar_forminpt" >
                                   <option value="" disabled {{ old('civil_status') == '' ? 'selected': ''}}>{{ __('forms.civil_status') }}*</option>
                                   @foreach($civil_status as $key => $option)
                                        <option value="{{ $option }}" {{ old('position') == $option ? 'selected' : ''}}>{{ $option }}</option>
                                   @endforeach    
                              </select>
                         </div>
                         
                         <input class="cntar_forminpt" id="email" name="email" type="text" placeholder="{{ __('forms.email') }}*" value="{{ old('email') }}">
                         <div class="cntar_form_end2">
                              <p>{{ __('forms.vinculo') }}*</p>
                                   <input name="vinculo" type="radio"  value="Si">
                                   <label for="">Si</label>
                                   <input name="vinculo" type="radio"  value="No">
                                   <label for="">No</label>
                              <p>{{ __('forms.experience') }}*</p>
                                   <input name="experience" type="radio" value="Si">
                                   <label for="">Si</label>
                                   <input name="experience" type="radio" value="No">
                                   <label for="">No</label>
                         </div>
                         <div class="cntar_form_r2">
                              <input class="cntar_forminpt only-number" id="phone" name="phone" type="text" placeholder="{{ __('forms.phone') }}" value="{{ old('phone') }}">
                              <input class="cntar_forminpt only-number" id="mobile" name="mobile" type="text" placeholder="{{ __('forms.mobile') }}*" value="{{ old('mobile') }}">
                         </div>
                         <div class="cntar_form_r2">
                              <select name="department" id="department" class="cntar_forminpt" >
                                   <option value="" selected disabled>{{ __('forms.department') }}*</option>
                                   @foreach($departments as $key => $item)
                                        <option value="{{ $item->title }}" data-cities="{{ json_encode($item->cities) }}">{{ $item->title }}</option>
                                   @endforeach    
                              </select>
                              <select name="city" id="cities" class="cntar_forminpt" >
                                   <option value="" selected disabled>{{ __('forms.city') }}*</option>
                              </select>
                         </div>
                         <div class="cntar_form_r2">
                              <select name="scholarship" id="scholarship" class="cntar_forminpt" >
                                   <option value="" disabled {{ old('scholarship') == '' ? 'selected': ''}}>{{ __('forms.scholarship') }}*</option>
                                   @foreach($scholarship as $key => $option)
                                        <option value="{{ $option }}">{{ $option }}</option>
                                   @endforeach    
                              </select>
                              <select name="training" id="training" class="cntar_forminpt" >
                                   <option value="" disabled {{ old('training') == '' ? 'selected': ''}}>{{ __('forms.training') }}*</option>
                                   @foreach($training as $key => $option)
                                        <option value="{{ $option }}">{{ $option }}</option>
                                   @endforeach 
                              </select>
                         </div>
                         <div class="cntar_form_end2">
                              <p>{{ __('forms.cv') }}*</p>
                              <input type="file" name="file" id="file" class="cntar_forminpt_file" > 
                         </div>               
                         <textarea name="message" id="message" cols="30" rows="10" class="cntar_formtxta validate-characteres" placeholder="{{ __('forms.profile') }}" >{{ old('message') }}</textarea>              
                         <div class="cntar_form_end">
                              <p>{{ __('forms.check_policy') }}</p>
                              <div class="cntar_formsbtn" id="btnSendWorkUs">{{ __('links.send_work_us') }}</div>
                         </div>
                          <input type="hidden" name="_recaptcha" id="recaptcha">
                    </form>
               </div>
          </div>         
          </div>
     </div>
</div>
@endsection
@include('_partials.script_recaptcha', array('id_form' => 'formWorkUs', 'message_send' =>  __('messages.send_cv'), 'action' => 'work_us'))
@push('js')
     @if ($validate_document)        
          <script type="text/javascript">
               swal({
                    title: '{{ __('messages.registered_document') }}',
                    type: "success",
                    confirmButtonText: "Cerrar",
                    confirmButtonColor: '#f98929'
                    })
          </script>
     @endif
<script src="{{ asset('mng/js/jquery.ui.min.js') }}"></script>
<script>
     $('#department').change(function (e) { 
         let cities = $('#department option:selected').data('cities');
         $('#cities').empty();
         $('#cities').append('<option value="" selected diasbled>{{ __('forms.city') }}*</option>');
         let options = '';
         $.each(cities, function (indexInArray, city) { 
              options += '<option value="'+city.title+'">'+city.title+'</option>'; 
         });
         $('#cities').append(options);
     });

     $.datepicker.regional['es'] = {
          prevText: '< Ant',
          nextText: 'Sig >',
          monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
          dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
          dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
          dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
          weekHeader: 'Sm',
          dateFormat: 'yy-mm-dd',
          firstDay: 0,
          isRTL: false,
          showMonthAfterYear: false,
          yearSuffix: ''
     };

          $.datepicker.setDefaults($.datepicker.regional['es']);
          $('#birthdate').datepicker({
               yearRange: "1960:+nn",
               maxDate: "-18y",
               changeMonth: true,
               changeYear: true
          });
     </script>

@endpush