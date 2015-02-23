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

        var empleado_resource = $resource( path_server , {}, {
                agregar: {
                    method: 'POST'
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
            *   @since      02/08/2015
            *   @version    1
            *   @access     public
            *   @param      jsonObject [session]
            *   @param      Callbacks [success]
            *   @param      Callbacks [fail]
            *   @return     promise
            *   @example    sessionServices.logout( function( data ){ .... }, function( data ) { .... } );
            */
            /*
            logout: function( success, fail ) {
                return logout_reource.logout(
                    function( data ) {
                        success( data );
                    }, function( data ) {
                        fail( data.data );
                    }
                )
            }*/
        };
}]);