<template>
<div class="login">
<div class="row page"> 
  <div class="fondo"></div>
    <div class="cols">
      <div class="col col_3 formulario gris">
        <div class="tabla">
          <div class="celda">
            <div class="cols"> 
              <div class="col col_1 iconos">
                <form class="login">
                  <p class="centrado"><img src=""></p>
                  <h4 class="centrado">Ingresa tus datos</h4>
                  <b-form-input
                    placeholder="Correo electrónico" class="tinymargen" v-model.trim="$v.email.$model" :state="$v.email.$dirty ? !$v.email.$invalid : null">                      
                  </b-form-input>
                  <b-form-input type="password" class="tinymargen"
                    placeholder="Contraseña" v-model.trim="$v.password.$model" :state="$v.password.$dirty ? !$v.password.$invalid : null">                      
                  </b-form-input>
                  <label v-cloak class="error" v-if="!$v.password.required && password != null">La contraseña es requerida</label>
                  <input v-if="!active_gif" type="button"  value="Ingresar" class="boton full tinymargen" @click.prevent="getLogin">
                   <div v-else class="add-cart-gif btn-gif"><span class="spinner"></span></div>
                    <ul class="menu" v-cloak> 
                      <li>
                          <a href="" target="_self" @click.prevent="createAccount">
                          <strong>Crear una cuenta</strong>
                          </a>
                      </li>                         
                    </ul>
                </form>
              </div> 
            </div>                  
          </div>
        </div>         
      </div>                    
    </div>
</div>
</div>
</template>
<script>
import { required } from 'vuelidate/lib/validators';
	import 'bootstrap-vue/dist/bootstrap-vue.css';
	export default{
		props : [],
		data(){
			return{
					email: null,
					password : null,
					active_gif : false 
				}
		},
		validations: {
    		email: {required},
    		password: {required}
  	},	
  	created(){
  	},
		methods:{
			getLogin(){
					this.$v.$touch();
					if (this.$v.$invalid) {		      	
		       	return false;
		      }else{
		      	this.active_gif = true;
		      	let data = {
	        			email: this.email,
	        			password: this.password
	        		};
	        		axios.post('ajax/login' , data)
	      		     	.then(response => {	      		     		
	        		     	  if(response.data.status == true){	
                        this.$store.state.user = response.data.user;       		     	  	
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
	      		     			this.active_gif = false;
	                    if(error.response.status == 422){
	                      this.$swal({  
												 	icon: 'error',
					  							title: error.response.data.message, 
					  							showCancelButton: false,
					  							confirmButtonText: 'Aceptar',
												});
	                    }
   						});
    			}	
			},
      createAccount(){
        this.$router.push({
           name : 'create_acount'
        });
      }
		}
	}
</script>

