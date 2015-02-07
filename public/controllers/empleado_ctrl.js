angular.module('appZapateria').controller('empleadoCtrl', ['$location','$modal','catalogosServices','routeServices','$http', function( $location, $modal, catalogosServices, routeServices, $http) {
    var empleado = this;    
    //Aqui llamo a mi funcion que esta en el service para traer los datos
    catalogosServices.getDep(function(data){
        empleado.departamentos = data;
    });

    catalogosServices.getAlm(function(data){
        empleado.almacenes = data;
    });
    catalogosServices.getEst(function(data){
        empleado.estados = data;
    });
}]);