@extends('layouts.master')

@section('content')

     @include('_partials.banner_text')
     
     <div class="cont_ly1">
          <div class="container_sd">

               <div class="cont_bleft_w">
                    <div class="cont_bleft">
                         {!! $section->contents[1]->text_1 !!}
                         @foreach($menu_benefits as $key => $item)
                              @if(!empty($item->url))
                                   <a href="{{ $item->url }}" target="{{ $item->target }}" class="{{ $item->title == $record->title ? 'active' : '' }}">{{ $item->title }} </a>
                              @else
                                   <a href="{{ route('benefit', $item->slug) }}" class="{{ $item->title == $record->title ? 'active' : '' }}">{{ $item->title }} </a>
                              @endif
                         @endforeach
                         @if(!empty($record->image) || !empty($record->text))
                              <div class="cont_bleft_sc">
                                   @if(!empty($record->image))
                                        <div class="cont_bleft_img" style="background-image: url('{{ asset('uploads/' . $record->image)}}');" >
                                        </div>
                                   @endif
                                  
                                   <div class="cont_bleft_txt">
                                        {!! $record->text !!}
                                   </div>
                              </div>
                         @endif
                    </div>
                    <div class="cont_bleft_btn"><div class="icon nav-icon-6"><span></span><span></span><span></span></div></div>
               </div>

               <div class="cont_bcenter cont_bcenter_bne">
                    @if($record->has_tab)
                         <div class="sbm_mn">
                              @foreach($record->tabs as $key => $item)
                              @if($tab == null)
                                   <a href="{{ route('benefit.tab', [$record->slug, $item->slug]) }}" class="{{ $key == 0 ? 'active' : '' }}">{{ $item->title }}</a>
                              @else
                                   <a href="{{ route('benefit.tab', [$record->slug, $item->slug]) }}" class="{{ $item->slug == $tab ? 'active' : '' }}">{{ $item->title }}</a>
                              @endif
                                  
                              @endforeach
                         </div>
                    @endif                    
                    @include('_partials.contents')
                    @if(count($articles) > 0)
                         <div class="b_becc">
                              @foreach($articles as $key => $item)
                                   <a href="{{ route('article', [$item->section->slug, $item->slug]) }}" class="b_becc_cu">
                                        <div class="b_becc_img">
                                             <img src="{{ asset('uploads/' . $item->image_intro) }}" alt="">
                                        </div>
                                        <div class="b_becc_txt">
                                             <span>{{ $item->date->format('j') . ' de ' . $meses[$item->date->format('n') -1] . ' de ' . $item->date->format('Y') }}</span>
                                             <h3>{{ $item->title }}</h3>
                                             {!! $item->text_intro !!}
                                        </div>
                                   </a>
                              @endforeach  
                         </div>
                    @endif
               </div>
          </div>
     </div>

@endsection

@push('js')
<script type="text/javascript">
	$( document ).ready(function() {
          let tab = '{{ $tab }}';         
		// SCRIPTS -- PAGE
		$( ".cont_bleft_btn" ).on( "click" , function() {
			if ($('body').hasClass( "cont_bleft_opn")) {
				$('body').removeClass( "cont_bleft_opn");
			} else {
				$('body').addClass( "cont_bleft_opn");
			}
		});
		$(document).click(function(event) { 
			$target = $(event.target);
			if(!$target.closest('.cont_bleft_btn, .cont_bleft_w ').length  && 
			$('.cont_bleft_w').is(":visible")) {
				$('body').removeClass('cont_bleft_opn')
			}
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
          
          if(tab != ''){
               var position = $(".cont_ly1").offset().top - 50;
               $('html, body').animate( {scrollTop : position}, 1000 );
          }
	});
</script>
@endpush
