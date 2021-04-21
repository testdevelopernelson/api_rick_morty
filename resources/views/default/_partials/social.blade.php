
@if(!empty(config('settings.facebook')))
     <a  class="box_sclh-itm" href="{{ config('settings.facebook') }}" target="_blank"><img src="{{ asset('img/icons/icn_face.svg') }}" alt="" /></a>
@endif  
 @if(!empty(config('settings.instagram')))
     <a class="box_sclh-itm" href="{{ config('settings.instagram') }}" target="_blank"><img src="{{ asset('img/icons/icn_instag.svg') }}" alt="" /></a>
@endif 
 @if(!empty(config('settings.twitter')))
     <a class="box_sclh-itm" href="{{ config('settings.twitter') }}" target="_blank"><img src="{{ asset('img/icons/icn_twt.svg') }}" alt="" /></a>
@endif 
@if(!empty(config('settings.linkedin')))
     <a class="box_sclh-itm" href="{{ config('settings.linkedin') }}" target="_blank"> <img src="{{ asset('img/icons/icn_lnkdi.svg') }}" alt="" /></a>
@endif
@if(!empty(config('settings.youtube')))
     <a class="box_sclh-itm" href="{{ config('settings.youtube') }}" target="_blank"> <img src="{{ asset('img/icons/icn_Wotub.svg') }}" alt="" /></a>         
@endif
@if(!empty(config('settings.pinterest')))
     <a class="box_sclh-itm" href="{{ config('settings.pinterest') }}" target="_blank"><img src="{{ asset('img/icons/icn_pint.svg') }}" alt="" /></a>    
@endif

