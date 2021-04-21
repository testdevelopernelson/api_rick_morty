require('./bootstrap');

window.Vue = require('vue');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import Vuelidate from 'vuelidate'
Vue.use(Vuelidate)


import VueMask from 'v-mask'
Vue.use(VueMask)

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

Vue.component('create-account', require('./components/frontend/account/CreateAccount.vue').default);
Vue.component('login', require('./components/frontend/account/Login.vue').default);
Vue.component('my-account', require('./components/frontend/account/myAccount.vue').default);
Vue.component('change-password', require('./components/frontend/account/ChangePassword.vue').default);
Vue.component('forgot-password', require('./components/frontend/account/ForgotPassword.vue').default);
Vue.component('order-items', require('./components/frontend/account/OrderItems.vue').default);
Vue.component('add-favorite', require('./components/frontend/products/AddFavorite.vue').default);
Vue.component('count-favorite', require('./components/frontend/products/CountFavorite.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const store = new Vuex.Store({
	state : {
		user : {},
		order : {},
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
       incrementfavorite : function(value){
         this.$refs.count_favorite.count += value;
        
       }
    }
});
