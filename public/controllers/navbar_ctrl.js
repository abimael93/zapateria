var navbar = angular.module('navbar_ctrl',[]);

navbar.controller('NavbarCtrl', ['$location',function NavbarCtrl($location) {
    var nav = this;

    nav.isCollapsed = true;

    nav.colapsar = function() {
        nav.isCollapsed = false;
    };

    nav.ubicacion = function() {
        switch($location.path()){
            case '/empleado/create':
                nav.modulo = [
                                {
                                    nombreBase: 'empleado',
                                    nombre: 'Empleados',
                                    icon: 'fa fa-user',
                                    separador: '/',
                                    accion: 'Nuevo Empleado',
                                }
                            ];
                break;
            case '/empleado/list':
                nav.modulo = [
                                {
                                    nombreBase: 'empleado',
                                    nombre: 'Empleados',
                                    icon: 'fa fa-user',
                                    separador: '/',
                                    accion: 'Lista de Empleados',
                                }
                            ];
                break;
            case '/cliente/create':
                nav.modulo = [
                                {
                                    nombreBase: 'cliente',
                                    nombre: 'Clientes',
                                    icon: 'fa fa-bar-chart-o',
                                    separador: '/',
                                    accion: 'Nuevo Cliente',
                                }
                            ];
                break;
            case '/cliente/list':
                nav.modulo = [
                                {
                                    nombreBase: 'cliente',
                                    nombre: 'Clientes',
                                    icon: 'fa fa-bar-chart-o',
                                    separador: '/',
                                    accion: 'Lista de Clientes',
                                }
                            ];
                break;
            case '/proveedor/create':
                nav.modulo = [
                                {
                                    nombreBase: 'proveedor',
                                    nombre: 'Proveedores',
                                    icon: 'fa fa-table',
                                    separador: '/',
                                    accion: 'Nuevo Proveedor',
                                }
                            ];
                break;
            case '/proveedor/list':
                nav.modulo = [
                                {
                                    nombreBase: 'proveedor',
                                    nombre: 'Proveedores',
                                    icon: 'fa fa-table',
                                    separador: '/',
                                    accion: 'Lista de Proveedores',
                                }
                            ];
                break;
            case '/producto/create':
                nav.modulo = [
                                {
                                    nombreBase: 'producto',
                                    nombre: 'Productos',
                                    icon: 'fa fa-shopping-cart',
                                    separador: '/',
                                    accion: 'Nuevo Producto',
                                }
                            ];
                break;
            case '/producto/list':
                nav.modulo = [
                                {
                                    nombreBase: 'producto',
                                    nombre: 'Productos',
                                    icon: 'fa fa-shopping-cart',
                                    separador: '/',
                                    accion: 'Lista de Productos',
                                }
                            ];
                break;
            case '/pedido/create':
                nav.modulo = [
                                {
                                    nombreBase: 'pedido',
                                    nombre: 'Pedidos',
                                    icon: 'fa fa-truck',
                                    separador: '/',
                                    accion: 'Nuevo Pedido',
                                }
                            ];
                break;
            case '/pedido/list':
                nav.modulo = [
                                {
                                    nombreBase: 'pedido',
                                    nombre: 'Pedidos',
                                    icon: 'fa fa-truck',
                                    separador: '/',
                                    accion: 'Lista de Pedidos',
                                }
                            ];
                break;
            case '/desarrollo/create':
                nav.modulo = [
                                {
                                    nombreBase: 'desarrollo',
                                    nombre: 'Desarrollo',
                                    icon: 'fa fa-cogs',
                                    separador: '/',
                                    accion: 'Nuevo Modelo',
                                }
                            ];
                break;
            case '/desarrollo/list':
                nav.modulo = [
                                {
                                    nombreBase: 'desarrollo',
                                    nombre: 'Desarrollo',
                                    icon: 'fa fa-cogs',
                                    separador: '/',
                                    accion: 'Lista de Modelos',
                                }
                            ];
                break;
            case '/produccion/create':
                nav.modulo = [
                                {
                                    nombreBase: 'produccion',
                                    nombre: 'Produccion',
                                    icon: 'fa fa-line-chart',
                                    separador: '/',
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
                                    separador: '/',
                                    accion: 'Lista de Ordenes de Producción',
                                }
                            ];
                break;
            case '/remision/create':
                nav.modulo = [
                                {
                                    nombreBase: 'remision',
                                    nombre: 'Ventas',
                                    icon: 'fa fa-money',
                                    separador: '/',
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
                                    separador: '/',
                                    accion: 'Lista de Ventas',
                                }
                            ];
                break;
            case '/recepcion/create':
                nav.modulo = [
                                {
                                    nombreBase: 'recepcion',
                                    nombre: 'Compras',
                                    icon: 'fa fa-credit-card',
                                    separador: '/',
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
                                    separador: '/',
                                    accion: 'Lista de Compras',
                                }
                            ];
                break;
            case '/ajuste_entrada/create':
                nav.modulo = [
                                {
                                    nombreBase: 'ajuste_entrada',
                                    nombre: 'Ajustes de Entrada',
                                    icon: 'fa fa-arrow-circle-right',
                                    separador: '/',
                                    accion: 'Nuevo Ajuste de Entrada',
                                }
                            ];
                break;
            case '/ajuste_entrada/list':
                nav.modulo = [
                                {
                                    nombreBase: 'ajuste_entrada',
                                    nombre: 'Ajustes de Entrada',
                                    icon: 'fa fa-arrow-circle-right',
                                    separador: '/',
                                    accion: 'Lista de Ajustes de Entrada',
                                }
                            ];
                break;
            case '/ajuste_salida/create':
                nav.modulo = [
                                {
                                    nombreBase: 'ajuste_salida',
                                    nombre: 'Ajustes de Salida',
                                    icon: 'fa fa-arrow-circle-left',
                                    separador: '/',
                                    accion: 'Nuevo Ajuste de Salida',
                                }
                            ];
                break;
            case '/ajuste_salida/list':
                nav.modulo = [
                                {
                                    nombreBase: 'ajuste_salida',
                                    nombre: 'Ajustes de Salida',
                                    icon: 'fa fa-arrow-circle-left',
                                    separador: '/',
                                    accion: 'Lista de Ajustes de Salida',
                                }
                            ];
                break;
            default:
                nav.modulo = [
                                {
                                    nombreBase: 'inicio',
                                    nombre: '',
                                    icon: '',
                                    separador: '',
                                    accion: '',
                                }
                            ];
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