angular.module( 'appZapateria' ).controller( 'empleadoCtrl' , [ '$location' , '$modal' , 'catalogosServices' , 'routeServices' , 'catalogos' , function( $location , $modal , catalogosServices , routeServices , catalogos ) {

    var empleado = this;    

    //Aqui llamo a mi funcion que esta en el service para traer los datos
    /*catalogosServices.getDep(function(data){
        empleado.departamentos = data;
    });*/
    /*empleado.departamentos = catalogosServices.get();
    
    catalogosServices.getCar(function(data){
        empleado.cargos = data;
    });*/
    /*catalogosServices.getCar(function(data){
        empleado.cargos = data;
    });*/
    
    catalogos.tipo( 'departamento', function( data ) {
        empleado.departamentos = data;
    });
    
    catalogosServices.getEst(function(data){
        empleado.estados = data;
    });

    catalogosServices.getMun(function(data){
        empleado.municipios = data;
    });
    
    
    catalogosServices.getCli_cat(function(data){
        empleado.categoria_clientes = data;
    });    
    
}]);