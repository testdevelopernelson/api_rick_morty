<template>
	<div class="row page account">	
	 		<div class="menu-profile">
    	 <div class="col col_1">
    	 		<ul>
    	 			<li><a href="" class="active">Datos personales</a></li>
    	 			<li><a v-if="user.favorites.length > 0" href="" @click.prevent="favorites">Mis favoritos</a></li>
    	 		</ul>
    	 	</div>
	 	</div>
    <div class="cols">
        <div class="col col_1 formulario margen">           
            <form action="" method="">
            	<div class="row borde">
        		 	<h2>Datos personales</h2>
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
		               	<div v-if="!active_gif" class="col col_1_4">
                        <input class="boton azul small" name="" type="submit" value="Guardar" @click.prevent="updateAccount">
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
	import { required, minLength, helpers, email, numeric, alphaNum} from 'vuelidate/lib/validators';
	// import 'bootstrap/dist/css/bootstrap.css';
	import 'bootstrap-vue/dist/bootstrap-vue.css';
	const isBirthdate= helpers.regex('numeric', /^([0-9]{4})\-([0-9]{2})\-([0-9]{2})$/)  
	const isValidPassword = helpers.regex('alphaNum', /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]/) 
	export default{
		props : [],
		data(){
			return{
				user : {
					favorites :[]
				},
				name : null,
				email: null,
				birthdate: null,
				city : null,
				address : null,
				active_gif : false,
				show_favorite : false,
				menu : 'profile'
			}
		},
		mounted(){
			axios.post(`ajax/get-user`).then(response => {
				if (response.data.status == true) {
					this.user = response.data.user;
					this.name = this.user.name;
					this.email = this.user.email;
					this.birthdate = this.user.birthdate;
					this.city = this.user.city;
					this.address = this.user.address;
					this.$store.state.user = this.user;
				}
			});



		},
		validations: {
    	name: {required, minLength: minLength(3)},
    	email: {required, email},
    	birthdate: {isBirthdate},
  	},
		methods:{
			updateAccount(){			
			 	this.$v.$touch();
				if (this.$v.$invalid) {	      	
	       	return false;
	      }else{
	      	this.active_gif = true;
	      	let data = {
	      		id : this.user.id,
	      		name : this.name,
	      		city : this.city,
	      		birthdate : this.birthdate,
	      		email : this.email,
	      		address : this.address
	      	};
	      	axios.post(`ajax/update-account`, data).then(response => {
	      		this.active_gif = false;	      		
	      		if (response.data.status == 'update') {
	      				this.$swal({  
								 	icon: 'success',
	  							title: response.data.message, 
	  							confirmButtonText: 'Aceptar',
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
			favorites(){
				this.$router.push({
           name : 'favorites',
           params : {user : this.user}
        });
			}
		}
	}
</script>


