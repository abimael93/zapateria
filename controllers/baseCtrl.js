angular.module('Rutas', ['ngRoute'])

.config(function($routeProvider){
	$routeProvider
		//Inicio
		.when('/', {
			templateUrl: 'views/home.html'
		})
		//Módulo Empleado
		.when('/empleado/create', {
			templateUrl: 'views/empleado_form.html'
		})
		.when('/empleado/list', {
			templateUrl: 'views/empleado_list.html'
		})
		//Módulo Cliente
		.when('/cliente/create', {
			templateUrl: 'views/cliente_form.html'
		})
		.when('/cliente/list', {
			templateUrl: 'views/cliente_list.html'
		})
		//Módulo Proveedor
		.when('/proveedor/create', {
			templateUrl: 'views/proveedor_form.html'
		})
		.when('/proveedor/list', {
			templateUrl: 'views/proveedor_list.html'
		})
		//Módulo Almacen
		.when('/almacen/list', {
			templateUrl: 'views/almacen_list.html'
		})
		//Módulo Producto
		.when('/producto/create', {
			templateUrl: 'views/producto_form.html'
		})
		.when('/producto/list', {
			templateUrl: 'views/producto_list.html'
		})
		//Módulo Remisión
		.when('/remision/create', {
			templateUrl: 'views/remision_form.html'
		})
		.when('/remision/list', {
			templateUrl: 'views/remision_list.html'
		})
		//Módulo Recepción
		.when('/recepcion/create', {
			templateUrl: 'views/recepcion_form.html'
		})
		.when('/recepcion/list', {
			templateUrl: 'views/recepcion_list.html'
		})
		//Módulo Ajuste Entrada
		.when('/ajuste_entrada/create', {
			templateUrl: 'views/ajuste_entrada_form.html'
		})
		.when('/ajuste_entrada/list', {
			templateUrl: 'views/ajuste_entrada_list.html'
		})
		//Módulo Ajuste Salida
		.when('/ajuste_salida/create', {
			templateUrl: 'views/ajuste_salida_form.html'
		})
		.when('/ajuste_salida/list', {
			templateUrl: 'views/ajuste_salida_list.html'
		})
		.otherwise({
			redirectTo: '/'
		});
})