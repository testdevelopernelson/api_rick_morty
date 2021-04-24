<template>
	<div>
			<header class="row" id="header">
				<div class="row superior">
				  <div class="cols">
				      <!--======================-->
				      <a class="logo" target="_self" @click="home">
				          <img src="img/logo-el-lab.png">
				      </a>
				      <div class="primaries">
				          <div class="contenedor parent_menu_cuenta">          
				            <div v-if="$store.state.auth">
				                <a href="#" target="_self" class="primary"  @click.prevent="ListPokeapi">Rick y Morty</a>
				                <a href="#" target="_self" class="primary"  @click.prevent="profile">Mi perfil</a>
				                <a href="#" target="_self" class="primary" @click.prevent="logout">Cerrar sesion</a>
				            </div>
				            <a v-else target="_self" class="primary" @click="login">Iniciar sesión</a>
				          </div>         
				          <!--======================-->
				      </div>
				      <!--======================-->
				  </div> 
				</div>
		</header>
		<transition	name="fade-slide" mode="out-in">	
 			<router-view :key="$route.fullPath"></router-view>
 		</transition>		
	</div>
</template>
<script>
	export default{
		props : ['auth', 'user'],
		data(){
			return{
			}
		},	
  	created(){
  		this.$store.state.auth = this.auth;
  		this.$store.state.user = this.user;
  		if (!this.auth) {
  			this.$router.push({
           name : 'login',
           params : {}
        });
  		}else{
  			this.$router.push({
           name : 'list_api',
           params : {}
        });
  		}
  		if (this.$route.name == null) {
  			this.$router.push({
           name : 'home',
           params : {}
        });
  		}
  	},
		methods:{
		 	logout(){
		 		this.$nextTick(function () {
       		setTimeout(function(){
  			 		$('#frm-logout').submit();
			 		}, 500);
             
      	});
		 	},
		 	login(){
		 		if (this.$route.name === 'login') {
		 			return false;
		 		}
		 		this.$router.push({
           name : 'login'
        });
		 	},
		 	home(){
		 		if (this.$route.name === 'home') {
		 			return false;
		 		}
		 		this.$router.push({
           name : 'home'
        });
		 	},
		 	ListPokeapi(){
		 		if (this.$route.name === 'list_api') {
		 			return false;
		 		}
		 		this.$router.push({
           name : 'list_api'
        });
		 	},
		 	profile(){
		 		if (this.$route.name === 'profile') {
		 			return false;
		 		}
		 		this.$router.push({
           name : 'profile'
        });
		 	}
		}
	}
</script>

