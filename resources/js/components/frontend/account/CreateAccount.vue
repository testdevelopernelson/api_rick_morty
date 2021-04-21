<script>
	import { required, minLength, sameAs, helpers, email, numeric, alphaNum} from 'vuelidate/lib/validators';
	// import 'bootstrap/dist/css/bootstrap.css';
	import 'bootstrap-vue/dist/bootstrap-vue.css';
	const isMobileNumber = helpers.regex('numeric', /^3[0-9]{9}$/) 
	const isValidPassword = helpers.regex('alphaNum', /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]/) 
	export default{
		props : ['departments', 'redirect_login'],
		data(){
			return{
				name : null,
				type_document : null,
				document : null,
				email: null,
				phone: null,
				mobile: null,
				state : null,
				city : null,
				address : null,
				name_address : null, 
				password : null, 
				confirm_password : null, 
				cities : {},
				active_gif : false
			}
		},
		created(){
			
		},
		validations: {
    	name: {required, minLength: minLength(3)},
    	type_document: {required},
    	document: {required, minLength: minLength(4)},
    	email: {required, email},
    	phone: {numeric},
    	mobile: {required, isMobileNumber},
    	state: {required},
    	city: {required},
    	address: {required, minLength: minLength(5)},
    	password: {required,minLength: minLength(6), isValidPassword},
    	confirm_password: {sameAsPassword: sameAs('password')}
  	},
		methods:{
			selectedDepartment(event){
				let state	= event;
				axios.get(`ajax/cities/${state}`)
              .then(res => {
                this.cities = res.data;
                return false;
        })
			},
			createAccount(){
			 	this.$v.$touch()
				if (this.$v.$invalid) {
	      	
	       	return false;
	      }else{
	      	this.active_gif = true;
	      	let data = {
	      		name : this.name,
	      		type_document : this.type_document,
	      		document : this.document,
	      		name_address : this.name_address,
	      		email : this.email,
	      		phone : this.phone,
	      		mobile : this.mobile,
	      		state_id : this.state,
	      		city_id :this.city,
	      		address : this.address,
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
		     	  			 	setTimeout(function(){ location.href = self.redirect_login; }, 300);
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

