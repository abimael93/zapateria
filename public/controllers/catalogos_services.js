/**
    *   this service allows us to bring the catalogs' information
    *   @author     Cesar Herrera <kyele936@gmail.com>
    *   @since      02/06/2015
    *   @version    1
    *   @access     public
    *   @param      $http , $location , $q 
    *   @return     
    *   @example    catalogosServices.getDep(function(data){.....}
*/
angular.module( 'appZapateria' ).service( 'catalogosServices' , [ '$location' , '$q' , '$http' , function ( $location , $q , $http ) {

    var path_angular , path_server;
    path_angular = $location.absUrl();
    path_server  = path_angular.substring( 0 , path_angular.indexOf( 'index.html' ) != -1 ? path_angular.indexOf( 'index.html' ):path_angular.indexOf( '#' ) );
    path_server += 'catalogos/';

    /**
    *   this function returns the promise that contains a json
    *   @author     Cesar Herrera <kyele936@gmail.com>
    *   @since      02/06/2015
    *   @version    1
    *   @access     public
    *   @param      callbacks
    *   @return     promise
    *   @example    catalogosServices.getCar(function(data){.....}
    */    
    this.getCar = function ( success , failure ) {        
        $http.get( path_server + 'cargo' )
            .success(success)
            .error(failure);
    }

    /**
    *   this function returns the promise that contains a json
    *   @author     Cesar Herrera <kyele936@gmail.com>
    *   @since      02/06/2015
    *   @version    1
    *   @access     public
    *   @param      callbacks
    *   @return     promise
    *   @example    catalogosServices.getDep(function(data){.....}
    */
    this.getDep = function ( success , failure ) {        
        $http.get( path_server + 'departamento' )
            .success(success)
            .error(failure);
    }
    //return $resource( path_server + 'departamento');

    /**
    *   this function returns the promise that contains a json
    *   @author     Cesar Herrera <kyele936@gmail.com>
    *   @since      02/06/2015
    *   @version    1
    *   @access     public
    *   @param      callbacks
    *   @return     promise
    *   @example    catalogosServices.getAdj(function(data){.....}
    */
    this.getAdj = function ( success , failure ) {        
        $http.get( path_server + 'adjunto_tipo' )
            .success(success)
            .error(failure);
    }

    /**
    *   this function returns the promise that contains a json
    *   @author     Cesar Herrera <kyele936@gmail.com>
    *   @since      02/06/2015
    *   @version    1
    *   @access     public
    *   @param      callbacks
    *   @return     promise
    *   @example    catalogosServices.getAju_ent(function(data){.....}
    */
    this.getAju_ent = function ( success , failure ) {        
        $http.get( path_server + 'ajuste_entrada_tipo' )
            .success(success)
            .error(failure);
    }

    /**
    *   this function returns the promise that contains a json
    *   @author     Cesar Herrera <kyele936@gmail.com>
    *   @since      02/06/2015
    *   @version    1
    *   @access     public
    *   @param      callbacks
    *   @return     promise
    *   @example    catalogosServices.getAju_sal(function(data){.....}
    */
    this.getAju_sal = function ( success , failure ) {        
        $http.get( path_server + 'ajuste_salida_tipo' )
            .success(success)
            .error(failure);
    }

    /**
    *   this function returns the promise that contains a json
    *   @author     Cesar Herrera <kyele936@gmail.com>
    *   @since      02/06/2015
    *   @version    1
    *   @access     public
    *   @param      callbacks
    *   @return     promise
    *   @example    catalogosServices.getAlm(function(data){.....}
    */
    this.getAlm = function ( success , failure ) {          
        $http.get( path_server + 'almacen' )
            .success(success)
            .error(failure);
    }

    /**
    *   this function returns the promise that contains a json
    *   @author     Cesar Herrera <kyele936@gmail.com>
    *   @since      02/06/2015
    *   @version    1
    *   @access     public
    *   @param      callbacks
    *   @return     promise
    *   @example    catalogosServices.getCli_tipo(function(data){.....}
    */
    this.getCli_tipo = function ( success , failure ) {        
        $http.get( path_server + 'cliente_tipo' )
            .success(success)
            .error(failure);
    }

    /**
    *   this function returns the promise that contains a json
    *   @author     Cesar Herrera <kyele936@gmail.com>
    *   @since      02/06/2015
    *   @version    1
    *   @access     public
    *   @param      callbacks
    *   @return     promise
    *   @example    catalogosServices.getCli_cat(function(data){.....}
    */
    this.getCli_cat = function ( success , failure ) {        
        $http.get( path_server + 'cliente_categoria' )
            .success(success)
            .error(failure);
    }

    /**
    *   this function returns the promise that contains a json
    *   @author     Cesar Herrera <kyele936@gmail.com>
    *   @since      02/06/2015
    *   @version    1
    *   @access     public
    *   @param      callbacks
    *   @return     promise
    *   @example    catalogosServices.getCli_cat(function(data){.....}
    */
    this.getCli_cat = function ( success , failure ) {        
        $http.get( path_server + 'cliente_categoria' )
            .success(success)
            .error(failure);
    }

    //----------------Catalogos Dependientes----------------------
    /**
    *   this function returns the promise that contains a json
    *   @author     Cesar Herrera <kyele936@gmail.com>
    *   @since      02/06/2015
    *   @version    1
    *   @access     public
    *   @param      callbacks
    *   @return     promise
    *   @example    catalogosServices.getEst(function(data){.....}
    */
    this.getEst = function ( success , failure ) {        
        $http.get( path_server + 'dependientes/estado/1' )
            .success(success)
            .error(failure);
    }

    /**
    *   this function returns the promise that contains a json
    *   @author     Cesar Herrera <kyele936@gmail.com>
    *   @since      02/06/2015
    *   @version    1
    *   @access     public
    *   @param      callbacks
    *   @return     promise
    *   @example    catalogosServices.getMun(function(data){.....}
    */
    this.getMun = function ( success , failure ) {        
        $http.get( path_server + 'dependientes/municipio/14' )
            .success(success)
            .error(failure);
    }
     
}]);

angular.module( 'appZapateria' ).service( 'Departamentos' , [ '$resource' , '$location' , 'catalogosServices' , function( $resource , $location , catalogosServices ) {
    var path_angular , path_server;
    path_angular = $location.absUrl();
    path_server  = path_angular.substring( 0 , path_angular.indexOf( 'index.html' ) != -1 ? path_angular.indexOf( 'index.html' ):path_angular.indexOf( '#' ) );
    path_server += 'catalogos/';

    return $resource ( path_server + 'departamento' , null , {
        'get': { method:'GET' }
    });
}])