<script>
	export default{
		props : ['auth', 'url_login'],
		data(){
      return {
      	product : {
      		codigo : null , 
      		complete: false
      	}, 
      	add_favorite: true,
      	login_for_add : false
      }
		},
		mounted(){
			if(!this.auth){
        this.login_for_add = true;
      }
		},
		methods : {
			addToFavorite(codigo){
				if(this.login_for_add){
          this.$swal({  
					 	icon: 'info',
						title: 'Para agregar a los favoritos es necesario iniciar sesión', 
					 	showCancelButton: true,
          	cancelButtonText: 'Cancelar',
						confirmButtonText: 'Iniciar sesión',
					}).then((result) => {
		          if(result.value){
		  			 	 	location.href = this.url_login;;
		          }
		      });
		      return false;
        }
				let data = {
					codigo : codigo				
				};
				this.add_favorite = false; 
				this.addFavorite(data);
			},
			addToFavorite1(codigo){
				let data = {
					codigo : codigo				
				};
				this.add_favorite = true; 
				this.addFavorite(data);
			},
			addFavorite(data){
				axios.post('ajax/add-to-favorite' ,data)
          .then(res => {
          	if(res.data.status == true){ 
          		this.$bvToast.toast('Producto agregado a los favoritos', {
			          title: false,
			          toaster: 'b-toaster-bottom-right',
			          variant: 'info',
			          solid: true,
			          noCloseButton: true,
			          autoHideDelay : 2000
			        })
          		this.$root.incrementfavorite(1);
          	}
         })
      },
			removeToFavorite(codigo){
				let data = {
					codigo : codigo,					
				};
				this.add_favorite = true; 
				this.removeFavorite(data);
			},
			removeToFavorite1(codigo){
				let data = {
					codigo : codigo,					
				};
				this.add_favorite = false; 
				this.removeFavorite(data);
				
			},
			removeFavorite(data){
				axios.post('ajax/remove-to-favorite' ,data)
		        .then(res => {
	        	if(res.data.status == true){ 
            		this.$root.incrementfavorite(-1);
          		this.$bvToast.toast('Producto eliminado de los favoritos', {
			          title: false,
			          toaster: 'b-toaster-bottom-right',
			          variant: 'info',
			          solid: true,
			          noCloseButton: true,
			          autoHideDelay : 3000
			        })
          	}
       	})
      }
		}
	}
</script>