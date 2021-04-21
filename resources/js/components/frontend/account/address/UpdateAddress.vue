<template >
 	<div>
   	<div class="row">
        <div class="col col_2 tinymargen">
         <label>Nombre de la dirección (Ej: La oficina)</label>
         <b-form-input v-model.trim="$v.name_address.$model" :state="$v.name_address.$dirty ? !$v.name_address.$invalid : null" autofocus></b-form-input>
         	<label class="error" v-if="!$v.name_address.required && name_address != null">El nombre de la  dirección es requerida</label>
          <label class="error" v-if="!$v.name_address.minLength && name_address != null">El nombre de la dirección debe tener mínimo {{$v.name_address.$params.minLength.min}} caracteres.</label>
        </div>
        <div class="col col_2 tinymargen">
            <label>Departamento</label>
             <b-form-select v-on:change="selectedDepartment($event)" v-model="$v.state.$model" :state="$v.state.$dirty ? !$v.state.$invalid : null"  :options="departments" value-field="id" text-field="name">
             	 	<template #first>
                    <b-form-select-option :value="null" disabled>Departamento</b-form-select-option>
                </template>
                <option v-for="item in departments" :value="item.id">{{ item.name }}</option>
              </b-form-select>
        </div>
    </div>
    <div class="row">
        <div class="col col_2 tinymargen">
         <label>Municipio</label>
          <b-form-select v-model="$v.city.$model" :state="$v.city.$dirty ? !$v.city.$invalid : null">
            <option value="null" selected disabled="disabled">
              Municipio
            </option>
             <option v-for="item in cities" :value="item.id">{{ item.name }}</option>     
          </b-form-select>
        </div>
        <div class="col col_2 tinymargen">
            <label>Dirección</label>
           	<b-form-input v-model.trim="$v.address.$model" :state="$v.address.$dirty ? !$v.address.$invalid : null"></b-form-input>
           	<label class="error" v-if="!$v.address.required && address != null">La dirección es requerida</label>
            <label class="error" v-if="!$v.address.minLength && address != null">La dirección debe tener mínimo {{$v.address.$params.minLength.min}} caracteres.</label>
        </div>
    </div>
    <div class="row">
        <div class="col col_2 tinymargen">
         	<label>Complemento (opcional)</label>
          <b-form-input v-model="complement"></b-form-input>
        </div>
       	<div class="col col_2 tinymargen" style="display: inline-flex;">
         	<!-- <label></label> -->
         	<b-form-checkbox style="margin-top: 29px !important;display: inline-flex;align-items: center;"
			      id="checkbox-1"
			      v-model="principal"
			      :disabled="principal ? true : false"
			    >			      
			    Marcar esta dirección como principal
			    </b-form-checkbox>
        </div>
    </div>
     <div class="row">
        <div class="col col_2 tinymargen">
          <input v-if="!active_gif" type="submit" value="Guardar cambios" class="boton azul full"  @click.prevent="saveAddress">
          <div v-else class="add-cart-gif btn-gif"><span class="spinner"></span></div>
          </div>
          <div class="col col_2 tinymargen">
            <input name="" type="submit" value="Cancelar" class="boton yellow full" @click.prevent="listAddress">
          </div>
    </div>
 	</div>            
</template>

<script>
	import { required, minLength } from 'vuelidate/lib/validators';
	import 'bootstrap-vue/dist/bootstrap-vue.css';
export default{
	props : ['departments', 'data_address'],
	data(){
		return {
			state : null,
			city : null,
			name_address : null,
			address : null,
			complement : null,
			principal : false,
			cities : {},
			active_gif : false,
			user : {}
		}
	},
	validations: {
    	state: {required},
    	city: {required},
    	address: {required, minLength: minLength(5)},
    	name_address: {required, minLength: minLength(5)},
	},
	mounted(){		 	
			this.state = this.data_address.state_id;
			this.name_address = this.data_address.name_address;
			this.address = this.data_address.address;
			this.complement = this.data_address.complement;
			this.selectedDepartment(this.state);			
			this.city = this.data_address.city_id;
			this.principal = this.data_address.principal == 1 ? true : false;
	},
	created(){
	},
	methods:{	
		selectedDepartment(event){
			this.city = null;
			let state	= event;
			axios.get(`ajax/cities/${state}`)
          .then(res => {
              this.cities = res.data;
              return false;
      		})
			},	
			saveAddress(){
					this.$v.$touch();
					if (this.$v.$invalid) {
		       	return false;
		      }else{
		      	this.active_gif = true;
		      	let data = {
		      		id : this.data_address.id,
		      		name_address : this.name_address,
		      		address : this.address,
		      		complement : this.complement,
		      		state_id : this.state,
		      		principal : this.principal,
		      		city_id : this.city,
		      	};
		      	axios.post(`ajax/update-address`, data).then(response => {
	      		this.active_gif = false;	      		
	      		if (response.data.status == 'update') {
	      				this.$swal({  
								 	icon: 'success',
	  							title: response.data.message, 
	  							confirmButtonText: 'Aceptar',
								});
								this.$store.state.user = response.data.user;
								this.listAddress();
	      		}else{	      			
	      			this.$swal({  
							 	icon: 'error',
  							title: response.data.message, 
  							showCancelButton: false,
  							confirmButtonText: 'Aceptar',
							});
	      		}

	      	});

		      }
			},
			listAddress(){
					this.$router.push({
	           name : 'list_address',
	           params : {departments : this.departments}
	      	});
			}
	}
}
 
</script>

