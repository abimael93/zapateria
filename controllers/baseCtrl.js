angular.module('Rutas', ['ngRoute'])

.config(function($routeProvider){
	$routeProvider
		.when('/', {
			templateUrl: 'views/home.html'
		})
		.when('/empleado/alta', {
			templateUrl: 'views/empleado_form.html'
		})
		.when('/empleado/listar', {
			//controller: 'ControladorEmpleados',
			templateUrl: 'views/empleado_list.html'
		})
		.when('/cliente/alta', {
			templateUrl: 'views/cliente_form.html'
		})
		.when('/cliente/listar', {
			//controller: 'Controladorclientes',
			templateUrl: 'views/cliente_list.html'
		})
		.when('/proveedor/alta', {
			templateUrl: 'views/proveedor_form.html'
		})
		.when('/proveedor/listar', {
			//controller: 'Controladorproveedors',
			templateUrl: 'views/proveedor_list.html'
		})
		.otherwise({
			redirectTo: '/'
		});
})