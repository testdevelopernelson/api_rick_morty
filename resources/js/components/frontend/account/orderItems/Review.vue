<template>
  <section>
  	<div class="bl_mcnta_w">
      <div class="container_sd">
        <h2>Califica tu producto</h2>
      </div>      
    </div>

    <div class="bl_cdes">
      <div class="container_sd">
        <div class="bl_cdes_all">
          <div class="cdes_box">
            <div class="cdes_box-img">
              <div>
                <img :src="`${base}/img/product1.png`" alt="" />
              </div>
            </div>
            <div class="cdes_box-txt">
              <h2 class="upper-case">{{ item.product.nombre }}</h2>
              <h3>Código: {{ item.product.codigo }}</h3>
              <h3 v-if="item.product.SKU != ''">SKU: {{ item.product.SKU }}</h3>
            </div>
            <div class="cdes_box-txt2">
              <h4>Calificación</h4>
              <div class="bm_rese_s st1">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
              </div>
            </div>
            <div class="cdes_box-txt3">
              <h4>Califica tu producto</h4>
              <div class="cdes_box-txtar">
              	 <b-form-textarea
						       	placeholder="Escriba una breve descripción de su experiencia con el producto."
							      v-model="text"
							      rows="3" v-model.trim="$v.text.$model" :state="$v.text.$dirty ? !$v.text.$invalid : null" autofocus
							    ></b-form-textarea>
              </div>
          		<p class="error" v-if="!$v.text.required && text != null">Ingrese el texto</p>
      		    <p class="error" v-if="!$v.text.minLength && text != null">La calificación debe tener mínimo {{$v.text.$params.minLength.min}} caracteres.</p>
              <div class="bl_crnt_l">
	              <div class="bl_crnt_s">
	                <a v-if="!active_gif" href="javascript:void()" class="mcnta_lk cursor" @click.prevent="saveReview">Enviar calificación</a>
                  <a v-else class="mcnta_lk cursor btn-gif"><span class="spinner"></span></a>
	              </div>
	              <div class="bl_crnt_s">
	                <a class="mcnta_lk2 btn-yellow cursor" @click="listItems">Cancelar</a>
	              </div>
	            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>	               
</template>
<script>
import { required, minLength } from 'vuelidate/lib/validators';
import 'bootstrap-vue/dist/bootstrap-vue.css';
export default{
	props : ['item'],
	data(){
		return {
      base : window.base_url,
      text : null,
      qualification : 3,
      user : {},
      order : {},
      active_gif : false,
		}
	},
	validations: {
    	text: {required, minLength: minLength(10)},
	},
	mounted(){
		 this.user = this.$store.state.user;
		 this.order = this.$store.state.order;
	},
	created(){
		
	},
	methods:{	
		listItems(){
			this.$router.push({
           name : 'list_items',
           params : {reference: this.order.reference}
      });
		},
		saveReview(){
			this.$v.$touch();
			if (this.$v.$invalid) {
       	return false;
      }else{
      	this.$swal({
          icon: 'question',
          title: '¿Está seguro de calificar este producto?',
          showCancelButton: true,
          cancelButtonText: 'No',
          confirmButtonText: 'Si'
          }).then((result) => {
              if(result.value){ 
                 this.active_gif = true;
                let data = {
				      		_reference : this.order.reference,
				      		codigo_product : this.item.codigo_product,
				      		customer_id : this.user.id,
				      		text : this.text,
				      		qualification : this.qualification,
				      		_order_item_id : this.item.id,
				      	};

				    	 	axios.post(`ajax/create-review`, data).then(response => {
                   this.active_gif = false;
							      if (response.data.status == 'save') {
							      	this.$store.state.order = response.data.order;
							      	this.$swal({  
											 	icon: 'success',
				  							title: response.data.message, 
				  							confirmButtonText: 'Aceptar',
											}).then((result) => {
			                    if(result.value){
			                     this.listItems();
			                    }
			                });
							      	
							      }
				      	});
              }
         });
      	
      }
    }
	}
}
 
</script>

