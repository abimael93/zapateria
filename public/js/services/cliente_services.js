/**
    *   this service allows us to manipulate the provider information
    *   @author     Cesar herrera <kyele936@gmail.com>
    *   @since      03/08/2015
    *   @version    1
    *   @access     public
    *   @param      Service [$resource]
    *   @param      Service [routeServices]
    *   @return     
    *   @example    catalogosServices.getDep(function(data){.....}
*/
angular.module( 'appZapateria' ).service( 'clienteServices' , [ '$resource' , 'routeServices' , function( $resource , routeServices ) {

        var path_server = routeServices.PathServer + 'clientes';

        var proveedor_resource = $resource( path_server , {}, {
                agregar: {
                    method: 'POST'
                }
            });

        return {
            /**
            *   this function returns the promise that contains a json
            *   @author     Cesar herrera <kyele936@gmail.com>
            *   @since      03/08/2015
            *   @version    1
            *   @access     public
            *   @param      jsonObject [proveedor]
            *   @param      Callbacks [success]
            *   @param      Callbacks [fail]
            *   @return     promise
            *   @example    clienteServices.registrar( {} , function( data ){ .... }, function( data ) { .... } )
            */
            agregar: function( proveedor , success, fail ) {
                return proveedor_resource.agregar( proveedor ,
                    function( data ) {
                        success( data );
                    }, function( data ) {
                        fail( data.data );
                    }
                );
            },
        };
}]);