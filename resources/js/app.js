require('./bootstrap');

window.Vue = require('vue');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)

import Vuex from 'vuex'
Vue.use(Vuex)

import VueSweetalert2 from 'vue-sweetalert2';

import 'sweetalert2/dist/sweetalert2.min.css';
const options = {
  confirmButtonColor:'#0a51a1',
  cancelButtonColor: '#757575' 
};
Vue.use(VueSweetalert2 , options);

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

import router from './routes'

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('app', require('./components/App.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const store = new Vuex.Store({
	state : {
		user : {},
		auth : false,
		devolutions : {},
		prueba : 0
	}, 
	mutations : {

	},
	getters:{
		getUser : state => {
			return state.user
		}
	}
});

const app = new Vue({
    el: '#app',
    router,
    store,
    methods : {
       
    }
});
