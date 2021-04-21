<template>
	<div class="col-lg-12 col-sm-12">
		<ul class="nav nav-tabs  mb-3 mt-3" id="simpletab" role="tablist">
	      <li class="nav-item">
	          <a class="nav-link active" id="tab1-tab" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">Opciones</a>
	      </li>
	  </ul>
	 	<div class="tab-content" id="pills-tabContent">                    
      <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
				<div class="row item-options" v-for="item in options ">
	        <div class="form-group col-lg-4 col-xs-12">
	          <label for="name">Opción</label>
	          <input type="text" class="form-control" v-model="item.name">
	        </div> 
	        <div class="form-group col-lg-4 col-xs-12" v-if="attribute.type == 'color'">
	          <label for="name">Color</label>
	          <input type="text" class="form-control" :id="'opt_'+item.id" v-model="item.code" >
	        </div>
	         <div class="form-group col-lg-4 col-xs-12 btns">
	         	<br>
	          <button class="btn btn-primary"><img :src="`${base}/mng/img/save.svg`" alt=""></button>
	          <button class="btn btn-danger"><img :src="`${base}/mng/img/trash-white.svg`" alt=""></button>
	        </div>
	      </div>
	      <div class="row">

	      	<h1 v-if="options.length == 0">No hay opciones agregadas</h1>
	      	<div class="col-lg-12 col-sm-12">
	      		<button class="btn btn-primary" @click="addOption"><img :src="`${base}/mng/img/plus.svg`" alt=""> Agregar</button>
	      		</div>
	      </div>
	  	</div>
		</div>
	</div>
</template>
<script>
// import jscolor from './../plugins/jscolor/jscolor.js';
	export default{
		props:{attribute:{type:Object,required:true}},
		data(){
			return {
				base : window.base_url,
				options : []
			}
		},
		mounted(){
			this.options = this.attribute.options;
		},
		methods : {
			addOption(){
				this.options.push({id : null, name : '', code : null, attribute_id : this.attribute.id, order : 0});
			}
		}
	}
</script>