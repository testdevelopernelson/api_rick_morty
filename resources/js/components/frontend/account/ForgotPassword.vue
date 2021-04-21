<script>
	import { required, email } from 'vuelidate/lib/validators';
	// import 'bootstrap/dist/css/bootstrap.css';
	import 'bootstrap-vue/dist/bootstrap-vue.css'; 
	export default{
		props : ['url_login'],
		data(){
			return{
				email : null,
				active_gif : false
			}
		},
		mounted(){
		},
		validations: {
    	email: {required, email},
  	},
		methods:{
			forgotPassword(){
				this.list_address = true;
			 	this.$v.$touch();
				if (this.$v.$invalid) {	      	
	       	return false;
	      }else{
	      	this.active_gif = true;
	      	let data = {
	      		email : this.email,
	      	};
	      	axios.post(`ajax/forgot-password`, data).then(response => {
	      		this.active_gif = false;	      		
	      		if (response.data.status == 'send') {
	      				this.$swal({  
								 	icon: 'success',
	  							title: 'Contraseña temporal enviada', 
	  							html: response.data.message, 
	  							confirmButtonText: 'Aceptar',
								}).then((result) => {
                    if(result.value){
                     	let self = this;
		     	  			 		setTimeout(function(){ location.href = self.url_login; }, 300);
                    }
                });
	      		}else if(response.data.status == 'not_send') {
	      				this.email = null;
	      				this.$swal({  
								 	icon: 'error',
	  							html: response.data.message, 
	  							confirmButtonText: 'Aceptar',
								});
	      		}else{
	      			this.email = null;	      			
	      			this.$swal({  
							 	icon: 'error',
  							title: response.data.message, 
  							showCancelButton: false,
  							confirmButtonText: 'Aceptar',
							});
	      		}
	      	});
	      }	
			}
		}
	}
</script>


