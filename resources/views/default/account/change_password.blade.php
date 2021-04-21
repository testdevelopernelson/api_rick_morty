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
           <change-password inline-template>
              <div class="col col_1 iconos" >
                <form class="login">
                  <p class="centrado"><img src="{{ asset('img/icons/ico_login.png') }}"></p>
                  <h4 class="centrado">Cambiar contraseña</h4>
                  <b-form-input type="password" class="tinymargen"
                  placeholder="Contraseña actual" v-model="$v.current_password.$model" :state="$v.current_password.$dirty ? !$v.current_password.$invalid : null" autofocus  autocomplete="new-password"></b-form-input>
                  <label v-cloak class="error" v-if="!$v.current_password.required && current_password != null">Ingrese la contraseña actual</label>

                  <b-form-input type="password" class="tinymargen"
                  placeholder="Nueva contraseña" v-model.trim="$v.password.$model" :state="$v.password.$dirty ? !$v.password.$invalid : null"  autocomplete="new-password"></b-form-input>
                  <label v-cloak class="error" v-if="!$v.password.required && password != null">La contraseña es requerida</label>

                  <label v-cloak class="error" v-if="!$v.password.minLength && password != null">La contraseña debe ser mínimo de @{{ $v.password.$params.minLength.min }} caracteres.</label>
                  <label v-cloak class="error" v-if="!$v.password.isValidPassword && password != null">La contraseña debe contener al menos un número y una letra.</label>

                  <b-form-input type="password" class="tinymargen"
                  placeholder="Confirmar contraseña" v-model.trim="$v.confirm_password.$model" :state="$v.confirm_password.$dirty ? !$v.confirm_password.$invalid : null" autocomplete="new-password"></b-form-input>
                   <label v-cloak class="error" v-if="!$v.confirm_password.sameAsPassword && confirm_password != null">Las contraseñas no coinciden</label>

                  <input v-if="!active_gif" type="button"  value="Cambiar Contraseña" class="boton yellow full tinymargen"  v-on:click.prevent="changePassword">
                  <div v-else class="add-cart-gif btn-gif"><span class="spinner"></span></div>
                </form> 
              </div> 
            </change-password>
            </div>                  
          </div>
        </div>         
      </div>                    
    </div>
</div>
</div>
<!--====================== EOF page ====================-->

@endsection
