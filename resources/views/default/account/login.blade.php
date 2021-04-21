@extends('layouts.master')
  @push('js')
   <script>
     $('#body').addClass('');
   </script>
  @endpush
@section('content')
<!--====================== BOF page ====================--> 
<div class="login">
<div class="row page"> 
  <div class="fondo"></div>
    <div class="cols">
      <div class="col col_3 formulario gris">
        <div class="tabla">
          <div class="celda">
            <div class="cols"> 
             <login inline-template redirect_login="{{ url()->previous() == route('account.change_password') ? route('home') :  url()->previous() }}"> 
              <div class="col col_1 iconos">
                <form class="login">
                  <p class="centrado"><img src="{{ asset('img/icons/ico_login.png') }}"></p>
                  <h4 class="centrado">Ingresa tus datos</h4>
                  <b-form-input
                    placeholder="Correo electrónico" class="tinymargen" v-model.trim="$v.email.$model" :state="$v.email.$dirty ? !$v.email.$invalid : null">                      
                  </b-form-input>
                  <b-form-input type="password" class="tinymargen"
                    placeholder="Contraseña" v-model.trim="$v.password.$model" :state="$v.password.$dirty ? !$v.password.$invalid : null">                      
                  </b-form-input>
                  <label v-cloak class="error" v-if="!$v.password.required && password != null">La contraseña es requerida</label>
                  <input v-if="!active_gif" type="button"  value="Ingresar" class="boton yellow full tinymargen" v-on:click.prevent="getLogin">
                   <div v-else class="add-cart-gif btn-gif"><span class="spinner"></span></div>
                    <ul class="menu" v-cloak> 
                        <li>
                            <a href="{{ route('account.forgot_password') }}" target="_self">
                            <strong>¿Olvidó su contraseña?</strong>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('account.register') }}" target="_self">
                            <strong>Crear una cuenta</strong>
                            </a>
                        </li>                         
                    </ul>
                </form>
              </div>   
            </login>
            </div>                  
          </div>
        </div>         
      </div>                    
    </div>
</div>
</div>

<!--====================== EOF page ====================-->

@endsection
