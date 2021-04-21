<template>
  <div class="cols marcos"> 
    <div class="col col_2 item marco cyan item-address" v-for="(item, index) in user_address">
      <span class="tag-principal" v-if="item.principal"></span>
      <div class="borde">
        <div class="pads">
          <img :src="`${base}/img/icons/ico_house.png`">
          <p style="text-align: left;">
             {{ item.name_address }}<br/>
             {{ item.address }}  <span style="color:#fff;" v-if="item.complement != null">({{ item.complement }})</span><br/>
             {{ item.state.name + ' - ' +  item.city.name }}<br/>
             Celular: {{ user.mobile }}<br/>
             <span style="color:#fff;" v-if="user.phone != null">Teléfono: {{ user.phone }}</span>
          </p>
          <div class="cols">
              <div class="col col_2">
                  <a href="#" target="_self" class="boton azul"  @click.prevent="updateAddress(item)">Editar Datos</a>
              </div>
              <div class="col col_2">
                  <a v-if="user_address.length > 1" href="#" target="_self" class="boton azul" @click.prevent="deleteAddress(item)">Eliminar Dirección</a>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col col_2 marco">
        <div class="borde">
        <a href="#" target="_self" class="agregar" @click.prevent="createAddress">Agregar nueva dirección</a>
        </div>
    </div>
  </div>	               
</template>

<script>
export default{
	props : ['departments'],
	data(){
		return {
      base : window.base_url,
      user_address : [],
      user : {}
		}
	},
	mounted(){
    this.user_address = this.$store.state.user.address;
    this.user = this.$store.state.user;
	},
	created(){
	},
	methods:{	
		  updateAddress(item){
        this.list_address = false;
        this.$router.push({
             name : 'update_address',
             params : {departments : this.departments, data_address : item}
        });
      },
      createAddress(){
        this.list_address = false;
        this.$router.push({
             name : 'create_address',
             params : {departments : this.departments, view : 'account'}
        });
      },
      deleteAddress(item){
        let id = item.id;
        this.$swal({
          icon: 'question',
          title: '¿Está seguro de eliminar esta dirección?',
          showCancelButton: true,
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Aceptar'
          }).then((result) => {
              if(result.value){ 
                 axios.delete(`/ajax/delete-address/${id}`)
                  .then(response => {
                       if(response.data.status == 'delete'){
                          this.$swal({  
                            icon: 'success',
                            title: response.data.message, 
                            confirmButtonText: 'Aceptar',
                          });
                          this.user_address = response.data.user.address;
                       }
                  })
              }
         });
      }
	}
}
 
</script>

