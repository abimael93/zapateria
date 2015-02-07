/**
    *   this service allows us to bring the catalogs' information
    *   @author     Cesar Herrera <kyele936@gmail.com>
    *   @since      02/06/2015
    *   @version    1
    *   @access     public
    *   @param      callbacks
    *   @return     promise
    *   @example    catalogosServices.getDep(function(data){.....}
*/
angular.module( 'appZapateria' ).service( 'catalogosServices' , [ '$http' , '$location' , '$q' , function ( $http , $location , $q ) {

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
    *   @example    catalogosServices.getDep(function(data){.....}
    */
    this.getDep = function ( success , failure ) {        
        $http.get( path_server + 'departamento' )
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
    *   @example    catalogosServices.getEst(function(data){.....}
    */
    this.getEst = function ( success , failure ) {        
        $http.get( path_server + 'dependientes/estado/1' )
            .success(success)
            .error(failure);
    }
     
}]);
