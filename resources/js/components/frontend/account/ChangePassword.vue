<script>
	import { required, minLength, sameAs, helpers } from 'vuelidate/lib/validators';
	// import 'bootstrap/dist/css/bootstrap.css';
	import 'bootstrap-vue/dist/bootstrap-vue.css'; 
	const isValidPassword = helpers.regex('alphaNum', /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]/) 
	export default{
		props : [],
		data(){
			return{
				current_password : null,
				password : null, 
				confirm_password : null,
				active_gif : false
			}
		},
		mounted(){
		},
		validations: {
    	current_password: {required},
    	password: {required,minLength: minLength(6), isValidPassword},
    	confirm_password: {sameAsPassword: sameAs('password')}
  	},
		methods:{
			changePassword(){
				this.list_address = true;
			 	this.$v.$touch()
				if (this.$v.$invalid) {	      	
	       	return false;
	      }else{
	      	this.active_gif = true;
	      	let data = {
      			current_password : this.current_password,
	      		password : this.password,
	      	};
	      	axios.post(`ajax/change-password`, data).then(response => {
	      		this.active_gif = false;	      		
	      		if (response.data.status == 'change') {
	      				this.$swal({  
								 	icon: 'success',
	  							title: response.data.message, 
	  							confirmButtonText: 'Aceptar',
								}).then((result) => {
                    if(result.value){
                     	let self = this;
                     	this.$nextTick(function () {
                     		setTimeout(function(){
			     	  			 		$('#frm-logout').submit();
			     	  			 		}, 500);
                         
                    	});
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
			}
		}
	}
</script>


