<script>
	export default{
		props : ['data_cart', 'auth', 'departments', 'user', 'stores', 'url_login'],
		data(){
			return {
				base : window.base_url,
				active_gif : false,
				cart : [],
				has_items : true,
        complete_checkout : false,
        step : null,
        coupon : null,
        text_btn_back : '',
        text_btn_next : 'Ir al envío',
        hidden_add_address : true,
        hidden_change : false,
        address_shipping : null,
        gateway : {},
        carrier : {},
        url_wompi : null,
        fields_payment : [],
        type_shipping : 'shipping',
        store_pickup_id : null,
        text_store : null
			}
		},
		mounted(){   
      var titleElement = document.querySelector('.title_principal');
      this.cart = this.data_cart;
      if (this.cart.store_pickup ) {
        this.type_shipping = 'store';
        this.text_store = this.cart.info_store;
      }
      this.step = this.cart.step;
      if(this.auth && this.cart.step == 'cart'){
        this.active_gif = true;
        this.$store.state.user = this.user;
        this.user_address = this.user.address;
        this.completeInfoCustomer();        
      }
      if(this.step == 'shipping'){
        this.$store.state.user = this.user;
        this.user_address = this.user.address;
        this.text_btn_back = 'Volver al carrito';
        this.text_btn_next = 'Continuar con el pago';
        titleElement.innerHTML = 'Dirección de envío';
      } 
      if (this.step == 'payment') {
        this.step = 'shipping';
        titleElement.innerHTML = 'Dirección de envío';
        this.$store.state.user = this.user;
        this.user_address = this.user.address;
        this.text_btn_back = 'Volver al carrito';
        this.text_btn_next = 'Continuar con el pago';
      } 
		},
		methods:{
      loadCart(){
        axios.post('ajax/get-cart').then(function (res) {
            this.cart = res.data;
            // this.step = this.cart.step; 
            if (this.cart == '') {
              this.has_items = false;
              this.$root.updatecart(0);
              return false;
            }                  
            this.$root.updatecart(this.cart.items_qty);
            this.active_gif = false;
        }.bind(this))
        .catch(function(error){
            console.log('Erro loading cart');
        });        
        
      },
      buyNow(){
        if (!this.auth) {
          location.href = this.url_login;
          return false;
        }
        if (this.step == 'cart') {
          this.step = 'shipping';
          this.text_btn_back = 'Volver al carrito';
          this.text_btn_next = 'Continuar con el pago';
          return false;
        }
        if (this.step == 'shipping') {
          if (this.type_shipping == 'store' && this.text_store == null) {
            this.$swal('Debe seleccionar una tienda');
            return false;
          }
          this.calculateShipping();
          this.text_btn_back = 'Volver al envío';
          this.text_btn_next = 'Finalizar la compra';
          return false;
        }
        if (this.step == 'payment') {
          this.finalizePurchase();
        }
      },
			deleteItem(item){
        this.active_gif = true;
				let id = item.id;
       	axios.delete(`/ajax/remove-item/${id}`)
        	.then(response => {
             if(response.data.status == 'remove'){
               this.active_gif = false;
                this.$swal({  
                  icon: 'success',
                  title: response.data.message, 
                  confirmButtonText: 'Aceptar',
                });
                this.loadCart();
             }
        })

			},
			addQuantity(item , qty){
        this.active_gif = true;
        if(item.quantity + qty < 1){
          return false;
        }
        this.updateQuantity(item.id , (item.quantity + qty));
      },
      updateItem(item){
        this.active_gif = true;
        if(Number.isNaN(item.quantity) || item.quantity < 1){
          this.loadCart();
          return false;
        }
          this.updateQuantity(item.id , item.quantity);
      },
      updateQuantity(id , qty){
	      	let data = {
	      		id : id,
	      		quantity : qty
	      	};
      		axios.post('ajax/update-item-cart' , data)
           .then(res => {
            if (res.data.status == 'update') {
          	   this.loadCart();
            }
           }).catch(error => {
             if (error.response.status = 422) {
              this.loadCart();
              this.$swal(error.response.data.message);
             }
           });
      },
      completeInfoCustomer(){        
        this.active_gif = true;
        axios.post('ajax/user-to-cart')
          .then(res => {
            if (res.data.status == true) {
               this.$store.state.user  = res.data.user;
               this.loadCart();
            }
          }).catch(error => {
             if (error.response.status = 422) {
              this.$swal(error.response.data.message);
             }
          });
      },
      createAddress(){
        this.hidden_add_address = false;
        this.$router.push({
            name : 'create_address_cart',
            params : {departments : this.departments, view : 'cart'}
        });
      },
      changeAddressCart(){
        this.hidden_change = true;
        this.$router.push({
             name : 'list_address_cart',
             params : {user_address : this.user_address}
        });
      },
      applyCoupon(){
        if (this.coupon == null) {
          this.$swal('Ingrese el código del cupón');
          return false;
        }
        this.active_gif = true;
        axios.post('ajax/apply-coupon', {code : this.coupon})
          .then(res => {
            if (res.data.status == true) {
              this.coupon = null;
              this.loadCart();
              this.$swal(res.data.message);
            }else{
              this.coupon = null;
              this.active_gif = false;
              this.$swal(res.data.message);
            }
          }).catch(error => {

          });
      },
      removeCoupon(){
        this.active_gif = true;
        axios.post('ajax/remove-coupon')
          .then(res => {
            if (res.data.status) {              
              this.loadCart();
              this.$swal(res.data.message);
            }
          }).catch(error => {

          });
      },
      calculateShipping(){
        let data= {
          address : this.cart.address,
          type_shipping : this.type_shipping,
          text_store : this.text_store
        };
        this.active_gif = true;
        var titleElement = document.querySelector('.title_principal');
        axios.post('ajax/calculate-shipping', data)
          .then(res => {
            if(res.data.status){
              this.carrier = res.data.carrier;
              this.gateway = res.data.gateway;
              this.step = 'payment';
              this.loadCart();              
              titleElement.innerHTML = 'Finalizar compra';
            }else{
              this.active_gif = false;
              this.$swal(res.data.message);
            }
          }).catch(error => {

          });
      },
      finalizePurchase(){
        this.active_gif = true;        
         axios.post('ajax/finalize-purchase', this.gateway)
          .then(res => {
            if(res.data.status == true){
              this.url_wompi = res.data.payment.url_pay;
              this.fields_payment = res.data.payment.fields;
              let self = this;
              setTimeout(function(){ self.$refs.form_checkout.submit(); }, 1500);
            }else{
               this.active_gif = false;
              this.$swal(res.data.message);
            }
          }).catch(error => {

          });
      },
      clickBtnBack(){
        var titleElement = document.querySelector('.title_principal');
        if (this.step == 'shipping') {
            this.step = 'cart';
            this.text_btn_back = '';
            this.text_btn_next = 'Ir al envío';
            titleElement.innerHTML = 'Carrito de compra';
            return false;
        }
        if (this.step == 'payment') {
            this.step = 'shipping';
            this.text_btn_back = 'Volver al carrito';
            this.text_btn_next = 'Continuar con el pago';
            titleElement.innerHTML = 'Dirección de envío';
            return false;
        }
      },
      clickBtnNext(){
        var titleElement = document.querySelector('.title_principal');
        if (this.step == 'cart') {
          if(this.cart.step == 'cart'){
            this.buyNow();
          }else{
            this.step = 'shipping';
            this.text_btn_back = 'Volver al carrito';
            this.text_btn_next = 'Continuar con el pago';
            titleElement.innerHTML = 'Dirección de envío';
            return false;
          }
        }
        if (this.step == 'shipping') {
          if (this.type_shipping == 'store' && this.text_store == null) {
            this.$swal('Debe seleccionar una tienda');
            return false;
          }
          this.calculateShipping();
          this.text_btn_back = 'Volver al envío';
          this.text_btn_next = 'Finalizar la compra';
        }
        if (this.step == 'payment') {
          this.finalizePurchase();
        }
      },
			goToProduct(url){
				location.href = url;
			},
      storePickup(){
        if(event.target.checked){
          this.type_shipping = 'store';
          this.cart.store_pickup = 1;
        }else{
          this.type_shipping = 'shipping';
          this.cart.store_pickup = 0;
        }
      },
      selectStore(){
        this.text_store = event.target.options[event.target.options.selectedIndex].dataset.text;
        this.cart.store_pickup = this.text_store;
      }
		}
	}
</script>