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
])

.run([
	'$rootScope', '$state', '$location', 'sessionServices',
	function($rootScope, $state, $location, sessionServices ) {
	'use strict';

	$rootScope.$state = $state;

	if ( !$rootScope.sesion ) {
		$rootScope.sesion = {};
	}
	
	$rootScope.$on( '$stateChangeStart' , function( event, toState, toParams, from, fromParams ) {
	    //Intentamos acceder, comprobamos sesion de laravel
	    if( typeof $rootScope.sesion.status === 'undefined' && toState.name != 'login' ) {
	    	event.preventDefault();
	    	sessionServices.loguear( {},
	    		//Hay una sesión activa
	        	function( data ) {
	        		//Guardamos esa sesión y no hacemos nada más
	        		$rootScope.sesion = data;
	        		console.log( $rootScope.sesion );
	        		//Guardamos el status (0 de éxito al loguear)
	        		$rootScope.sesion.status = 0;
	        		$state.go( toState.name );
	        		/*
	        		if( toState.name == 'login' ) {
	        			$state.go( 'gestion.inicio' );
	        		}
	        		*/
	        	}, function( data ) {//Si no hay sesión de Laravel lo mandamos al login
	        		$state.go( 'login' );
	        		
	        		//Guardamos el status, no hay sesión de Laravel activa
	        		//	$rootScope.sesion.status = data.status;
	        	}
			);
	    }
	    if( typeof $rootScope.sesion.status !== 'undefined' && toState.name == 'login' ) {
	    	event.preventDefault();
	    	//$state.go( 'gestion.inicio' );
	    }

	    if( $rootScope.sesion.status == 500 ) {
	    	event.preventDefault();
	    }
	    /*
	    if( typeof $rootScope.sesion.status == 'undefined' && toState.name == 'login' ) {
	    	event.preventDefault();
	    }
	    */
	    sessionServices.loguear( {},
			function( data ) {//Comprobamos solo la sesión por cada acceso a una ruta distinta
				$rootScope.sesion = data;//Guardamos su sesión, quizá hizo cambios en su perfil
				$rootScope.sesion.status = 0;
				console.log( $state.current );
				if( toState.name == 'login' ) {
					$state.go( 'gestion.inicio' );
				}
				//Mensajes para corroborar que si está logueado
				console.log( 'Ya estás logueado' );
			}, function( data ) {//Si falla la sesión por cualquier situación (ejem: conexión)
				//Matamos su sesión
				$rootScope.sesion = {};
			}
		);
    });
}]);