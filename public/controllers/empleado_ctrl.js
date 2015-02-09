/**
    *   This controller allows us to manipulate information of employees.
    *   @author     Christian Velázquez <chris.abimael93@gmail.com>
    *   @since      02/07/2015
    *   @version    1
    *   @access     public
    *   @param      Service [$resource]
    *   @param      Service [$location]
    *   @param      Service [routeServices]
    *   @return     
    *   @example    empleado.registrar( .... )
*/
angular.module( 'appZapateria' ).controller( 'empleadoCtrl' , [ '$location' , '$modal' , 'catalogosServices' ,
    function( $location , $modal , catalogosServices ) {

        var empleado = this;

        //Aqui llamo a mi funcion que esta en el service para traer los datos
        catalogosServices.tipo( 'pais', function( data ) {
            empleado.departamentos = data;
        });

        catalogosServices.tipoDependiente( { tipo: 'municipio', id_padre: 1 } , function( data ) {
            empleado.cargos = data;
        });
    }
]);