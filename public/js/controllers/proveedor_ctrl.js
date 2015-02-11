/**
    *   This controller allows us to manipulate information of provider.
    *   @author     César Herrera <kyele936@gmail.com>
    *   @since      02/10/2015
    *   @version    1
    *   @access     public
    *   @param      Service [$resource]
    *   @param      Service [$location]
    *   @param      Service [routeServices]
    *   @return     
    *   @example    proveedor.registrar( .... )
*/
angular.module( 'appZapateria' ).controller( 'ProveedorCtrl' , [ '$location' , '$modal' , 'catalogosServices' ,
    function( $location , $modal , catalogosServices ) {

    var proveedor = this;       
        
    catalogosServices.tipoDependiente( { tipo: 'estado', id_padre: 1 } , function( data ) {
        proveedor.estados = data;
    });

    proveedor.cargaMunicipios = function() {
        catalogosServices.tipoDependiente( { tipo: 'municipio', id_padre: proveedor.estado } , function( data ) {
            proveedor.municipios = data;
        });
    }
    }
]);