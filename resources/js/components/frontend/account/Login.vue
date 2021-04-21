<script>
import { required } from 'vuelidate/lib/validators';
	import 'bootstrap-vue/dist/bootstrap-vue.css';
	export default{
		props : ['redirect_login'],
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
	        		     	  	let self = this;
    		     	  			 	setTimeout(function(){ location.href = self.redirect_login; }, 1500);
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
			}  
		}
	}
</script>

