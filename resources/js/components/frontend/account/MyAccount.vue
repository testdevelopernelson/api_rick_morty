<script>
	import { required, minLength, helpers, email, numeric, alphaNum} from 'vuelidate/lib/validators';
	// import 'bootstrap/dist/css/bootstrap.css';
	import 'bootstrap-vue/dist/bootstrap-vue.css';
	const isMobileNumber = helpers.regex('numeric', /^3[0-9]{9}$/) 
	const isValidPassword = helpers.regex('alphaNum', /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]/) 
	export default{
		props : ['departments', 'user'],
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
				economic_activity : null, 
				password : null, 
				confirm_password : null, 
				cities : {},
				active_gif : false,
				list_address : true,
				user_address : []
			}
		},
		mounted(){
			this.name = this.user.name;
			this.type_document = this.user.type_document;
			this.document = this.user.document;
			this.email = this.user.email;
			this.phone = this.user.phone;
			this.mobile = this.user.mobile;
			this.department = this.user.department_id;
			this.city = this.user.city_id;
			this.address = this.user.address;
			this.user_address = this.user.address;
			this.$store.state.user = this.user;
			this.$router.push({
           name : 'list_address',
           params : {departments : this.departments}
      });

		},
		validations: {
    	name: {required, minLength: minLength(3)},
    	type_document: {required},
    	document: {required, minLength: minLength(4)},
    	email: {required, email},
    	phone: {numeric},
    	mobile: {required, isMobileNumber}
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
			updateAddress(item){
				this.list_address = false;
				this.$router.push({
             name : 'update_address',
             params : {departments : this.departments, data_address : item, user : this.user}
        });
			},
			updateAccount(){				
				this.list_address = true;
			 	this.$v.$touch();
				if (this.$v.$invalid) {	      	
	       	return false;
	      }else{
	      	this.active_gif = true;
	      	let data = {
	      		id : this.user.id,
	      		name : this.name,
	      		type_document : this.type_document,
	      		document : this.document,
	      		email : this.email,
	      		phone : this.phone,
	      		mobile : this.mobile,
	      		state_id : this.state,
	      		city_id :this.city,
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
			}
		}
	}
</script>


