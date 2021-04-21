<!--======================-->
<div class="row superior">
  <div class="cols">
      <!--======================-->
      <a href="{{ url('/') }}" class="logo" target="_self">
          <img src="{{ asset('uploads/'.config('settings.shop_logo')) }}">
      </a>
      <div class="primaries">
          <div class="contenedor parent_menu_cuenta">
          @if (auth()->check())            
            <a href="#" target="_self" class="primary parent" id="btn_menu_cuenta">Mi cuenta</a>           
          @else
            <a href="{{ route('login') }}" target="_self" class="primary">Iniciar sesión</a>
          @endif
          </div>
         
          <!--======================-->
      </div>
      <!--======================-->

  </div>
</div>



@if (auth()->check())
    <!--======================-->
    <div class="row menu_desplegable normal" id="menu_cuenta">
        <div class="cols iconos">
            <ul class="menu">
                <li>
                    <a href="{{ route('account.home') }}" target="_self">
                        <div class="ico">
                            <p><img src="{{ asset('img/icons/user.svg') }}"></p>
                        </div>
                        <span>Mi Perfil</span>
                    </a>
                </li>
                <li>
                    <a href="#" target="_self">
                        <div class="ico">
                            <p><img src="{{ asset('img/icons/shopping-cart.svg') }}"></p>
                        </div>
                        <span>Mis favoritos</span>
                    </a>
                </li>
                <li>                           
                    <a href="javascript:void()" target="_self" onclick="document.getElementById('frm-logout').submit();">
                        <div class="ico">
                            <p><img src="{{ asset('img/icons/log-out.svg') }}"></p>
                        </div>
                        <span>Salir</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!--======================-->
@endif