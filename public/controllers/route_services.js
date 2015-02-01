angular.module('appZapateria').factory('routeServices', ['$location', function($location) {
    var path_angular, path_server;

    return {
        PathServer : function() {
            path_angular = $location.absUrl();
            path_server = path_angular.substring( 0, path_angular.indexOf('index.html') != -1? path_angular.indexOf('index.html'):path_angular.indexOf('#'));
            return path_server;
        },
        rutaInicio : function() {
            return $location.path('/');
        },
        rutaLogin : function() {
            return $location.path('/login');
        },
    };
    /*
    var servicio = {
    objeto: {mensaje: 'Saludos desde la Fabrica desde Controlador Empleados!'},
    msjInicial: function() {
      servicio.objeto['mensaje'] = 'Saludos desde la Fabrica!';
    },
    msjNuevo: function(msj) {
      servicio.objeto.mensaje = msj;
    }
  };

  return servicio;*/
}]);