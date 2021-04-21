<template>
  <section>
     <div class="bl_mcnta_w">
      <div class="container_sd">
        <h2>Cambios y devoluciones</h2>
      </div>
    </div>

    <div class="bl_cdes">
      <div class="container_sd">
        <div class="bl_cdes_all">
          <div class="cdes_box cdes_box_ds">
            <div class="cdes_box_frst">
              <div class="cdes_box-img">
                <div>
                   <img :src="`${base}/img/product1.png`" alt="" />
                </div>
              </div>
              <div class="cdes_box-titl">
                <h2 class="upper-case">{{ item.product.nombre }}</h2>
                <h3>Código: {{ item.product.codigo }}</h3>
                <h3 v-if="item.product.SKU != ''">SKU: {{ item.product.SKU }}</h3>
              </div>
            </div>
            <div class="cdes_box-txt">
              <div class="cdes_box_scn">
                <h4>Motivo del cambio o devolución</h4>
                <div class="pedidos_select22">
                   <b-form-select v-model="$v.devolution_id.$model" :devolution_id="$v.devolution_id.$dirty ? !$v.devolution_id.$invalid : null"  :options="devolutions" value-field="id" text-field="title">
                      <template #first>
                        <b-form-select-option :value="null" disabled>Elija una opción</b-form-select-option>
                      </template>
                      <!-- <option v-for="item in devolutions" :value="item.id">{{ item.title }}</option> -->
                    </b-form-select>
                </div>
                <h4>Adjuntar imagen de factura o de producto</h4>
                <div class="pedidos_file22">
                  <b-form-file
                   v-model.trim="$v.file.$model" :state="$v.file.$dirty ? !$v.file.$invalid : null" plain>                     
                   </b-form-file>
                </div>
                <p class="error" v-if="!$v.text.required && text != null">El archivo es requerido</p>
              </div>
            </div>
            <div class="cdes_box-txt">
              <h4>Detalles del cambio</h4>
              <div class="cdes_box-txtar">
                <b-form-textarea
                    class="form-control info"
                    placeholder="Escriba una breve descripción de por qué desea hacer el cambio."
                    v-model="text"
                    rows="3" v-model.trim="$v.text.$model" :state="$v.text.$dirty ? !$v.text.$invalid : null" autofocus
                  ></b-form-textarea>
              </div>
              <p class="error" v-if="!$v.text.required && text != null">Ingrese el texto</p>
              <p class="error" v-if="!$v.text.minLength && text != null">La calificación debe tener mínimo {{$v.text.$params.minLength.min}} caracteres.</p>
            </div>
          </div>
        </div>
        <!-- <div class="bl_cdes_r">
          <h3>Opciones de cambio</h3>
          <div class="bl_cdes_rad">
            <input type="radio" />
            <label for="">
              <strong>Cambio de producto</strong> <br />
              Cambia por el mismo producto que consta en el pedido.
            </label>
          </div>
          <div class="bl_cdes_rad">
            <input type="radio" />
            <label for="">
              <strong>Cupón de compra</strong> <br />
              Te enviamos un cupón por el valor del producto para hacer otra
              compra.
            </label>
          </div>
        </div> -->
      </div>
    </div>

    <div class="bl_cdes2">
      <div class="container_sd">
        <div class="bl_cdes2_bx">
          <h2>Atención:</h2>
          <p>
            El cupón de cambio solamente será liberado una vez que nuestro
            Control de Calidad ha corroborado el buen estado del producto a
            cambiar. El uso del cupón de cambio está relacionado a la cuenta de
            correo del titular del pedido
          </p>
          <p>
            Tu cupón de cambio puede ser usado una sola vez, por eso el valor de
            tu futura compra debería ser igual o superior al valor del cupón de
            cambio. La diferencia en el valor puede ser complementada con
            cualquier método de pago disponible directamente en nuestro sitio
            web. La validez del cupón de cambio es por 180 días corridos desde
            la fecha de emisión.
          </p>
        </div>
        <div class="bl_crnt_l">
          <div class="bl_crnt_s">
            <a href="javascript:void()" v-if="!active_gif" class="mcnta_lk cursor" @click.prevent="saveDevolution">Solicitar cambio</a>
            <a v-else class="mcnta_lk cursor btn-gif"><span class="spinner"></span></a>
          </div>
          <div class="bl_crnt_s">
            <a class="mcnta_lk2 btn-yellow cursor" @click="listItems">Cancelar</a>
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
	props : ['item', 'id_devolution'],
	data(){
		return {
      base : window.base_url,
      text : null,
      file : null,
      devolution_id : null,
      devolutions : {},
      user : {},
      order : {},      
      active_gif : false,
		}
	},
	validations: {
      devolution_id: {required},
      file: {required},
    	text: {required, minLength: minLength(10)},
	},
	mounted(){
		 this.user = this.$store.state.user;
		 this.order = this.$store.state.order;
     this.devolution_id = this.id_devolution
     this.devolutions = this.$store.state.devolutions;
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
		saveDevolution(){
			this.$v.$touch();
			if (this.$v.$invalid || !this.validateFile()) {
       	return false;
      }else{

      	this.$swal({
          icon: 'question',
          title: '¿Está seguro de iniciar proceso de devolución?',
          showCancelButton: true,
          cancelButtonText: 'No',
          confirmButtonText: 'Si'
          }).then((result) => {
              if(result.value){ 
                this.active_gif = true;
                let formData = new FormData();
                formData.append('_file', this.file);
                formData.append('_reference', this.order.reference);
                formData.append('codigo_product', this.item.codigo_product);
                formData.append('devolution_id', this.devolution_id);
                formData.append('text', this.text);
                formData.append('order_item_id', this.item.id);

				    	 	axios.post(`ajax/create-devolution`, formData).then(response => {
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
    },
    validateFile(){
      let message = '';
      if (this.file.size > 3145728) {
          this.$swal({  
            icon: 'error',
            title: 'Tamaño máximo permitido es de 3MB', 
            showCancelButton: false,
            confirmButtonText: 'Aceptar',
          });
          return false;
      }else{
        return true;
      }
    }
	}
}
 
</script>

