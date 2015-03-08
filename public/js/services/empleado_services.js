/**
    *   this service allows us to manipulate the employees information
    *   @author     Christian Velázquez <chris.abimael93@gmail.com>
    *   @since      02/11/2015
    *   @version    1
    *   @access     public
    *   @param      Service [$resource]
    *   @param      Service [routeServices]
    *   @return     
    *   @example    catalogosServices.getDep(function(data){.....}
*/
angular.module( 'appZapateria' ).service( 'empleadoServices' , [ '$resource' , 'routeServices' , function( $resource , routeServices ) {

        var path_server = routeServices.PathServer + 'empleados';

        var empleado_resource   = $resource( path_server , {}, {
                agregar: {
                    method: 'POST'
                }
            }),
            empleado_listar     = $resource( path_server + "/listar/:offset/:eliminado" , {}, {
                listar: {
                    method: 'POST',
                    params: {
                        offset:     '@offset',
                        eliminado:  '@eliminado',
                    }
                }
            });
            /*
            logout_reource   = $resource( path_server + 'logout' , {}, {
                logout: {
                    method: 'POST'
                }
            });*/

        return {
            /**
            *   this function returns the promise that contains a json
            *   @author     Christian Velazquez <chris.abimael93@gmail.com>
            *   @since      02/11/2015
            *   @version    1
            *   @access     public
            *   @param      jsonObject [empleado]
            *   @param      Callbacks [success]
            *   @param      Callbacks [fail]
            *   @return     promise
            *   @example    empleadoServices.agregar( {usuario: 'kyele', nombre: '1414', ....} , function( data ){ .... }, function( data ) { .... } )
            */
            agregar: function( empleado , success, fail ) {
                return empleado_resource.agregar( empleado ,
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
                return empleado_listar.listar( parametros ,
                    function( data ) {
                        callback( data );
                    }
                );
            },
        };
}]);