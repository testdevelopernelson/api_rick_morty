 <!--====================== BOF header ====================-->
<header class="row" id="header">
    @include('_partials.menu_mobile')
   <!--======================-->
   <a id="pull" class="rspnsv"></a><!--======================-->
   @include('_partials.menu_desktop')
</header>
{{-- Para realizar el logout desde cualquier parte --}}
<form id="frm-logout" action="{{ route('logout') }}" method="post" style="display: inline;">
  @csrf
</form>   

    <!--====================== EOF header ====================-->