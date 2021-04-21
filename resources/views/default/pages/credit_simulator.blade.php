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
                    <h2> <span class="icon_smtr" ></span> {{ __('credit_simulator.credit_simulator') }}</h2>

                    <div class="bcenter_sm_m" id="app">
                    <a href="{{ route('saving_simulator') }}" class="btn_sm btn_sm1">{{ __('links.saving_simulator') }}</a>
                    <a href="{{ route('credit_simulator') }}" class="btn_sm btn_sm2" >{{ __('links.credit_simulator') }}</a>

                    
                  <credit-simulator inline-template  v-cloak :messages="{{ $messages }}" :master_simulator ="{{ $master_simulator }}">
                    <div>
                      <div class="cntar_form_end3 cntar_form_end100 container-tooltip">
                         <h3>{{ __('credit_simulator.type_credit') }}
                            <span v-if ="show_icon_tooltip_type" class="icon-tooltip" v-on:mouseover="hoverTooltipType(true)" v-on:mouseleave="hoverTooltipType(false)">
                              <img src="{{ asset('img/info.png') }}" alt="">
                              <transition name="fade">
                               <div v-if="show_tooltip_type"  class="tooltip">  
                                  <p >
                                   @{{ text_type_credit }}
                                 </p>
                              </div>
                               </transition>
                            </span>
                         </h3>
                         <select v-model="type_credit" v-on:change="selectedType">
                            <option value="">{{ __('credit_simulator.select_type_credit') }}</option>
                            @foreach ($types as $item)
                              <option value="{{ $item->id }}" >{{ $item->name }}</option>
                            @endforeach
                         </select>
                         <label class="error-validate type_credit"></label>
                    </div>
                    <div class="cntar_form_end3 cntar_form_end100">
                      <h3>{{ __('credit_simulator.warranty') }}</h3>
                      @foreach ($guarantee as $item)
                        <input v-model="warranty" type="radio" value="{{ $item->id }}">
                        <label for="{{ $item->id }}">{{ $item->name }}</label>
                      @endforeach
                      <label class="error-validate warranty"></label>
                    </div>
                    <div class="cntar_form_end3 cntar_form_end100">
                      <h3>{{ __('forms.agency_credit') }}</h3>
                      <select class="cntar_forminpt" v-model="agency">
                          <option value="">{{ __('credit_simulator.select_agency') }}</option>
                          @foreach($sedes as $key => $item)
                               <option value="{{ $item->id }}">{{ $item->title }}</option>
                          @endforeach
                      </select>
                      <label class="error-validate agency"></label>
                    </div>
                    <div class="cntar_form_end3 cntar_form_end3">
                         <h3>{{ __('credit_simulator.ocupation') }}</h3>
                         <select v-model="ocupation"  :disabled="type_credit == ''" v-on:change="selectedOcupation">
                              <option value="">{{ __('credit_simulator.select_ocupation') }}</option>
                              <option :value="item.id" v-for="item in ocupations">@{{ item.name }}</option>
                         </select>
                         <label class="error-validate ocupation"></label>
                    </div>
                    <div class="cntar_form_end3 cntar_form_end3">
                         <h3>{{ __('credit_simulator.way_to_pay') }}</h3>
                         <select v-model="way_to_pay" :disabled="type_credit == '' || ocupation == ''">
                              <option value="">{{ __('credit_simulator.select_way_to_pay') }}</option>
                              <option :value="item.name" v-for="item in payment_methods">@{{ item.name }}</option>
                         </select>
                         <label class="error-validate way_to_pay"></label>
                    </div>
                    <div class="cntar_form_end3 cntar_form_end3 container-tooltip">
                         <h3>{{ __('credit_simulator.variable_calculate') }}
                            <span v-if ="show_icon_tooltip_variable" class="icon-tooltip" v-on:mouseover="hoverTooltipVariable(true)" v-on:mouseleave="hoverTooltipVariable(false)">
                              <img src="{{ asset('img/info.png') }}" alt="">
                              <transition name="fade">
                               <div v-if="show_tooltip_variable"  class="tooltip">  
                                  <p >
                                   @{{ text_variable_calculate }}
                                 </p>
                              </div>
                               </transition>
                            </span>
                           
                          </h3> 
                         <select v-model="variable_calculate" v-on:change="selectedVariable" :disabled="type_credit== '' || warranty == '' || agency == ''">
                              <option value="">{{ __('credit_simulator.select_variable_calculate') }}</option>
                               <option :value="item.id"  v-for="item in master_simulator.variable_calculate">@{{ item.name }}</option>
                         </select>
                         <label class="error-validate variable_calculate"></label>
                    </div>                                        
                    <div v-if="(variable_calculate == 31 || variable_calculate == 33)"  class="cntar_form_end3">
                         <h3>{{ __('credit_simulator.value_credit') }}</h3>
                          <input id="value_credit" class="cntar_form_end3_inpt" v-model.lazy="value_credit" v-money="money" v-on:keyup="enterValueCredit">
                          <label class="error-validate value_credit"></label>
                    </div>
                    <div v-if="(variable_calculate == 32 || variable_calculate == 33) && ocupation != '' " class="cntar_form_end3">
                         <h3>{{ __('credit_simulator.monthly_fee') }}</h3>
                          <input id="monthly_fee" class="cntar_form_end3_inpt" v-model.lazy="monthly_fee" v-money="money2" v-on:keypress="enterMonthlyFee">
                          <label class="error-validate monthly_fee"></label>
                    </div>
                    <div class="cntar_form_end3" v-if="variable_calculate != 33">
                         <h3>{{ __('credit_simulator.term_in_month') }}</h3>
                         <select v-model="term">
                              <option value="">{{ __('credit_simulator.select_term') }}</option>
                              <option :value="index" v-for="(item, index) in terms">@{{ item }}</option>
                         </select>
                         <label class="error-validate term"></label>
                    </div>
                      <div class="cntar_form_end3">
                            <a href="javascript:void(0)" class="btn_sm btn_sm4" v-on:click="calculate">{{ __('links.calculate') }}</a>
                      </div>
                      <section class="post-calculate">
                        <transition name="slide-fade">
  	                    <div class="cont_bleft_txt" v-if="show_options">
  	                       	<ul>
                                <li  class="container-tooltip"><strong >{{ __('credit_simulator.interest_rate') }}:                                      
                                </strong> <label for="" v-if="result.nominal_rate != ''"> @{{ result.nominal_rate }}% <span v-if="show_icon_tooltip_rate" class="icon-tooltip rate" v-on:mouseover="hoverTooltipRate(true)" v-on:mouseleave="hoverTooltipRate(false)">
                                     <img src="{{ asset('img/info.png') }}" alt="">
                                     <transition name="fade">
                                       <div v-if="show_tooltip_rate" class="tooltip">
                                          <p>
                                           {{ __('credit_simulator.text_interest_rate') }}
                                          </p>
                                       </div>                              
                                     </transition>
                                   </span></label></li>
                                 <li><strong>{{ __('credit_simulator.monthly_fee') }}:</strong> $@{{ result.monthly_fee }}</li>
                                 <li v-if="variable_calculate == 33"><strong>{{ __('credit_simulator.term') }}:</strong> <span v-if="result.term != ''">@{{ result.term }} Meses</span></li>
                                 <li v-if="variable_calculate == 32"><strong>{{ __('credit_simulator.value_credit') }}:</strong> $@{{ result.value_credit }}</li>
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
                  </credit-simulator>

                    <section class="block-form" >
                       <div class="info">
                       {!! $section->contents[2]->text_1 !!}
                        </div>

                    <form action="{{ url()->current() }}" id="formCredit" class="form-load"  method="POST"  style="display: none;">
                    {{ csrf_field() }}
                    <input type="hidden" name="type_credit" id="hidden_type" value="Consumo">
                    <input type="hidden" name="agency" id="hidden_agency" value="20">
                    <input type="hidden" name="warranty" id="hidden_warranty" value="Hipoteca">
                    <input type="hidden" name="ocupation" id="hidden_ocupation" value="Emplado o Pensionado">
                    <input type="hidden" name="way_to_pay" id="hidden_way_to_pay" value="Nómina">
                    <input type="hidden" name="variable_calculate" id="hidden_variable_calculate" value="Plazo">
                    <input type="hidden" name="monthly_fee" id="hidden_monthly_fee" value="">
                    <input type="hidden" name="value_credit" id="hidden_value_credit" value="$10.000.000">
                    <input type="hidden" name="term" id="hidden_term" value="48">
                    <div class="cntar_form">
                         {!! $section->contents[3]->text_1 !!}
                         <div class="cntar_form_r2">
                              <input class="cntar_forminpt" type="text" id="name" name="name" placeholder="{{ __('forms.name') }}*" value="{{ old('name') }}">  
                              <input class="cntar_forminpt" type="text" id="lastname" name="lastname" placeholder="{{ __('forms.lastname') }}*" value="{{ old('_lastname') }}">
                         </div>
                         <div class="cntar_form_r2">
                              <input class="cntar_forminpt" type="text" id="document" name="document" placeholder="{{ __('forms.document') }}*" value="{{ old('document') }}">
                              <input class="cntar_forminpt" type="text" id="email" name="email" placeholder="{{ __('forms.email') }}*" value="{{ old('email') }}">
                         </div>
                        
                         <div class="cntar_form_r2">
                              <input class="cntar_forminpt only-number" type="text" id="phone" name="phone" placeholder="{{ __('forms.phone') }}" value="{{ old('phone') }}">
                              <input class="cntar_forminpt only-number" type="text" id="mobile" name="mobile" placeholder="{{ __('forms.mobile') }}*" value="{{ old('mobile') }}">               
                         </div>
                         <div class="cntar_form_end">
                              <p>{{ __('forms.check_policy') }}</p>
                         </div>

                         <div class="cntar_form_end">
                              <div class="cntar_formsbtn" id="btnSendCreditSimulator">{{ __('links.send_contact') }}</div>
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
         <a href="{{ route('credit.export_pdf') }}" class="btn_sm btn_sm6">{{ __('links.export_pdf') }}</a>
         <a href="{{ route('credit.export_excel') }}" class="btn_sm btn_sm6">{{ __('links.export_excel') }}</a>
       </div>
    </div>
</div>

@endsection
@include('_partials.script_recaptcha', array('id_form' => 'formCredit', 'message_send' =>  __('messages.send_email'), 'action' => 'credit_simulator'))

@push('js')
<script src="{{ asset('js/magnific-popup.js') }}"></script>
<script type="text/javascript">
	$( document ).ready(function() {      
		// SCRIPTS -- PAGE
    //Hover en el cual se muestra el tooltip
      // $('.icon-tooltip').hover(function(e) {
      //   e.stopPropagation();
      //   let top = $(this).position();
      //   console.log(top);
      //   $('.tooltip-content').css({display: 'none'});
      //   // $('span#tooltip-'+id_product).css({
      //   //     display:'block',
      //   // });
      // });

      // $(".icon-tooltip").mouseout(function() {
      //    $('.tooltip-content').css({display: 'none'});
      // });
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
		  // delegate: 'a',
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

