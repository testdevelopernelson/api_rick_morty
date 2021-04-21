@extends('layouts.master')
@push('js')
   <script>
     $('#body').addClass('usuario');    
   </script>
@endpush
@section('content')
   <!--====================== BOF page ====================--> 
<div class="row page">
  <div class="cols">

    <!--====================== BOF breadcrumbs ====================-->
    <div class="row breadcrumbs">
            <p><a href="#" target="_self">Inicio</a><span>/</span>
                <a href="#" target="_self">Datos personales</a><span>/</span>
                <span>Mi cuenta</span>
              </p>
    </div>
<!--====================== EOF breadcrumbs ====================--> 
<!--====================== BOF row ====================-->
    <div class="row margen">
        <h1>Hola {{ $user->name }}</h1>
        <hr/>
    </div>
<!--====================== EOF row ====================--> 
    <div class="cols" v-cloak>

    <!--====================== BOF tabs ====================-->
    <div class="col col_1_3 tabs v1 margen">
        <ul>
            <li><a href="#" target="_self" class="ico datos">Datos Personales</a></li>
            <li><a href="#" target="_self" class="ico pedidos">Mis Pedidos</a></li>
            <li><a href="javascript:void()" target="_self" class="ico logout" onclick="document.getElementById('frm-logout').submit();">Salir</a></li>
        </ul>
    </div>
    <!--====================== EOF tabs ====================--> 
<!--====================== BOF My account ====================-->
 <my-account inline-template :departments="{{ json_encode($departments) }}" :user="{{ json_encode($user) }}">     
     <div class="col col_2_3 formulario pagina v1">
        <div class="cols">
            <h2>Mis datos personales</h2>
            <form>
              <div class="row">
                  <div class="col col_2 tinymargen">
                    <label>Nombre o Razón social</label>
                    <b-form-input v-model="$v.name.$model" :state="$v.name.$dirty ? !$v.name.$invalid : null"></b-form-input>
                    <label class="error" v-if="!$v.name.required && name != null">El nombre es requerido</label>
                    <label class="error" v-if="!$v.name.minLength && name != null">El nombre debe tener mínimo @{{$v.name.$params.minLength.min}} caracteres.</label>
                  </div>
                  <div class="col col_2 tinymargen">
                      <label>Tipo de documento</label>
                      <b-form-select v-model="$v.type_document.$model" :state="$v.type_document.$dirty ? !$v.type_document.$invalid : null">
                          <option value="null" selected disabled="disabled">
                            Tipo de documento
                          </option>                   
                          <option value="cc">Cédula de ciudadanía</option>
                          <option value="nit">NIT</option>
                          <option value="ce">Cédula de extrangería</option>
                          <option value="pasaporte">Pasaporte</option>
                      </b-form-select>
                  </div>
              </div>
              <div class="row">
                  <div class="col col_2 tinymargen">
                      <label>Documento</label>
                       <b-form-input  v-model.trim="$v.document.$model" :state="$v.document.$dirty ? !$v.document.$invalid : null"></b-form-input>                            
                      <label class="error" v-if="!$v.document.required && document != null">El documento es requerido</label>
                      <label class="error" v-if="!$v.document.minLength && document != null">El documento debe tener mínimo @{{$v.name.$params.minLength.min}} caracteres.</label>
                  </div>
                  <div class="col col_2 tinymargen">
                      <label>Correo</label>
                      <b-form-input  v-model.trim="$v.email.$model" :state="$v.email.$dirty ? !$v.email.$invalid : null"></b-form-input>
                      <label class="error" v-if="!$v.email.required && email != null">El correo es requerido</label>
                      <label class="error" v-if="!$v.email.email && email != null">Ingrese un correo válido.</label>             
                  </div>
              </div>

              <div class="row">
                  <div class="col col_2 tinymargen">
                      <label>Teléfono</label>
                      <b-form-input    v-model.trim="$v.phone.$model" :state="$v.phone.$dirty ? !$v.phone.$invalid : null"></b-form-input>
                      <label class="error" v-if="!$v.phone.numeric && phone != null">El teléfono solo puede contener números.</label>
                  </div>
                  <div class="col col_2 tinymargen">
                      <label>Celular</label>
                      <b-form-input v-model.trim="$v.mobile.$model" :state="$v.mobile.$dirty ? !$v.mobile.$invalid : null"></b-form-input>
                      <label class="error" v-if="!$v.mobile.required && mobile != null">El celular es requerido</label>
                      <label class="error" v-if="!$v.mobile.isMobileNumber && mobile != null">El celular debe iniciar por 3 y contener 10 digitos.</label>
                  </div>
              </div>
              <div class="row">
                  <div class="col col_2 tinymargen">
                      <input v-if="!active_gif" type="submit" value="Guardar cambios" class="boton azul full"  v-on:click.prevent="updateAccount">
                      <div v-else class="add-cart-gif btn-gif"><span class="spinner"></span></div>
                  </div>
                  <div class="col col_2 tinymargen">
                      <input name="" onclick="window.location.href=('{{ route('account.change_password') }}')" type="button" value="Cambiar contraseña" class="boton yellow full">
                  </div>
              </div>
          </form>
          <!--====================== BOE mis direcciones ====================-->
          <h2>Mis direcciones</h2>
          <div class="row">           
              <router-view></router-view>
          </div>
           <!--====================== EOF mis direcciones ====================-->
        </div>
      </div>
    </<my-account>
    <!--====================== EOF my account ====================-->

    </div>
  </div>
</div>
    
@endsection