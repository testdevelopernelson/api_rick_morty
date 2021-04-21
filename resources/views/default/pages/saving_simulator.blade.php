@extends('layouts.master')
@push('css')
     <link type="text/css" rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" />
@endpush
@push('js')
  <script src="{{ asset('js/app.js') }}"></script>
@endpush
@section('content')

     @include('_partials.banner')

     <div class="cont_ly1 cont_ly_sml">
          <div class="container_sd">

               <div class="cont_bleft_w">
                    <div class="cont_bleft">
                         <div class="cont_bleft_sml">
                              {!! $section->contents[1]->text_1 !!}
                         
                              <div class="cont_bleft_sc">
                                   <div class="cont_bleft_img" style="background-image: url('{{ asset('uploads/' . $section->contents[1]->image_1) }}');" >
                                   </div>
                                   <div class="cont_bleft_txt">
                                         {!! $section->contents[1]->text_2 !!}
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="cont_bleft_btn"><div class="icon nav-icon-6"><span></span><span></span><span></span></div></div>
               </div>
               <div class="cont_bcenter cont_bcenter_sm">
                    <h2> <span class="icon_smtr" ></span> {{ __('saving_simulator.saving_simulator') }}</h2>

                    <div class="bcenter_sm_m"  id="app">
                    <a href="{{ route('saving_simulator') }}" class="btn_sm btn_sm2">{{ __('links.saving_simulator') }}</a>
                    <a href="{{ route('credit_simulator') }}" class="btn_sm btn_sm1" >{{ __('links.credit_simulator') }}</a>
                    <saving-simulator inline-template  v-cloak :messages="{{ $messages }}">
                    <div>
                      <div class="cntar_form_end3 cntar_form_end100">
                           <h3>{{ __('saving_simulator.product') }}</h3>
                           <select name="" id="" v-model="product" v-on:change="selectedProduct">
                                <option value="">{{ __('saving_simulator.select_product') }}</option>
                               @foreach ($products as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                               @endforeach
                           </select>
                           <label class="error-validate product"></label>
                      </div>
                      <div class="cntar_form_end3">
                          <h3 v-if="product == 24">{{ __('saving_simulator.monthly_fee') }}</h3>
                          <h3 v-else>{{ __('saving_simulator.capital') }}</h3>
                          <input id="value" class="cntar_form_end3_inpt" v-model.lazy="value" v-money="money" :disabled="product == ''">
                          <label class="error-validate value"></label>
                      </div>
                      <div class="cntar_form_end3" v-if="product != 24">
                           <h3>{{ __('saving_simulator.period') }}</h3>
                           <select name="" id="" v-model="period" v-on:change="selectedPeriod"  :disabled="product == ''">
                              <option value="">{{ __('saving_simulator.select_period') }}</option>
                              @foreach ($periods as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                             @endforeach
                           </select>
                           <label class="error-validate period"></label>
                      </div>
                      <div class="cntar_form_end3">
                           <h3>{{ __('saving_simulator.term') }}</h3>
                           <select name="" id="" v-model="term" v-on:change="selectedTerm" :disabled="terms == ''">
                                <option value="">{{ __('saving_simulator.select_term') }}</option>
                                <option v-for="(term, index) in terms" :value="index">@{{ term }}</option>
                           </select>
                           <label class="error-validate term"></label>
                      </div>


                      <div class="cntar_form_end3" >
                        <a href="javascript:void(0)" class="btn_sm btn_sm4" v-on:click="calculate">{{ __('links.calculate') }}</a>
                      </div>
                     
                      <section  class="post-calculate"> 
                       <transition name="slide-fade">
  	                    <div v-if="show_options" class="cont_bleft_txt" >
  	                       	<ul v-if="show_cdt">
  	                          <li><strong>{{ __('saving_simulator.effective_rate') }}:</strong> @{{ result.effective_rate }}%</li>
  	                          <li><strong>{{ __('saving_simulator.nominal_rate') }}:</strong> @{{ result.nominal_rate }}%</li>
  	                          <li><strong>{{ __('saving_simulator.value_interest') }}:</strong> $@{{ result.total_interest }}</li>
  	                          <li><strong>(-){{ __('saving_simulator.retefuente') }}:</strong> $@{{ result.total_retefuente}}</li>
  	                          <li><strong>{{ __('saving_simulator.net_interest') }}:</strong> $@{{ result.total_neto}}</li>
  	                       	</ul>
                            <ul v-else>
                              <li><strong>{{ __('saving_simulator.effective_rate') }}:</strong> @{{ mi_plan.effective_rate }}%</li>
                              <li><strong>{{ __('saving_simulator.monthly_fee') }}:</strong> $@{{ mi_plan.monthly_fee }}</li>
                              <li><strong>{{ __('saving_simulator.number_fee') }}:</strong> @{{ mi_plan.number_fee }}</li>
                              <li><strong>{{ __('saving_simulator.capital_reached') }}:</strong> $@{{ mi_plan.total_capital}}</li>
                              <li><strong>{{ __('saving_simulator.interest_generated') }}:</strong> $@{{ mi_plan.total_interest}}</li>
                              <li><strong>{{ __('saving_simulator.date_expiration') }}:</strong> @{{ mi_plan.date_expiration}}</li>
                            </ul>
  	                    </div>

                      </transition>
  	                    <div class="cntar_form_endtr">
  	                         <a class="btn_sm btn_sm6" id="inline-popups" data-effect="mfp-zoom-in"  href="#pop_nopts">{{ __('links.see_projection') }}</a>
  	                         <a href="javascript:void(0)" class="btn_sm btn_sm6" v-on:click="contactAsesor">{{ __('links.contact_asesor') }}</a>
  	                         <a href="javascript:void(0)" class="btn_sm btn_sm6" v-on:click="resetSimulator">{{ __('links.new_request') }}</a>
  	                    </div>
                      </section>                      
                    </div>
                    </saving-simulator>
                   
                    <section class="block-form" >
                       <div class="info">
                       {!! $section->contents[2]->text_1 !!}
                        </div>
                    <form action="{{ url()->current() }}" id="formSaving" class="form-load"  method="POST" id="formSaving" style="display: none;">
                    {{ csrf_field() }}
                    <input type="hidden" name="product" id="hidden_product">
                    <input type="hidden" name="value" id="hidden_value">
                    <input type="hidden" name="period" id="hidden_period">
                    <input type="hidden" name="term" id="hidden_term">
                    <div class="cntar_form">                        
                        {!! $section->contents[3]->text_1 !!}
                         <div class="cntar_form_r2">
                              <input class="cntar_forminpt" type="text" id="name" name="name" placeholder="{{ __('forms.name') }}*" value="{{ old('name') }}">  
                              <input class="cntar_forminpt" type="text" id="lastname" name="lastname" placeholder="{{ __('forms.lastname') }}*" value="{{ old('_lastname') }}">
                         </div>
                         <div class="cntar_form_r2">
                              <input class="cntar_forminpt only-number" type="text" id="document" name="document" placeholder="{{ __('forms.document') }}*" value="{{ old('document') }}">
                              <input class="cntar_forminpt" type="text" id="email" name="email" placeholder="{{ __('forms.email') }}*" value="{{ old('email') }}">
                         </div>
                        
                         <div class="cntar_form_r2">
                              <input class="cntar_forminpt only-number" type="text" id="phone" name="phone" placeholder="{{ __('forms.phone') }}" value="{{ old('phone') }}">
                              <input class="cntar_forminpt only-number" type="text" id="mobile" name="mobile" placeholder="{{ __('forms.mobile') }}*" value="{{ old('mobile') }}">               
                         </div>
                         <select name="agency" id="agency" class="cntar_forminpt" >
                              <option value="">{{ __('forms.agency_cdt') }}</option>
                              @foreach($sedes as $key => $item)
                                   <option value="{{ $item->id }}">{{ $item->title }}</option>
                              @endforeach
                         </select>
                         <div class="cntar_form_end">
                              <p>{{ __('forms.check_policy') }}</p>
                         </div>

                         <div class="cntar_form_end">
                              <div class="cntar_formsbtn" id="btnSendSavingSimulator">{{ __('links.send_contact') }}</div>
                         </div>
                    </div>
                    <input type="hidden" name="_recaptcha" id="recaptcha">
               </form>
              </section>
               </div>
     </div>
   </div>

<div id="pop_nopts" class="white-popup mfp-with-anim mfp-hide" style="overflow: hidden;">
    <div class="b_contactr">
       <div id="projection">
        <table class="projection-table"></table>        
       </div>
       <div class="btns-projection">
	       <a href="javascript:void(0)" class="btn_sm btn_sm6" id="print">{{ __('links.print') }}</a>
	       <a href="{{ route('saving.export_pdf') }}" class="btn_sm btn_sm6">{{ __('links.export_pdf') }}</a>
	       <a href="{{ route('saving.export_excel') }}" class="btn_sm btn_sm6">{{ __('links.export_excel') }}</a>
	     </div>
    </div>
</div>
@endsection
@include('_partials.script_recaptcha', array('id_form' => 'formSaving', 'message_send' =>  __('messages.send_email'), 'action' => 'saving_simulator'))

@push('js')


<script src="{{ asset('js/magnific-popup.js') }}"></script>
<script type="text/javascript">
	$( document ).ready(function() {
     $("#print").on('click', function() {
        var contenido = document.getElementById("projection").innerHTML;
        var contenidoOriginal = document.body.innerHTML;
        document.body.innerHTML = contenido;
        window.print();
        location.reload();
    });
      $( ".bcenter_rgt" ).on( "click" , function() {
			if ($(this).parent('.bcenter_rg').hasClass( "active")) {
				$('.bcenter_rg').removeClass( "active");
				$(this).siblings('.bcenter_rgc').slideUp();

			} else {
				$('.bcenter_rgc').slideUp();
				$('.bcenter_rg').removeClass( "active");
				$(this).parent('.bcenter_rg').addClass( "active");
				$(this).siblings('.bcenter_rgc').slideDown();
			}
          });
          $('#inline-popups').click(function(event) {
            $('.btns-projection').fadeIn();
            if($('.projection-table').text() == ''){
              $('.btns-projection').fadeOut();
            }
          });
          $('#inline-popups').magnificPopup({
      		 
      		  removalDelay: 500, //delay removal by X to allow out-animation
      		  callbacks: {
      		    beforeOpen: function() {
      		       this.st.mainClass = this.st.el.attr('data-effect');
      		    }
      		  },
      		  midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
		    });
	});
</script>
@endpush

