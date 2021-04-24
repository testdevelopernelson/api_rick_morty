<template>
<div class="login" id="list-api">
<div class="row">
    <div class="cols">
      <h1 class="title" >Rick y Morty</h1>
      <div class="items">
        <div class="item" v-for="item in list.results">
          <img class="avatar" :src="item.image" alt="">
          <label for="">{{ item.name }}</label>
          <button @click.prevent="detail(item)">Mostrar detalles</button>
        </div>
        <div class="paginator" v-if="list.results.length > 0">
          <button v-if="list.info.prev != null" @click.prevent="prevPage">Anterior</button>
          <button v-if="list.info.next != null" @click.prevent="nextPage">Siguiente</button>
        </div>
      </div>             
    </div>
</div>
  <router-view></router-view>
 <div v-if="active_gif" class="add-cart-gif btn-gif"><span class="spinner"></span></div>
</div>
</template>
<script>
	export default{
		props : [],
		data(){
			return{
					 active_gif : true,
           url_api : 'https://rickandmortyapi.com/api/character/',
           list : {
            info : {},
            results : [],
           },           
				}
		},	
  	created(){
  		this.getListapi();
  	},
		methods:{
			getListapi(){
	      axios.get(this.url_api)
		     	.then(response => {	 
              this.active_gif = false;
              this.list = response.data;
              let self = this;
              this.$nextTick(() => {
                var position = $("#list-api").offset().top - 50;
                $('html, body').animate( {scrollTop : position}, 1000 );
             })  
		     	}).catch(error => {
		     			this.active_gif = false;
              if(error.response.status == 422){
                console.log('Ha ocurrido un error');
              }
				});
			} ,
      detail(item){
        this.$router.push({
           name : 'view_detail',
           params : {id : item.id,item : item, view : 'list'}
        });
      },
      prevPage(){
        this.url_api = this.list.info.prev;
        this.getListapi();
      },
      nextPage(){
        this.url_api = this.list.info.next;
        this.getListapi();
      },
		}
	}
</script>

