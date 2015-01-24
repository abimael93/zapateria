var navbar = angular.module('navbar_ctrl',[]);

navbar.controller('NavbarCtrl', ['$location',function NavbarCtrl($location) {
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

navbar.factory('Fabrica', function() {
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