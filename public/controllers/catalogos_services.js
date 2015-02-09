/**
    *   this service allows us to bring the catalogs information
    *   @author     Christian Velázquez <chris.abimael93@gmail.com>
    *   @since      02/08/2015
    *   @version    1
    *   @access     public
    *   @param      Service [$resource]
    *   @param      Service [routeServices]
    *   @return     
    *   @example    catalogosServices.getDep(function(data){.....}
*/
angular.module( 'appZapateria' ).service( 'catalogosServices' , [ '$resource' , 'routeServices' , function( $resource , routeServices ) {

        var path_server = routeServices.PathServer() + "catalogos";

        var catalogos_resource = $resource( path_server + '/:tipo', {}, {
                get: {
                    method: 'GET'
                }
            }),
            catalogos_resource_dependiente = $resource( path_server + '/dependientes/:tipo/:id_padre', {}, {
                get: {
                    method: 'GET'
                }
            });

        return {
            /**
            *   this function returns the promise that contains a json
            *   @author     Christian Velazquez <chris.abimael93@gmail.com>
            *   @since      02/08/2015
            *   @version    1
            *   @access     public
            *   @param      String [tipo]
            *   @param      Callbacks [callback]
            *   @return     promise
            *   @example    catalogosServices.tipo( 'departamento' , function(data){....} )
            */
            tipo: function( tipo , callback ) {
                return catalogos_resource.get( {
                        tipo: tipo,
                    },
                    function( data ) {
                        callback( data.data );
                    }
                );
            },
            /**
            *   this function returns the promise that contains a json
            *   @author     Christian Velazquez <chris.abimael93@gmail.com>
            *   @since      02/08/2015
            *   @version    1
            *   @access     public
            *   @param      jsonObject [parametros]
            *   @param      Callbacks [callback]
            *   @return     promise
            *   @example    catalogosServices.tipo( { tipo:'municipio', id_padre: 1 } , function(data){....} )
            */
            tipoDependiente: function( parametros , callback ) {
                return catalogos_resource_dependiente.get( parametros, 
                    function( data ) {
                        callback( data.data );
                    }
                );
            },
        }
}]);

/*
angular.module( 'appZapateria' ).service( 'catalogosServices' , [ '$location' , '$q' , '$http' , function ( $location , $q , $http ) {

    var path_angular , path_server;
    path_angular = $location.absUrl();
    path_server  = path_angular.substring( 0 , path_angular.indexOf( 'index.html' ) != -1 ? path_angular.indexOf( 'index.html' ):path_angular.indexOf( '#' ) );
    path_server += 'catalogos/';

    this.getEst = function ( success , failure ) {        
        $http.get( path_server + 'dependientes/estado/1' )
            .success(success)
            .error(failure);
    }
     
}]);
*/