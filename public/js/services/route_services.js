angular.module('appZapateria').service('routeServices', ['$location', function($location) {

    var path_angular, path_server;
    path_angular = $location.absUrl();
    path_server = path_angular.substring( 0, path_angular.indexOf('index.html') != -1? path_angular.indexOf('index.html'):path_angular.indexOf('#'));

    this.PathServer = path_server;

    this.goInicio = function() {
        return $location.path('/');
    };

    this.goLogin = function() {
        return $location.path('/login');
    };
    
    /*
    return {
        PathServer : function() {
            path_angular = $location.absUrl();
            path_server = path_angular.substring( 0, path_angular.indexOf('index.html') != -1? path_angular.indexOf('index.html'):path_angular.indexOf('#'));
            return path_server;
        },
        rutaInicio : function() {
            return $location.path('/');
        },
        rutaLogin : function() {
            return $location.path('/login');
        },
    };*/
}]);