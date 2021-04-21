@extends('layouts.master')
 @push('js')
   <script>
     $('#body').addClass('');
   </script>
  @endpush
@section('content')

<!--====================== BOF page ====================-->
<div class="login"> 
<div class="row page" > 
  <div class="fondo"></div>
    <div class="cols">
      <div class="col col_3 formulario gris">
        <div class="tabla">
          <div class="celda">
            <div class="cols" > 
             <forgot-password inline-template url_login="{{ route('login') }}"> 
              <div class="col col_1 ">
                <form class="login">
                  <p class="centrado"><img src="{{ asset('img/icons/ico_login.png') }}"></p>
                  <h4 class="centrado">Recuperar contraseña</h4>
                  <b-form-input
                    placeholder="Correo electrónico" class="tinymargen" v-model.trim="$v.email.$model" :state="$v.email.$dirty ? !$v.email.$invalid : null">                      
                  </b-form-input>
                  <label  v-cloak class="error" v-if="!$v.email.required && email != null">El correo es requerido</label>
                  <label  v-cloak class="error" v-if="!$v.email.email && email != null">Ingrese un correo válido.</label>
                  <input v-if="!active_gif" type="button"  value="Enviar" class="boton yellow full tinymargen"  v-on:click.prevent="forgotPassword">
                 <div v-else class="add-cart-gif btn-gif"><span class="spinner"></span></div>
                </form>
              </div>  
            </forgot-password>
            </div>                  
          </div>
        </div>         
      </div>                    
    </div>
</div>
</div>
<!--====================== EOF page ====================-->
    

@endsection
