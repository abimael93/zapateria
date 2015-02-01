angular.module('appZapateria').controller('NavbarCtrl', ['$location',function NavbarCtrl($location) {
    var nav = this;

    nav.isCollapsed = true;

    nav.colapsar = function() {
        nav.isCollapsed = false;
    };

    nav.ubicacion = function() {
        nav.separador = '|';
        switch($location.path()){
            case '/empleado/create':
                nav.modulo = [
                                {
                                    nombreBase: 'empleado',
                                    nombre: 'Empleados',
                                    icon: 'fa fa-user',
                                    accion: 'Nuevo',
                                }
                            ];
                break;
            case '/empleado/list':
                nav.modulo = [
                                {
                                    nombreBase: 'empleado',
                                    nombre: 'Empleados',
                                    icon: 'fa fa-user',
                                    accion: 'Listado',
                                }
                            ];
                break;
            case '/cliente/create':
                nav.modulo = [
                                {
                                    nombreBase: 'cliente',
                                    nombre: 'Clientes',
                                    icon: 'fa fa-bar-chart-o',
                                    accion: 'Nuevo',
                                }
                            ];
                break;
            case '/cliente/list':
                nav.modulo = [
                                {
                                    nombreBase: 'cliente',
                                    nombre: 'Clientes',
                                    icon: 'fa fa-bar-chart-o',
                                    accion: 'Listado',
                                }
                            ];
                break;
            case '/proveedor/create':
                nav.modulo = [
                                {
                                    nombreBase: 'proveedor',
                                    nombre: 'Proveedores',
                                    icon: 'fa fa-table',
                                    accion: 'Nuevo',
                                }
                            ];
                break;
            case '/proveedor/list':
                nav.modulo = [
                                {
                                    nombreBase: 'proveedor',
                                    nombre: 'Proveedores',
                                    icon: 'fa fa-table',
                                    accion: 'Listado',
                                }
                            ];
                break;
            case '/producto/create':
                nav.modulo = [
                                {
                                    nombreBase: 'producto',
                                    nombre: 'Productos',
                                    icon: 'fa fa-shopping-cart',
                                    accion: 'Nuevo',
                                }
                            ];
                break;
            case '/producto/list':
                nav.modulo = [
                                {
                                    nombreBase: 'producto',
                                    nombre: 'Productos',
                                    icon: 'fa fa-shopping-cart',
                                    accion: 'Listado',
                                }
                            ];
                break;
            case '/pedido/create':
                nav.modulo = [
                                {
                                    nombreBase: 'pedido',
                                    nombre: 'Pedidos',
                                    icon: 'fa fa-truck',
                                    accion: 'Nuevo',
                                }
                            ];
                break;
            case '/pedido/list':
                nav.modulo = [
                                {
                                    nombreBase: 'pedido',
                                    nombre: 'Pedidos',
                                    icon: 'fa fa-truck',
                                    accion: 'Listado',
                                }
                            ];
                break;
            case '/desarrollo/create':
                nav.modulo = [
                                {
                                    nombreBase: 'desarrollo',
                                    nombre: 'Desarrollo',
                                    icon: 'fa fa-cogs',
                                    accion: 'Nuevo',
                                }
                            ];
                break;
            case '/desarrollo/list':
                nav.modulo = [
                                {
                                    nombreBase: 'desarrollo',
                                    nombre: 'Desarrollo',
                                    icon: 'fa fa-cogs',
                                    accion: 'Listado',
                                }
                            ];
                break;
            case '/produccion/create':
                nav.modulo = [
                                {
                                    nombreBase: 'produccion',
                                    nombre: 'Produccion',
                                    icon: 'fa fa-line-chart',
                                    accion: 'Nueva Orden de Producción',
                                }
                            ];
                break;
            case '/produccion/list':
                nav.modulo = [
                                {
                                    nombreBase: 'produccion',
                                    nombre: 'Produccion',
                                    icon: 'fa fa-line-chart',
                                    accion: 'Listado',
                                }
                            ];
                break;
            case '/remision/create':
                nav.modulo = [
                                {
                                    nombreBase: 'remision',
                                    nombre: 'Ventas',
                                    icon: 'fa fa-money',
                                    accion: 'Nueva Venta',
                                }
                            ];
                break;
            case '/remision/list':
                nav.modulo = [
                                {
                                    nombreBase: 'remision',
                                    nombre: 'Ventas',
                                    icon: 'fa fa-money',
                                    accion: 'Listado',
                                }
                            ];
                break;
            case '/recepcion/create':
                nav.modulo = [
                                {
                                    nombreBase: 'recepcion',
                                    nombre: 'Compras',
                                    icon: 'fa fa-credit-card',
                                    accion: 'Nueva Compra',
                                }
                            ];
                break;
            case '/recepcion/list':
                nav.modulo = [
                                {
                                    nombreBase: 'recepcion',
                                    nombre: 'Compras',
                                    icon: 'fa fa-credit-card',
                                    accion: 'Listado',
                                }
                            ];
                break;
            case '/ajuste_entrada/create':
                nav.modulo = [
                                {
                                    nombreBase: 'ajuste_entrada',
                                    nombre: 'Ajustes de Entrada',
                                    icon: 'fa fa-arrow-circle-right',
                                    accion: 'Nuevo',
                                }
                            ];
                break;
            case '/ajuste_entrada/list':
                nav.modulo = [
                                {
                                    nombreBase: 'ajuste_entrada',
                                    nombre: 'Ajustes de Entrada',
                                    icon: 'fa fa-arrow-circle-right',
                                    accion: 'Listado',
                                }
                            ];
                break;
            case '/ajuste_salida/create':
                nav.modulo = [
                                {
                                    nombreBase: 'ajuste_salida',
                                    nombre: 'Ajustes de Salida',
                                    icon: 'fa fa-arrow-circle-left',
                                    accion: 'Nuevo',
                                }
                            ];
                break;
            case '/ajuste_salida/list':
                nav.modulo = [
                                {
                                    nombreBase: 'ajuste_salida',
                                    nombre: 'Ajustes de Salida',
                                    icon: 'fa fa-arrow-circle-left',
                                    accion: 'Listado',
                                }
                            ];
                break;
            default:
                nav.modulo = [
                                {
                                    nombreBase: 'inicio',
                                    nombre: 'Inicio',
                                    icon: 'fa fa-home',
                                    accion: '',
                                }
                            ];
                nav.separador = '';
                break;
        }
    }
}]);
//para hacer uso de $resource debemos colocarlo al crear el modulo
//con dataResource inyectamos la factoría
angular.module('appZapateria').controller("appController", function ($scope, $http, $location,  dataResource) {
    //hacemos uso de $http para obtener los datos del json
    /*$http.post('http://localhost/zapateria/public/login',{usuario: '', password: ''}).success(function (data) {
        //Convert data to array.
        //datos lo tenemos disponible en la vista gracias a $scope
        //$scope.datos = data;
        //if( !$scope.datos.status )
            //$location.path('empleado/list');
    })
    .error( function( data ) {
        alert( data.message );
        alert( data.status );
        //$location.path('empleado/create');
    });*/
    //alert($scope.datos.status);
    //datosResource lo tenemos disponible en la vista gracias a $scope
    $scope.datosResource = dataResource.get();
    
    /*$scope.direcciona = function( estado ) {
        if( estado == 0 ) {
            alert('holi!');
        }
    }*/

    //alert($scope.dataResource.status);
    //if( estado == 0 )
            //$location.path('empleado/list');
})
 
//de esta forma tan sencilla consumimos con $resource en AngularJS
angular.module('appZapateria').factory('dataResource', function ($resource) {

    return $resource("http://localhost/zapateria/public/empleados/1", //la url donde queremos consumir
        { }, //aquí podemos pasar variables que queramos pasar a la consulta
        //a la función post le decimos el método, y, si es un array lo que devuelve
        //ponemos isArray en true
        { get: { method: "GET", isArray: false }
    })
})

angular.module('appZapateria').factory('Fabrica', function() {
  var servicio = {
    objeto: {mensaje: 'Saludos desde la Fabrica desde Controlador Empleados!'},
    msjInicial: function() {
      servicio.objeto['mensaje'] = 'Saludos desde la Fabrica!';
    },
    msjNuevo: function(msj) {
      servicio.objeto.mensaje = msj;
    }
  };
  return servicio;
});