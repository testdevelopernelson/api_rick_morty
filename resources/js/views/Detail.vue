<template>
<div class="login">
<div class="row">
    <div class="cols">
  	  <img class="img-back" :src="`${base}/img/arrow-left.svg`" alt="" />
    	<a href="" class="btn-back azul" @click.prevent="$router.go(-1)">Volver</a>
      <div class="detail">
      	<div class="image">
	    		<img :src="item.image" alt="">	    		
	      	<h1 class="title">{{ item.name }}</h1>	      	
	    	</div>
	    	<div class="info">
    		<input type="button" class="boton azul small" value="Agregar a mis favoritos" v-if="btn_favorite == 'add'" @click.prevent="addFavorite">
    		<input type="button" class="boton azul small" value="Quitar de mis favoritos" v-else @click.prevent="removeFavorite">
	      <label><strong>Status: </strong>{{ item.status }}</label>
	      <label><strong>Especie: </strong>{{ item.species }}</label>
	      <label v-if="item.type != ''"><strong>Tipo: </strong>{{ item.type }}</label>
	      <label><strong>Género: </strong>{{ item.gender }}</label>
	      <label><strong>Origen: </strong>{{ item.origin.name }}</label>
	      <label><strong>Ubicación: </strong>{{ item.location.name }}</label>
	      <label><strong>Cantidad de episodios: </strong>{{ item.episode.length }}</label>
	      </div>
      </div>             
    </div>
</div>
 <div v-if="active_gif" class="add-cart-gif btn-gif"><span class="spinner"></span></div>
</div>
</template>
<script>
	export default{
		props : ['item', 'view'],
		data(){
			return{
					base : window.base_url,
					user: {},
				 	active_gif : false,
				 	btn_favorite : 'add',
				}
		},	
  	created(){  		
  		this.user = this.$store.state.user;
  		if (this.view != 'list') {
  			this.btn_favorite = 'remove';
  		}else{
  			let self = this;
  			this.user.favorites.forEach(function(item){        
			 		if (item.ref_api == self.item.id) {
			 			self.btn_favorite = 'remove';
			 			return false;
			 		}
			  });
  		}		 	
  	},
		methods:{
			addFavorite(){
				this.active_gif = true;
	      axios.post('ajax/add-favorite', {ref_api : this.item.id})
		     	.then(response => {	 
		     			this.btn_favorite = 'remove';
              this.active_gif = false;
              this.$store.state.user.favorites.push({usuario_id : this.$store.state.user.id, ref_api :  this.item.id});
           		this.$bvToast.toast(response.data.message, {
			          title: false,
			          toaster: 'b-toaster-bottom-right',
			          variant: 'info',
			          solid: true,
			          noCloseButton: true,
			          autoHideDelay : 2000
			        })  
		     	}).catch(error => {
		     			this.active_gif = false;
              if(error.response.status == 422){
                console.log('Ha ocurrido un error');
              }
				});
			},
			removeFavorite(){
				this.active_gif = true;
	      axios.delete(`ajax/delete-favorite/${this.item.id}`)
		     	.then(response => {	 
		     			this.btn_favorite = 'add';
              this.active_gif = false;
              let self = this;
              this.$store.state.user.favorites.forEach(function(value, index){
		              if(value.ref_api == self.item.id){
		                  self.$store.state.user.favorites.splice(index, 1);
		                 	return false;
		             	}
           		});
              this.$bvToast.toast(response.data.message, {
			          title: false,
			          toaster: 'b-toaster-bottom-right',
			          variant: 'info',
			          solid: true,
			          noCloseButton: true,
			          autoHideDelay : 2000
			        })
		     	}).catch(error => {
		     			this.active_gif = false;
              if(error.response.status == 422){
                console.log('Ha ocurrido un error');
              }
				});
			}
		}
	}
</script>

