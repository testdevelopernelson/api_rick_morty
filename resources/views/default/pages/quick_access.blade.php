@extends('layouts.master')

@section('content')

     @include('_partials.banner')
     
     @if($record->has_menu)
          @include('quick_access.lateral_menu')
     @else
          @include('quick_access.article')
     @endif
     

@endsection

@push('js')
<script type="text/javascript">
	$( document ).ready(function() {
          let menu = '{{ $menu }}';         
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
          
          if(menu != ''){
               var position = $(".cont_ly1").offset().top - 50;
               $('html, body').animate( {scrollTop : position}, 1000 );
          }
	});
</script>
@endpush
