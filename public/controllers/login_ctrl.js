//para hacer uso de $resource debemos colocarlo al crear el modulo
//con dataResource inyectamos la factoría
angular.module('appZapateria').controller("LoginCtrl",['$http','$location','LoginResource', function ( $http, $location, dataResource ) {
    var login = this;
    //hacemos uso de $http para obtener los datos del json
    login.loguear = function ( ) {
        $http.post('http://localhost/zapateria/public/login',{usuario: login.user, password: login.pass}).success(function (data) {
            //Convert data to array.
            //datos lo tenemos disponible en la vista gracias a login
            login.datos = data;
            $location.path('/');
        })
        .error( function( data ) {
            login.respuesta = data;
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