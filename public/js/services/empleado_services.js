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

        var empleado_agregar   = $resource( path_server , {}, {
                agregar: {
                    method: 'POST'
                }
            }),
            empleado_listar     = $resource( path_server + "/listar/:offset/:eliminado" , {}, {
                listar: {
                    method: 'POST',
                    params: {
                        offset:         '@offset',
                        eliminado:      '@eliminado',
                    }
                }
            }),
            empleado_resource   = $resource( path_server + "/:id_empleado" , {}, {
                modificar: {
                    method: 'PUT',
                    params: {
                        id_empleado:    '@id_empleado',
                    }
                },
                mostrar: {
                    method: 'GET',
                    params: {
                        id_empleado:    '@id_empleado',
                    }
                },
                eliminar: {
                    method: 'DELETE',
                    params: {
                        id_empleado:    '@id_empleado',
                    }
                }
            }),
            empleado_recuperar  = $resource( path_server + "/recuperar/:id_empleado" , {} , {
                recuperar: {
                    method: 'GET',
                    params: {
                        id_empleado:    '@id_empleado',
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
                return empleado_agregar.agregar( empleado ,
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

            /**
            *   this function returns the promise that contains a json
            *   @author     Christian Velazquez <chris.abimael93@gmail.com>
            *   @since      08/03/2015
            *   @version    1
            *   @access     public
            *   @param      jsonObject [parametros]
            *   @param      Callbacks [callback]
            *   @return     promise
            *   @example    empleadoServices.modificar( datos_empleado , function( data ){ .... });
            */
            modificar: function( empleado , success , fail ) {
                return empleado_resource.modificar( empleado ,
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
            *   @since      08/03/2015
            *   @version    1
            *   @access     public
            *   @param      jsonObject [parametros]
            *   @param      Callbacks [callback]
            *   @return     promise
            *   @example    empleadoServices.mostrar( datos_empleado , function( data ){ .... });
            */
            mostrar: function( id_empleado , callback ) {
                return empleado_resource.mostrar(
                    {
                        id_empleado: id_empleado,
                    } ,
                    function( data ) {
                        callback( data );
                    }
                );
            },

            /**
            *   this function returns the promise that contains a json
            *   @author     Christian Velazquez <chris.abimael93@gmail.com>
            *   @since      08/03/2015
            *   @version    1
            *   @access     public
            *   @param      jsonObject [parametros]
            *   @param      Callbacks [callback]
            *   @return     promise
            *   @example    empleadoServices.eliminar( datos_empleado , function( data ){ .... });
            */
            eliminar: function( id_empleado , success , fail ) {
                return empleado_resource.eliminar(
                    {
                        id_empleado: id_empleado,
                    },
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
            *   @since      08/03/2015
            *   @version    1
            *   @access     public
            *   @param      jsonObject [parametros]
            *   @param      Callbacks [callback]
            *   @return     promise
            *   @example    empleadoServices.recuperar( datos_empleado , function( data ){ .... });
            */
            recuperar: function( id_empleado , success, fail ) {
                return empleado_recuperar.recuperar(
                    {
                        id_empleado: id_empleado,
                    },
                    function( data ) {
                        success( data );
                    }, function( data ) {
                        fail( data.data );
                    }
                );
            },
        };
}]);