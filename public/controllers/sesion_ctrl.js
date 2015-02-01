//para hacer uso de $resource debemos colocarlo al crear el modulo
//con dataResource inyectamos la factoría
angular.module('appZapateria').controller('SesionCtrl',['$http','LoginResource','routeServices', function ( $http, dataResource, routeServices ) {
    var sesion = this;
    //hacemos uso de $http para obtener los datos del json
    sesion.loguear = function() {
        alert(routeServices.PathServer()+'login');
        var ruta_api = routeServices.PathServer() + "login";
        $http.post(ruta_api, {usuario: sesion.user, password: sesion.pass}).success(function (data) {
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
        alert(routeServices.PathServer()+'logout');
        var ruta_api = routeServices.PathServer() + "logout";
        $http.post(ruta_api, { }).success(function (data) {
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
    //datosResource lo tenemos disponible en la vista gracias a login
    //login.datosResource = dataResource.post();
}]);

//de esta forma tan sencilla consumimos con $resource en AngularJS
angular.module('appZapateria').factory("LoginResource", function ($resource) {

    return $resource("http://localhost/zapateria/public/login/", //la url donde queremos consumir
        { usuario: 'kyele', password: '3312174658' }, //aquí podemos pasar variables que queramos pasar a la consulta
        //a la función post le decimos el método, y, si es un array lo que devuelve
        //ponemos isArray en true
        { post: { method: "POST", isArray: false }
    })
})