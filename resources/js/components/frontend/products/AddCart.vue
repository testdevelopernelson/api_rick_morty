<script>
	export default{
		props : ['data_product'],
		data(){
      return {
      	quantity : 1,
      	stock : 0,
      	active_gif : false,
      	product : {}
      }
		},
		mounted(){
			this.product = this.data_product;
		},
		methods : {
			addQty(qty){
				if(this.quantity + qty < 1){
			  	return false;
			  }
				this.quantity += qty;
				// this.$root.incrementcart(qty);
			},
			addCartCompare(product){
				this.product = product;
				this.addCart();
			},
			addCart(){				
				if (this.quantity > this.product.stock) {
					this.$swal('No hay suficiente stock');
					return false;
				}
				this.active_gif = true;
				let data ={
					product : this.product.codigo,
					quantity: this.quantity
				};
				axios.post('ajax/add-to-cart' , data)
          .then(res => {
          	this.active_gif = false;
          	if(res.data.status == true){
          		this.$root.incrementcart(this.quantity);
          		this.product.stock = res.data.quantity;
          		this.$swal({
							  html: res.data.message,
							  showCancelButton: true,
							  cancelButtonText: 'Continuar comprando',
							  confirmButtonText: 'Finalizar compra',
							  reverseButtons: true
							}).then((result) => {
							  if (result.value) {
							  	location.href = res.data.url;
							  }
							})                	  
          	}else{
          		this.$swal(res.data.message);
          	}
         })

			}
			
		}
	}
</script>