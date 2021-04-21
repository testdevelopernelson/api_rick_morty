@extends('layouts.master')

@section('content')
   @include('_partials.banner')

<div class="b_contactr">
<div class="container_sd">
<div class="b_contactr1">
     {!! $section->contents[1]->text_1 !!}
     <div class="cntar_form">
          <form action="{{ url()->current() }}" id="formContact" class="form-load"  method="POST">
               {{ csrf_field() }}
          <div class="cntar_form_end2">
               <p>{{ __('forms.fields_required') }}</p>
          </div>
          <select name="cooperative_relation" id="cooperative_relation" class="cntar_forminpt" >
               <option value="">{{ __('forms.cooperative_relation') }}*</option>
               <option value="Asociado">Asociado</option>
               <option value="Ahorrador">Ahorrador</option>
               <option value="Cliente">Cliente</option>
               <option value="Ninguno">Ninguno</option>
          </select>
          <div class="cntar_form_r2">
               <input class="cntar_forminpt" type="text" id="name" name="name" placeholder="{{ __('forms.name') }}*" value="{{ old('name') }}">  
               <input class="cntar_forminpt" type="text" id="lastname" name="lastname" placeholder="{{ __('forms.lastname') }}*" value="{{ old('_lastname') }}">
          </div>
          <div class="cntar_form_r2">
               <select name="type_document" id="type_document" class="cntar_forminpt" >
                    <option value="">{{ __('forms.type_document') }}*</option>
                    <option value="Cédula de ciudadanía">Cédula de ciudadanía</option>
                    <option value="Tarjeta de identidad">Tarjeta de identidad</option>
                    <option value="Cédula de extranjería">Cédula de extranjería</option>
                    <option value="Pasaporte">Pasaporte</option>
               </select>
               <input class="cntar_forminpt" type="text" id="document" name="document" placeholder="{{ __('forms.document') }}*" value="{{ old('document') }}">
          </div>
          <input class="cntar_forminpt" type="text" id="email" name="email" placeholder="{{ __('forms.email') }}*" value="{{ old('email') }}">
          <div class="cntar_form_r2">
               <input class="cntar_forminpt only-number" type="text" id="phone" name="phone" placeholder="{{ __('forms.phone') }}" value="{{ old('phone') }}">
               <input class="cntar_forminpt only-number" type="text" id="mobile" name="mobile" placeholder="{{ __('forms.mobile') }}*" value="{{ old('mobile') }}">               
          </div>
          <div class="cntar_form_r2">               
               <select name="city" id="cities" class="cntar_forminpt" >
                    <option value="">{{ __('forms.city') }}*</option>
                    @foreach($cities as $key => $item)
                         <option value="{{ $item->title }}" >{{ $item->title }}</option>
                    @endforeach                    
               </select>
               <select name="reason_contact" id="reason_contact" class="cntar_forminpt" >
                    <option value="">{{ __('forms.reason_contact') }}*</option>
                    <option value="Opinión">Opinión</option>
                    <option value="Sugerencia">Sugerencia</option>
                    <option value="Felicitaciones">Felicitaciones</option>
                    <option value="Otro">Otro</option>
               </select>
               {{-- <select name="city" id="cities" class="cntar_forminpt">
                    <option value="">{{ __('forms.city') }}</option>
               </select> --}}
          </div>
          <textarea name="message" id="message" cols="30" rows="10" maxlength="600" class="cntar_formtxta validate-characteres" placeholder="{{ __('forms.message') }}" >{{ old('message') }}</textarea>
          <div class="cntar_form_end">
               <p>{{ __('forms.check_policy') }}</p>
               <div class="cntar_formsbtn"  id="btnSendContact">{{ __('links.send_contact') }}</div>
          </div>
          <input type="hidden" name="_recaptcha" id="recaptcha">
          </form>
     </div>
</div>
<div class="b_contactr2">
     {!! $section->contents[2]->text_1 !!}
     <div class="cont_bleft_agnc">
         {!! $section->contents[2]->text_2 !!}
          <div class="bleft_agnc" >
               {!! config('settings.info_agency_antioquia') !!}
          </div>
          <div class="bleft_agncr">
               {!! config('settings.info_agency_bogota') !!}
          </div>
          <a href="{{ route('agencies', $agency_menu->slug) }}" class="cntar_formsbtn">{{ __('links.see_agencies') }}</a>
     </div>
</div>
</div>
</div>	  
@endsection
@include('_partials.script_recaptcha', array('id_form' => 'formContact', 'message_send' =>  __('messages.send_email'), 'action' => 'contact'))

@push('js')
	<script>
        $('#department').change(function (e) { 
            let cities = $('#department option:selected').data('cities');
            $('#cities').empty();
            $('#cities').append('<option value="">{{ __('forms.city') }}</option>');
            let options = '';
            $.each(cities, function (indexInArray, city) { 
                 options += '<option value="'+city.title+'">'+city.title+'</option>'; 
            });
            $('#cities').append(options);
        });
     </script>
@endpush