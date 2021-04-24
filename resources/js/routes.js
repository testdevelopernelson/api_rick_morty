import Vue from 'vue'
import Router from 'vue-router'
 
Vue.use(Router)

export default new Router({
	routes : [
		{
			path: '/', 
			name: 'home',
			component : require('./views/Home').default
		},
		{
			path: '/login', 
			name: 'login',
			component : require('./views/account/Login').default
		},
		{
			path: '/crear-una-cuenta', 
			name: 'create_acount',
			component : require('./views/account/CreateAccount').default
		},
		{
			path: '/mi-perfil', 
			name: 'profile',
			component : require('./views/account/Profile').default
		},
		{
			path: '/mi-favoritos', 
			name: 'favorites',
			component : require('./views/account/Favorites').default,
			props: true
		},
		{
			path: '/listado-de-personajes',
			name: 'list_api',
			component : require('./views/Listapi').default
		},
		{
			path: '/personaje/:id',
			name: 'view_detail',
			component : require('./views/Detail').default,
			props: true
		},
		// {
		// 	path: '/listado-de-personajes',
		// 	name: 'list_api',
		// 	component : require('./views/Listapi'),
		// 	children : [
		// 		{
		// 			path: 'prueba',
		// 			name: 'prueba',
		// 			component : require('./views/account/Profile'),
		// 			props: true,
		// 		}
		// 	]
		// },
		
	],
	mode: 'history' //Evita que me aparezca el # en las rutas
})