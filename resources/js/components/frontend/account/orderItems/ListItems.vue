<template>
  <section>
   <div class="bl_mcnta_w">
          <div class="container_sd">
            <h2>Productos</h2>
          </div>
    </div>   
    <div class="bl_micnta3">
      <div class="container_sd">
        <div class="lst_pedidos_cu" v-for="item in items">
          <div class="lst_pedidos_1">
            <h4 class="upper-case"><a :href="item.url_product">{{ item.name }}</a></h4>
            <p>Precio Total: {{ item.total }}</p>
            <p>Cantidad: {{ item.quantity }}</p>
          </div>
         <div class="blst_pedidos_22">
            <a v-if="!item.has_review" class="cursor" @click="review(item)">Calíficar</a>
            <div v-else class="bm_rese_s st1">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div v-if="!item.has_devolution" class="pedidos_select22">
              <select  name="devolution_id" id="" @change="devolution(item)">
                <option value="null" selected disabled="disabled">
                  Devolución
                </option>
                <option :value="item.id" v-for="item in devolutions">{{item.title}}</option>
              </select>             
            </div>
             <a v-else="" class="cursor" @click="viewDevolution(item)">Ver Devolución</a>
          </div>
        </div>
       
      </div>
    </div>
    </section>	               
</template>
<script>
export default{
	props : [],
	data(){
		return {
      base : window.base_url,
      items : [],
      item : {},
      order : {},
      devolution_id : null,
      devolutions : {},
		}
	},
	mounted(){
    this.order = this.$store.state.order;
    this.devolutions = this.$store.state.devolutions;
    this.items = this.order.items;
	},
	created(){
	},
	methods:{	
    review(item){
       axios.post(`ajax/order-item`, {id : item.id}).then(response => {
          this.item = response.data.item; 
          this.$router.push({
             name : 'review',
             params : {reference: this.order.reference, item : this.item}
        });
      });      
    },
    devolution(item){
        this.devolution_id = event.target.value;
       axios.post(`ajax/order-item`, {id : item.id}).then(response => {
          this.item = response.data.item;
          this.$router.push({
             name : 'devolution',
             params : {reference: this.order.reference, item : this.item, id_devolution : this.devolution_id}
        });
      });      
    },
    viewDevolution(item){
        axios.post(`ajax/order-item`, {id : item.id}).then(response => {
          this.item = response.data.item;
          this.$router.push({
             name : 'view_devolution',
             params : {reference: this.order.reference, item : this.item}
        });
      });      
    }
	}
}
 
</script>

