angular.module( 'appZapateria' , 
	[ 'ngRoute' , 'ui.bootstrap' , 'ngResource' , 'ui.select', 'ngSanitize' ,
	  'modelOptions' , 'infinite-scroll' , 'ui.router', ] )


.config(
	[ '$stateProvider', '$urlRouterProvider',
	function( $stateProvider , $urlRouterProvider ) {
		'use strict';

		$urlRouterProvider.otherwise('/gestion/inicio');

		$stateProvider
		//Página Principal
		.state('login', {
			url: 			'/login',
			controller: 	'SessionCtrl',
			controllerAs: 	'sesion' ,
			templateUrl: 	'views/login.html' ,
		})
		//Carga del sidebar
		.state('gestion', {
			url: '/gestion',
			templateUrl: 'views/sidebar.html',
			controller: 	'SessionCtrl',
			controllerAs: 	'sesion' ,
		})
			//Inicio del Sistema
			.state('gestion.inicio', {
				url: 			'/inicio',
				controller: 	'appController',
				//controllerAs: 'login' ,
				templateUrl: 	'views/home.html',
			})
			//Módulo Empleado
			.state('gestion.empleado_create', {
				url: 			'/empleado/create',
				controller: 	'EmpleadoAltaCtrl' ,
				controllerAs: 	'empleado' ,
				templateUrl: 	'views/empleado_form.html'
			})
			.state('gestion.empleado_list', {
				url: 			'/empleado/list',
				controller: 	'EmpleadoListCtrl',
				controllerAs: 	'empleado_list',
				templateUrl: 	'views/empleado_list.html',
			})
			//Módulo Cliente
			.state('gestion.cliente_create', {
				url: 			'/cliente/create',
				controller: 	'ClienteCtrl' ,
				controllerAs: 	'cliente' ,
				templateUrl: 	'views/cliente_form.html'
			})
			.state('gestion.cliente_list', {
				url: 			'/cliente/list',
				controller: 	'ClienteListCtrl',
				controllerAs: 	'cliente_list',
				templateUrl: 	'views/cliente_list.html',
			})
			//Módulo Proveedor
			.state('gestion.proveedor_create', {
				url: 			'/proveedor/create',
				controller: 	'ProveedorCtrl' ,
				controllerAs: 	'proveedor' ,
				templateUrl: 	'views/proveedor_form.html'
			})
			.state('gestion.proveedor_list', {				
				url: 			'/proveedor/list',
				controller: 	'ProveedorListCtrl',
				controllerAs: 	'proveedor_list',
				templateUrl: 	'views/proveedor_list.html',
			})
			//Módulo Producto
			.state( 'gestion.producto_create' , {
				url: 		 	'/producto/create',
				templateUrl: 	'views/producto_form.html'
			})
			.state( 'gestion.producto_list' , {
				url: 		 	'/producto/list',
				templateUrl: 	'views/producto_list.html'
			})
			//Módulo pedido
			.state( 'gestion.pedido_create' , {
				url: 			 '/pedido/create',
				templateUrl: 	'views/pedido_form.html'
			})
			.state( 'gestion.pedido_list' , {
				url: 			 '/pedido/list',
				templateUrl: 	'views/pedido_list.html'
			})
			//Módulo Desarrollo
			.state( 'gestion.desarrollo_create' , {
				url: 			 '/desarrollo/create',
				templateUrl: 	'views/desarrollo_form.html'
			})
			.state( 'gestion.desarrollo_list' , {
				url: 			 '/desarrollo/list',
				templateUrl: 	'views/desarrollo_list.html'
			})
			//Módulo Producción
			.state( 'gestion.produccion_create' , {
				url: 			 '/produccion/create',
				templateUrl: 	'views/produccion_form.html'
			})
			.state( 'gestion.produccion_list' , {
				url: 			 '/produccion/list',
				templateUrl: 	'views/produccion_list.html'
			})
			//Módulo Remisión
			.state( 'gestion.remision_create' , {
				url: 			 '/remision/create',
				templateUrl: 	'views/remision_form.html'
			})
			.state( 'gestion.remision_list' , {
				url: 			 '/remision/list',
				templateUrl: 	'views/remision_list.html'
			})
			//Módulo Recepción
			.state( 'gestion.recepcion_create' , {
				url: 			 '/recepcion/create',
				templateUrl: 	'views/recepcion_form.html'
			})
			.state( 'gestion.recepcion_list' , {
				url: 			 '/recepcion/list',
				templateUrl: 	'views/recepcion_list.html'
			})
			//Módulo Ajuste Entrada
			.state( 'gestion.ajuste_entrada_create' , {
				url: 			 '/ajuste_entrada/create',
				templateUrl: 	'views/ajuste_entrada_form.html'
			})
			.state( 'gestion.ajuste_entrada_list' , {
				url: 			 '/ajuste_entrada/list',
				templateUrl: 	'views/ajuste_entrada_list.html'
			})
			//Módulo Ajuste Salida
			.state( 'gestion.ajuste_salida_create' , {
				url: 			 '/ajuste_salida/create',
				templateUrl: 	'views/ajuste_salida_form.html'
			})
			.state( 'gestion.ajuste_salida_list' , {
				url: 			 '/ajuste_salida/list',
				templateUrl: 	'views/ajuste_salida_list.html'
			});
	}
]);
/*.config( function( $routeProvider ) {
	$routeProvider
		//Inicio
		.when( '/' , {
			controller: 	'appController' ,
			//controllerAs: 'login' ,
			templateUrl: 	'views/home.html'
		})
		//Login
		.when( '/login' , {
			controller: 	'SessionCtrl' ,
			controllerAs: 	'sesion' ,
			templateUrl: 	'views/login.html' ,
		})
		//Módulo Empleado
		.when( '/empleado/create' , {
			controller: 	'EmpleadoAltaCtrl' ,
			controllerAs: 	'empleado' ,
			templateUrl: 	'views/empleado_form.html'
		})
		.when( '/empleado/list' , {
			//controller: 'ControladorEmpleados' ,pag
			//controller: 'MyController' ,
			controller: 	'EmpleadoListCtrl',
			controllerAs: 	'empleado_list',
			templateUrl: 	'views/empleado_list.html' ,
		})
		//Módulo Cliente
		.when( '/cliente/create' , {
			//controller: 'TabsDemoCtrl' ,
			templateUrl: 	'views/cliente_form.html'
		})
		.when( '/cliente/list' , {
			templateUrl: 	'views/cliente_list.html'
		})
		//Módulo Proveedor
		.when( '/proveedor/create' , {
			controller: 	'ProveedorCtrl' ,
			controllerAs: 	'proveedor' ,
			templateUrl: 	'views/proveedor_form.html'
		})
		.when( '/proveedor/list' , {
			controller: 'ProveedorCtrl' ,
			controllerAs: 'proveedor' ,
			templateUrl: 'views/proveedor_list.html' ,
		})
		//Módulo Producto
		.when( '/producto/create' , {
			templateUrl: 'views/producto_form.html'
		})
		.when( '/producto/list' , {
			templateUrl: 'views/producto_list.html'
		})
		//Módulo pedido
		.when( '/pedido/create' , {
			templateUrl: 'views/pedido_form.html'
		})
		.when( '/pedido/list' , {
			templateUrl: 'views/pedido_list.html'
		})
		//Módulo Desarrollo
		.when( '/desarrollo/create' , {
			templateUrl: 'views/desarrollo_form.html'
		})
		.when( '/desarrollo/list' , {
			templateUrl: 'views/desarrollo_list.html'
		})
		//Módulo Producción
		.when( '/produccion/create' , {
			templateUrl: 'views/produccion_form.html'
		})
		.when( '/produccion/list' , {
			templateUrl: 'views/produccion_list.html'
		})
		//Módulo Remisión
		.when( '/remision/create' , {
			templateUrl: 'views/remision_form.html'
		})
		.when( '/remision/list' , {
			templateUrl: 'views/remision_list.html'
		})
		//Módulo Recepción
		.when( '/recepcion/create' , {
			templateUrl: 'views/recepcion_form.html'
		})
		.when( '/recepcion/list' , {
			templateUrl: 'views/recepcion_list.html'
		})
		//Módulo Ajuste Entrada
		.when( '/ajuste_entrada/create' , {
			templateUrl: 'views/ajuste_entrada_form.html'
		})
		.when( '/ajuste_entrada/list' , {
			templateUrl: 'views/ajuste_entrada_list.html'
		})
		//Módulo Ajuste Salida
		.when( '/ajuste_salida/create' , {
			templateUrl: 'views/ajuste_salida_form.html'
		})
		.when( '/ajuste_salida/list' , {
			templateUrl: 'views/ajuste_salida_list.html'
		})
		.otherwise({
			redirectTo: '/'
		})
});
*/
/*
angular.module( 'appZapateria' ,
	[ "ui.router" , 'ui.bootstrap' , 'ngResource' , 'ui.select', 'ngSanitize' ,
	  'modelOptions' , 'infinite-scroll' , ] )
	
	.config(function( $stateProvider , $urlRouterProvider ){
    
    // For any unmatched url, send to /route1
    $urlRouterProvider.otherwise( "/home" )
    
    $stateProvider
		.state( 'login' , {
			url: "/login" , //nombre que aparecera en la url
			templateUrl: "views/login.html" , //Direccion del archivo que sera llamado
			controller: 'SessionCtrl as sesion'
		})        
		.state('route2', {
			url: "/views/route2",
			templateUrl: "views/route2.html"
		})        
})
*/