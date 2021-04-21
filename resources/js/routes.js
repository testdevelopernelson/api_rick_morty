import Vue from 'vue'
import Router from 'vue-router'
 
Vue.use(Router)

export default new Router({
	routes : [
		{
			path: 'perfil',
			name: 'update_address',
			component : require('./components/frontend/account/address/UpdateAddress').default,
			props: true
		},
		{
			path: 'perfil',
			name: 'list_address',
			component : require('./components/frontend/account/address/ListAddress').default,
			props: true
		},
		{
			path: 'perfil',
			name: 'create_address',
			component : require('./components/frontend/account/address/CreateAddress').default,
			props: true
		},
		{
			path: ':reference',
			name: 'list_items',
			component : require('./components/frontend/account/orderItems/ListItems').default,
			props: true
		},
		{
			path: ':reference',
			name: 'review',
			component : require('./components/frontend/account/orderItems/Review').default,
			props: true
		},
		{
			path: ':reference',
			name: 'devolution',
			component : require('./components/frontend/account/orderItems/Devolution').default,
			props: true
		},
		{
			path: ':reference',
			name: 'view_devolution',
			component : require('./components/frontend/account/orderItems/ViewDevolution').default,
			props: true
		}
	],
	mode: 'history'
})