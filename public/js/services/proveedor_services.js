/**
    *   this service allows us to manipulate the provider information
    *   @author     Cesar herrera <kyele936@gmail.com>
    *   @since      02/11/2015
    *   @version    1
    *   @access     public
    *   @param      Service [$resource]
    *   @param      Service [routeServices]
    *   @return     
    *   @example    catalogosServices.getDep(function(data){.....}
*/
angular.module( 'appZapateria' ).service( 'proveedorServices' , [ '$resource' , 'routeServices' , function( $resource , routeServices ) {

        var path_server = routeServices.PathServer + 'proveedores';

        var proveedor_resource = $resource( path_server , {}, {
                agregar: {
                    method: 'POST'
                }
            }),
            proveedor_listar     = $resource( path_server + "/listar/:offset/:eliminado" , {}, {
                listar: {
                    method: 'POST',
                    params: {
                        offset:         '@offset',
                        eliminado:      '@eliminado',
                    }
                }
            });

        return {
            /**
            *   this function returns the promise that contains a json
            *   @author     Cesar herrera <kyele936@gmail.com>
            *   @since      02/11/2015
            *   @version    1
            *   @access     public
            *   @param      jsonObject [proveedor]
            *   @param      Callbacks [success]
            *   @param      Callbacks [fail]
            *   @return     promise
            *   @example    proveedorServices.loguear( {usuario: 'kyele', password: '1414'} , function( data ){ .... }, function( data ) { .... } )
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
            /**
            *   this function returns the promise that contains a json
            *   @author     Christian Velazquez <chris.abimael93@gmail.com>
            *   @since      02/24/2015
            *   @version    1
            *   @access     public
            *   @param      jsonObject [parametros]
            *   @param      Callbacks [callback]
            *   @return     promise
            *   @example    empleadoServices.listar( { offset: 0 , eliminado: 0 } function( data ){ .... });
            */
            listar: function( parametros , callback ) {
                return proveedor_listar.listar( parametros ,
                    function( data ) {
                        callback( data );
                    }
                );
            },
        };
            
}]);