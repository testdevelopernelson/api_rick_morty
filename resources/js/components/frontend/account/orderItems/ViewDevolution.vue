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
                <span class="status" :style="{background : item.item_devolution.status.color}">{{ item.item_devolution.status.name }}</span>
                <h3>Código: {{ item.product.codigo }}</h3>
                <h3 v-if="item.product.SKU != ''">SKU: {{ item.product.SKU }}</h3>
              </div>
            </div>
            <div class="cdes_box-txt">
              <div class="cdes_box_scn">
                <h4>Motivo del cambio o devolución : <strong>{{ item.item_devolution.devolution.title }}</strong></h4>
                <h4>Imagen de factura o de producto</h4>
                <strong><a :href="`${base}/uploads/${item.item_devolution.file}`" target="_blank">Ver Documento cargado</a></strong><br>
                <strong v-if="item.item_devolution.observation_status != null" class="cursor" v-on:click.prevent="eventDevolutions"><a href="" target="_blank">Ver Observaciones del estado</a></strong>
                <div v-if="show_devolutions">
                  <p class="observations">{{ item.item_devolution.observation_status }}</p>
                </div>
              </div>
            </div>
            <div class="cdes_box-txt">
              <h4>Detalles del cambio</h4>
              <div class="cdes_box-txtar">
                <textarea rows="3" readonly="">{{ item.item_devolution.text }}</textarea>
              </div>
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
            <a class="btn-yellow cursor" @click="listItems">Cancelar</a>
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
      user : {},
      order : {},
      show_devolutions :false,
		}
	},
	validations: {
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
    eventDevolutions(){
      if (this.show_devolutions) {
        this.show_devolutions = false;
      }else{
        this.show_devolutions = true;
      }
    }
	}
}
 
</script>

