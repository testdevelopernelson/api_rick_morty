<script>
	export default{
		props : ['count', 'product', 'data_compare'],
		data(){
      return {
      	add_compare : true,
      	count_compare : 0,
      	array_products : []
      }
		},
		mounted(){
			this.count_compare = this.count;
			this.array_products = this.data_compare;			
			if (this.data_compare.includes(this.product.codigo)) {
				this.add_compare = false;
			}
		},
		methods : {
			addCompare(){
				if (this.count_compare == 4) {
					this.$swal('Solo se pueden comparar 4 productos');
					return false;
				}
				axios.post('ajax/add-compare',{codigo : this.product.codigo})
          .then(res => {
          	if(res.data.status == true){
          		this.add_compare = false;  
          		this.count_compare++;
          		this.$bvToast.toast('Producto listo para comparar', {
			          title: false,
			          toaster: 'b-toaster-bottom-right',
			          variant: 'info',
			          solid: true,
			          noCloseButton: true,
			          autoHideDelay : 2000
			        });
			        this.$root.incrementcompare(1);
          	}
         })
      },
			removeCompare(){
				axios.post('ajax/remove-compare' ,{codigo : this.product.codigo})
		        .then(res => {
	        	if(res.data.status == true){ 
	        		this.add_compare = true; 
	        		this.count_compare--;
          		this.$bvToast.toast('Producto eliminado de la comparación', {
			          title: false,
			          toaster: 'b-toaster-bottom-right',
			          variant: 'info',
			          solid: true,
			          noCloseButton: true,
			          autoHideDelay : 3000
			        });
			        this.$root.incrementcompare(-1);
          	}
       	})
      },
      deleteCompare(codigo){
				axios.post('ajax/remove-compare' ,{codigo : codigo})
		        .then(res => {
	        	if(res.data.status == true){ 
          		this.$bvToast.toast('Producto eliminado de la comparación', {
			          title: false,
			          toaster: 'b-toaster-bottom-right',
			          variant: 'info',
			          solid: true,
			          noCloseButton: true,
			          autoHideDelay : 3000
			        });
			        location.reload();
          	}
       	})
      }
		}
	}
</script>