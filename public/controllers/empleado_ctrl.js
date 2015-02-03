angular.module('appZapateria').controller('empleadoCtrl', ['$location','$modal','catalogosServices','routeServices','$http', function( $location, $modal, catalogosServices, routeServices, $http) {
    var empleado = this;

    var ruta_api = routeServices.PathServer() + "catalogos/departamento";

    empleado.departamentos = function(){
        $http.get(ruta_api, {})
            .success(function (data) {
                return empleado.datos = data;
                //routeServices.rutaInicio();
            })
            .error( function( data ) {
                return empleado.respuesta = data;
                alert( data.message );
                //alert( data.status );
                //$location.path('empleado/create');
            });    
    }
    empleado.datos = catalogosServices.getDepartamentos();
    //alert(empleado.departamentos);
}]);