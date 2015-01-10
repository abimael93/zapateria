angular
.module
(
	'Rutas',
	[
	 	'ngRoute',
	 	'apEmpleados',
	 	'miAp'
	]
)

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
			//controller: 'ControladorEmpleados',
			templateUrl: 'views/empleado_list.html'
		})
		//Módulo Cliente
		.when('/cliente/create', {
			//controller: 'TabsDemoCtrl',
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
		//Módulo Producto
		.when('/producto/create', {
			templateUrl: 'views/producto_form.html'
		})
		.when('/producto/list', {
			templateUrl: 'views/producto_list.html'
		})
		//Módulo pedido
		.when('/pedido/create', {
			templateUrl: 'views/pedido_form.html'
		})
		.when('/pedido/list', {
			templateUrl: 'views/pedido_list.html'
		})
		//Módulo Desarrollo
		.when('/desarrollo/create', {
			templateUrl: 'views/desarrollo_form.html'
		})
		.when('/desarrollo/list', {
			templateUrl: 'views/desarrollo_list.html'
		})
		//Módulo Producción
		.when('/produccion/create', {
			templateUrl: 'views/produccion_form.html'
		})
		.when('/produccion/list', {
			templateUrl: 'views/produccion_list.html'
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
		})
})
