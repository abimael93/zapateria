angular.module('appZapateria').service('catalogosServices', ['$http','$location','$q', function($http, $location, $q){
    var path_angular, path_server;

    path_angular = $location.absUrl();
            path_server = path_angular.substring( 0, path_angular.indexOf('index.html') != -1? path_angular.indexOf('index.html'):path_angular.indexOf('#'));
    path_server += 'catalogos/';
    
     return({
            getDepartamentos: getDepartamentos
            }); 

    function getDepartamentos() {
         var request = $http({
                                method: "get",
                                url: path_server + 'departamento',
                                params: {
                                action: "get"
                                }
                            }); 
            return( request.then( handleSuccess, handleError ) );
    };

    this.sayHello = function() {
        return "Hello, World!"
    };

     // ---
    // PRIVATE METHODS.
    // ---
    // I transform the error response, unwrapping the application dta from
    // the API response payload.
    function handleError( response ) {
    // The API response from the server should be returned in a
    // nomralized format. However, if the request was not handled by the
    // server (or what not handles properly - ex. server error), then we
    // may have to normalize it on our end, as best we can.
    if (
    ! angular.isObject( response.data )
    ) {
        return( $q.reject( "An unknown error occurred." ) );
    }
    // Otherwise, use expected error message.
        return( $q.reject( response.data.message ) );
    }
    // I transform the successful response, unwrapping the application data
    // from the API response payload.
    function handleSuccess( response ) {
        alert('hola!');
        alert('hola!');
        return( response.data );
    } 
}]);