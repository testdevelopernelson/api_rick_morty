<template>
	<div class="row page account">
    <div class="cols">
        <div class="col col_2_3 formulario margen">           
            <form action="" method="">
            	<div class="row borde">
        		 	<h2>Crear cuenta</h2>
            	<div class="row">
	            	<div class="input col col_1 tinymargen">
	              	<b-form-input placeholder="Nombre" v-model="$v.name.$model" :state="$v.name.$dirty ? !$v.name.$invalid : null" autofocus></b-form-input>
	              	<label class="error" v-if="!$v.name.required && name != null">El nombre es requerido</label>
	              	<label class="error" v-if="!$v.name.minLength && name != null">El nombre debe tener mínimo @{{$v.name.$params.minLength.min}} caracteres.</label>         
	              </div>        
              </div>
              <div class="row">
	            	<div class="input col col_1 tinymargen">
	               <b-form-input placeholder="Correo electrónico" v-model.trim="$v.email.$model" :state="$v.email.$dirty ? !$v.email.$invalid : null"></b-form-input>
                    <label class="error" v-if="!$v.email.required && email != null">El correo es requerido</label>
                    <label class="error" v-if="!$v.email.email && email != null">Ingrese un correo válido.</label>         
	              </div>        
              </div>
              <div class="row">
		              <div class="input col col_1 tinymargen">
		              	<b-form-input placeholder="Cumpleaños (aaaa-mm-dd)" v-model.trim="$v.birthdate.$model" :state="$v.birthdate.$dirty ? !$v.birthdate.$invalid : null"></b-form-input>
		              	  <label class="error" v-if="!$v.birthdate.isBirthdate && birthdate != null">El formato válido para el cumpleaños es aaaa-mm-dd.</label>
	                </div>         
              </div>
               <div class="row">
		              <div class="input col col_1 tinymargen">
		              	 <b-form-input  placeholder="Ciudad" v-model="city"></b-form-input>
	                </div> 
                </div>        
                <div class="row">
		              <div class="input col col_1 tinymargen">
		              	 <b-form-input  placeholder="Dirección" v-model="address"></b-form-input>
	                </div>         
              </div>
              <div class="row">
		              <div class="input col col_1 tinymargen">
		              	 <b-form-input type="password" placeholder="Contraseña" v-model.trim="$v.password.$model" :state="$v.password.$dirty ? !$v.password.$invalid : null" autocomplete="new-password"></b-form-input>
                    <label class="error" v-if="!$v.password.required && password != null">La contraseña es requerida</label>
                    <label class="error" v-if="!$v.password.minLength && password != null">La contraseña debe ser mínimo de @{{ $v.password.$params.minLength.min }} caracteres.</label>
	                </div>         
              </div>
              <div class="row">
		              <div class="input col col_1 tinymargen">
		              	  <b-form-input type="password" placeholder="Confirmar contraseña" v-model.trim="$v.confirm_password.$model" :state="$v.confirm_password.$dirty ? !$v.confirm_password.$invalid : null"></b-form-input>
                      <label class="error" v-if="!$v.confirm_password.sameAsPassword && confirm_password != null">Las contraseñas no coinciden</label>
	                </div>         
              </div>
              <div class="row">
		               	<div v-if="!active_gif" class="col col_1_4">
                        <input class="boton azul small" name="" type="submit" value="Crear cuenta" v-on:click.prevent="createAccount">
                  	</div>
                     <div v-else class="add-cart-gif btn-gif"><span class="spinner"></span></div>         
              </div> 
            	</div>
            </form>
        </div>
  </div>
</div>
</template>
<script>
	import { required, minLength, sameAs, helpers, email, numeric, alphaNum} from 'vuelidate/lib/validators';
	import 'bootstrap-vue/dist/bootstrap-vue.css';
	const isBirthdate= helpers.regex('numeric', /^([0-9]{4})\-([0-9]{2})\-([0-9]{2})$/) 
	const isValidPassword = helpers.regex('alphaNum', /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]/) 
	export default{
		props : [],
		data(){
			return{
				name : null,
				email: null,
				birthdate: null,
				city : null,
				address : null,
				password : null, 
				confirm_password : null, 
				active_gif : false
			}
		},
		created(){
			
		},
		validations: {
    	name: {required, minLength: minLength(3)},
    	email: {required, email},
    	birthdate: {isBirthdate},
    	password: {required,minLength: minLength(6), isValidPassword},
    	confirm_password: {sameAsPassword: sameAs('password')}
  	},
		methods:{
			createAccount(){
			 	this.$v.$touch()
				if (this.$v.$invalid) {	      	
	       	return false;
	      }else{
	      	this.active_gif = true;
	      	let data = {
	      		name : this.name,
	      		email : this.email,
	      		city : this.city,
	      		address : this.address,
	      		birthdate : this.birthdate,
	      		password : this.password,
	      	};
	      	axios.post(`ajax/create-account`, data).then(response => {
	      		this.active_gif = false;	      		
	      		if (response.data.status == 'save') {
	      				this.$swal({  
								 	icon: 'success',
	  							title: response.data.message, 
	  							confirmButtonText: 'Aceptar',
								}).then((result) => {
                    if(result.value){
                     this.getLogin();
                    }
                });
	      		}else{
	      			this.$swal({  
							 	icon: 'error',
  							title: response.data.message, 
  							showCancelButton: false,
  							confirmButtonText: 'Aceptar',
							});
	      		}

	      	});
	      }	
			}, 
			getLogin(){
					let data = {
      				email: this.email,
      				password: this.password
      		};
      		axios.post('ajax/login' , data)
    		     	.then(response => {	      		     		
      		     	  if(response.data.status == true){
      		     	  	let self = this;
		     	  			 	setTimeout(function(){ 
		     	  			 		self.$store.state.auth = true;
		     	  			 		self.$router.push({
							           name : 'list_api',
							           params : {}
							        }); 
		     	  			 	}, 100);
                  }
    		     	}).catch(error => {
    		     			this.validate_login = false;
                  if(error.response.status == 422){
                    this.$swal({  
										 	icon: 'error',
			  							title: error.response.data.message, 
			  							showCancelButton: false,
			  							confirmButtonText: 'Aceptar',
										});
                  }
     					})
			} 
		}
	}
</script>

