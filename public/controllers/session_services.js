/**
    *   This service allows us controllar sessions system users.
    *   @author     Christian Velázquez <chris.abimael93@gmail.com>
    *   @since      02/08/2015
    *   @version    1
    *   @access     public
    *   @param      Service [$resource]
    *   @param      Service [routeServices]
    *   @return     
    *   @example    sessionServices.getDep(function(data){.....}
*/
angular.module( 'appZapateria' ).service( 'sessionServices' , [ '$resource' , 'routeServices' , function( $resource , routeServices ) {

        var path_server = routeServices.PathServer();

        var session_resource = $resource( path_server + 'login' , {}, {
                login: {
                    method: 'POST'
                }
            });

        return {
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
            *   @example    sessionServices.loguear( {usuario: 'kyele', password: '1414'} , function( data ){ .... }, function( data ) { .... } )
            */
            loguear: function( session , success, fail ) {
                return session_resource.login( 
                    session,
                    function( data ) {
                        success( data.data );
                    }, function( data ) {
                        fail( data.data );
                    }
                );
            },
        }
}]);