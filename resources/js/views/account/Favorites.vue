<template>
	<div class="row page account" id="list-api">
	 		<div class="menu-profile">
    	 <div class="col col_1">
    	 		<ul>
    	 			<li><a href=""  @click.prevent="profile">Datos personales</a></li>
    	 			<li><a href="" class="active">Mis favoritos</a></li>
    	 		</ul>
    	 	</div>
	 	</div>
    <div class="cols">
      <h1 class="title">Mis favoritos</h1>
      <div class="items">
        <div class="item" v-for="item in list.results">
          <img class="avatar" :src="item.image" alt="">
          <label for="">{{ item.name }}</label>
          <button @click.prevent="detail(item)">Mostrar detalles</button>
        </div>
      </div>             
    </div>
    <div v-if="active_gif" class="add-cart-gif btn-gif"><span class="spinner"></span></div>
</div>
</template>
<script>
	export default{
		props : [],
		data(){
			return{
				user : {},
			 	active_gif : true,
				ref_api : [],
				url_api : null,
				list : {
            info : {},
            results : [],
       	}, 
			}
		},
		mounted(){
			this.user = this.$store.state.user;
			console.log(this.user)
			let self = this;
		  this.user.favorites.forEach(function(item){        
		 		self.ref_api.push(item.ref_api);
		  });
		  this.url_api = `https://rickandmortyapi.com/api/character/[${this.ref_api}]`;
		  console.log(this.url_api)
		  this.getListapi();
		},
		methods:{
			getListapi(){
	      axios.get(this.url_api)
		     	.then(response => {	 
              this.active_gif = false;
              this.list.results = response.data; 
		     	}).catch(error => {
		     			this.active_gif = false;
              if(error.response.status == 422){
                console.log('Ha ocurrido un error');
              }
				});
			},
			detail(item){
        this.$router.push({
           name : 'view_detail',
           params : {id : item.id,item : item, view : 'favorites'}
        });
      },
			profile(){
		 		this.$router.push({
           name : 'profile',
           params : {}
        });
		 	}
		}
	}
</script>


