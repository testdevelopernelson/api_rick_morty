@extends('layouts.master')

@section('content')
  @include('_partials.banner')
  <!--====================== BOF page ====================-->
<div class="row page account" v-cloak>
    <div class="cols">
  <create-account inline-template :departments="{{ json_encode($departments) }}" redirect_login="{{ route('home') }}">
    <!--====================== BOF formulario ====================-->
        <div class="col col_2_3 formulario margen">
            <h2>Crear cuenta</h2>
            <form action="" method="">
                <div class="row borde margen">
                    <h6>Los campos marcados con * son obligatorios</h6>
                     <div class="cols">
                        <div class="col col_2 tinymargen">
                            <b-form-input placeholder="Nombre o Razón social" class="ico ico_k_persona" v-model="$v.name.$model" :state="$v.name.$dirty ? !$v.name.$invalid : null" autofocus></b-form-input>
                             <span>*</span>
                            <label class="error" v-if="!$v.name.required && name != null">El nombre es requerido</label>
                            <label class="error" v-if="!$v.name.minLength && name != null">El nombre debe tener mínimo @{{$v.name.$params.minLength.min}} caracteres.</label>
                        </div>
                       
                        <div class="col col_2 tinymargen right">
                            <b-form-select class="ico ico_k_documento" v-model="$v.type_document.$model" :state="$v.type_document.$dirty ? !$v.type_document.$invalid : null">
                              <option value="null" selected disabled="disabled">
                                Tipo de documento
                              </option>                   
                              <option value="cc">Cédula de ciudadanía</option>
                              <option value="nit">NIT</option>
                              <option value="ce">Cédula de extrangería</option>
                              <option value="pasaporte">Pasaporte</option>
                            </b-form-select>
                            <span>*</span>
                            <label class="error" v-if="!$v.type_document.required && type_document != null">Seleccione un tipo de documento</label>
                        </div>
                         
                    </div>
                    <div class="cols">
                        <div class="col col_2 tinymargen">
                            <b-form-input class="ico ico_k_numero_documento" placeholder="Número de identificación" v-model.trim="$v.document.$model" :state="$v.document.$dirty ? !$v.document.$invalid : null"></b-form-input>
                            <span>*</span>
                            <label class="error" v-if="!$v.document.required && document != null">El documento es requerido</label>
                            <label class="error" v-if="!$v.document.minLength && document != null">El documento debe tener mínimo @{{$v.name.$params.minLength.min}} caracteres.</label>
                        </div>
                      
                        <div class="col col_2 tinymargen right">
                            <b-form-input class="ico ico_k_email" placeholder="Correo electrónico" v-model.trim="$v.email.$model" :state="$v.email.$dirty ? !$v.email.$invalid : null"></b-form-input>
                            <span>*</span>
                            <label class="error" v-if="!$v.email.required && email != null">El correo es requerido</label>
                            <label class="error" v-if="!$v.email.email && email != null">Ingrese un correo válido.</label>
                        </div>
                    </div>
                    <div class="cols">
                        <div class="col col_2 tinymargen">
                          <b-form-input  class="ico ico_k_telefono" placeholder="Teléfono"  v-model.trim="$v.phone.$model" :state="$v.phone.$dirty ? !$v.phone.$invalid : null"></b-form-input>
                          <label class="error" v-if="!$v.phone.numeric && phone != null">El teléfono solo puede contener números.</label>
                        </div>

                        <div class="col col_2 tinymargen right">
                          <b-form-input  class="ico ico_k_celular" placeholder="Celular" v-model.trim="$v.mobile.$model" :state="$v.mobile.$dirty ? !$v.mobile.$invalid : null"></b-form-input>
                          <span>*</span>
                          <label class="error" v-if="!$v.mobile.required && mobile != null">El celular es requerido</label>
                          <label class="error" v-if="!$v.mobile.isMobileNumber && mobile != null">El celular debe iniciar por 3 y contener 10 digitos.</label>
                        </div>
                        
                    </div>
                    <div class="cols">
                        <div class="col col_2 tinymargen">
                          <b-form-select  class="ico ico ico_k_edificio" v-on:change="selectedDepartment($event)" v-model="$v.state.$model" :state="$v.state.$dirty ? !$v.state.$invalid : null"  :options="departments" value-field="id" text-field="name">
                           <template #first>
                            <b-form-select-option :value="null" disabled>Departamento</b-form-select-option>
                          </template>
                          </b-form-select>
                          <span>*</span>
                        </div>
                        <label class="error" v-if="!$v.state.required && state != null">Seleccione el departamento</label>
                        <div class="col col_2 tinymargen right">
                          <b-form-select  class="ico ico ico_k_edificio" v-model="$v.city.$model" :state="$v.city.$dirty ? !$v.city.$invalid : null">
                            <option value="null" selected disabled="disabled">
                              Municipio
                            </option>
                             <option v-for="item in cities" :value="item.id">@{{ item.name }}</option>     
                          </b-form-select>
                          <span>*</span>
                        <label class="error" v-if="!$v.city.required && city != null">Seleccione la ciudad</label>
                        </div>
                    </div>
                    <div class="cols">
                        <div class="col col_2 tinymargen">
                           <b-form-input class="ico ico ico_k_edificio" placeholder="Dirección" v-model.trim="$v.address.$model" :state="$v.address.$dirty ? !$v.address.$invalid : null"></b-form-input>
                           <span>*</span>
                          <label class="error" v-if="!$v.address.required && address != null">La dirección es requerida</label>
                          <label class="error" v-if="!$v.address.minLength && address != null">La dirección debe tener mínimo @{{$v.address.$params.minLength.min}} caracteres.</label>
                        </div>
                        <div class="col col_2 tinymargen right">
                          <b-form-input class="ico ico ico_k_edificio" placeholder="Nombre de la dirección (ej: Ocifina)" v-model="name_address"></b-form-input>
                        </div>
                    </div>
                    <div class="cols">
                        <div class="col col_2 tinymargen">
                           <b-form-input type="password" class="ico ico_k_password" placeholder="Contraseña" v-model.trim="$v.password.$model" :state="$v.password.$dirty ? !$v.password.$invalid : null" autocomplete="new-password"></b-form-input>
                             <span>*</span>
                            <label class="error" v-if="!$v.password.required && password != null">La contraseña es requerida</label>
                            <label class="error" v-if="!$v.password.minLength && password != null">La contraseña debe ser mínimo de @{{ $v.password.$params.minLength.min }} caracteres.</label>
                        </div>
                        <div class="col col_2 tinymargen right">
                            <b-form-input type="password" class="ico ico_k_password" placeholder="Confirmar contraseña" v-model.trim="$v.confirm_password.$model" :state="$v.confirm_password.$dirty ? !$v.confirm_password.$invalid : null"></b-form-input>
                             <span>*</span>
                            <label class="error" v-if="!$v.confirm_password.sameAsPassword && confirm_password != null">Las contraseñas no coinciden</label>
                        </div>
                    </div>
                    <div class="cols">
                        <div class="col col_3_4">
                            <div class="aviso_privacidad">
                                <p class="etiqueta">
                                    <input class="privacidad_check" type="checkbox" value="1" checked="checked"><a target="_blank" href="#" onclick="return false;">
                                        He leído y acepto las Condiciones de tratamiento de datos</a>
                                </p>
                            </div>
                        </div>
                        <div v-if="!active_gif" class="col col_1_4">
                            <input class="boton azul small" name="" type="submit" value="Crear cuenta" v-on:click.prevent="createAccount">
                        </div>
                         <div v-else class="add-cart-gif btn-gif"><span class="spinner"></span></div>
                    </div>
                </div>
            </form>
        </div>
        <!--====================== EOF formulario ====================-->
  </create-account>
  </div>
</div>
@endsection
