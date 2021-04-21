<script>
	export default{
		props : ['order', 'user', 'devolutions'],
		data(){
			return{
				items : [],
			}
		},
		mounted(){
			this.$store.state.order = this.order;
			this.$store.state.user = this.user;
			this.$store.state.devolutions = this.devolutions;
			this.$router.push({
           name : 'list_items',
           params : {reference: this.order.reference}
      });
		},
		validations: {
  	},
		methods:{
			selectedDepartment(event){
			},
			updateAddress(item){
			},
			updateAccount(){			
			}
		}
	}
</script>


