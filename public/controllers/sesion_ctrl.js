//para hacer uso de $resource debemos colocarlo al crear el modulo
//con dataResource inyectamos la factoría
angular.module('appZapateria').controller('SesionCtrl',['$http','routeServices', function ( $http, routeServices ) {
    var sesion = this;
    //hacemos uso de $http para obtener los datos del json
    sesion.loguear = function() {
        //alert(routeServices.PathServer()+'login');
        var ruta_api = routeServices.PathServer() + "login";

        $http.post(ruta_api, {usuario: sesion.user, password: sesion.pass})
        .success(function (data) {
            sesion.datos = data;
            routeServices.rutaInicio();
        })
        .error( function( data ) {
            sesion.respuesta = data;
            alert( data.message );
            //alert( data.status );
            //$location.path('empleado/create');
        });
    }

    sesion.logout = function() {
        //alert(routeServices.PathServer()+'logout');
        var ruta_api = routeServices.PathServer() + "logout";

        $http.post(ruta_api, { })
        .success(function (data) {
            sesion.datos = data;
            routeServices.rutaLogin();
        })
        .error( function( data ) {
            sesion.respuesta = data;
            alert( data.message );
            //alert( data.status );
            //$location.path('empleado/create');
        });
    }       
}]);