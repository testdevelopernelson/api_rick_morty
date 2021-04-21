<template>
   <div>
   		<div class="micnta_cu" v-for="(item, index) in user_address">
        <span class="address-principal"></span>
        <p>{{ item.name_address }}</p>
        <p>{{ item.address }}</p>
        <p v-if="item.mobile != ''">Celular: {{ user.mobile }}</p>
        <p v-if="item.phone != ''">Teléfono: {{ user.phone }}</p>
        <p>{{ item.state.name + ' - ' +  item.city.name }}</p>
        <a class="cursor" @click.prevent="selectAddressCart(item)">
          <img :src="`${base}/img/icons/icn_edits.svg`" alt="" />Seleccionar dirección
        </a>      
      </div>
       <div v-if="active_gif" class="add-cart-gif btn-gif"><span class="spinner"></span></div>
  </div>
 
	               
</template>

<script>
export default{
	props : [],
	data(){
		return {
      base : window.base_url,
      user_address : [],
      user : {},
      active_gif : false
		}
	},
	mounted(){
    console.log('estoy aca')
    this.user_address = this.$store.state.user.address;
    this.user = this.$store.state.user;
	},
	created(){
	},
	methods:{	
		selectAddressCart(item){
      this.active_gif = true;
			axios.post(`ajax/change-address-cart`, {id : item.id})
      .then(res => {
      	if (res.data.status) {
    		  setTimeout(function(){ 
            this.active_gif = false;
            location.reload();
          }, 500);
      	}
        
  		})
			
		}
	}
}
 
</script>

