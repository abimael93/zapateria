/**
    *   This controller allows us to manipulate information of the sessions.
    *   @author     Christian Velázquez <chris.abimael93@gmail.com>
    *   @since      02/08/2015
    *   @version    1
    *   @access     public
    *   @param      Service [$http]
    *   @param      Service [routeServices]
    *   @param      Service [sessionServices]
    *   @return     
    *   @example    session.loguear( .... )
*/
angular.module('appZapateria').controller('SessionCtrl',['$http','routeServices','sessionServices', function ( $http, routeServices, sessionServices ) {
    var session = this;

    session.empleado = {};

    /**
    *   This function is used for a user logs on.
    *   @author     Christian Velazquez <chris.abimael93@gmail.com>
    *   @since      02/08/2015
    *   @version    1
    *   @access     public
    *   @return     void
    *   @example    session.loguear();
    */
    session.loguear = function() {
        session.empleado.usuario    = session.user;
        session.empleado.password   = session.pass;

        sessionServices.loguear( session.empleado ,
            function( data ) {
                session.datos = data;
                routeServices.rutaInicio();
                console.log( data.message );
            }, function( data ) {
                console.log( data.message );
            }
        );
    }

    /**
    *   This function is used for a user logs on.
    *   @author     Christian Velazquez <chris.abimael93@gmail.com>
    *   @since      02/10/2015
    *   @version    1
    *   @access     public
    *   @return     void
    *   @example    session.logout();
    */
    session.logout = function() {

        sessionServices.logout( 
            function( data ) {
                console.log( data.message );
            }, function( data ) {
                console.log( data.message );
            }
        );
    }       
}]);