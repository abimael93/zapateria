/**
    *   this service allows us to manipulate the provider information
    *   @author     Cesar herrera <kyele936@gmail.com>
    *   @since      03/08/2015
    *   @version    1
    *   @access     public
    *   @param      Service [$resource]
    *   @param      Service [routeServices]
    *   @return     
    *   @example    catalogosServices.getDep(function(data){.....}
*/
angular.module( 'appZapateria' ).service( 'clienteServices' , [ '$resource' , 'routeServices' , function( $resource , routeServices ) {

        var path_server = routeServices.PathServer + 'clientes';

        var cliente_resource = $resource( path_server , {}, {
                agregar: {
                    method: 'POST'
                }
            });
            cliente_listar     = $resource( path_server + "/listar/:offset/:eliminado" , {}, {
                listar: {
                    method: 'POST',
                    params: {
                        offset:         '@offset',
                        eliminado:      '@eliminado',
                    }
                }
            });
            cliente_resource   = $resource( path_server + "/:id_cliente" , {}, {
                modificar: {
                    method: 'PUT',
                    params: {
                        id_cliente:    '@id_cliente',
                    }
                },
                mostrar: {
                    method: 'GET',
                    params: {
                        id_cliente:    '@id_cliente',
                    }
                },
                eliminar: {
                    method: 'DELETE',
                    params: {
                        id_cliente:    '@id_cliente',
                    }
                }
            }),
            cliente_recuperar  = $resource( path_server + "/recuperar/:id_cliente" , {} , {
                recuperar: {
                    method: 'GET',
                    params: {
                        id_cliente:    '@id_cliente',
                    }
                }
            });


        return {
            /**
            *   this function returns the promise that contains a json
            *   @author     Cesar herrera <kyele936@gmail.com>
            *   @since      03/08/2015
            *   @version    1
            *   @access     public
            *   @param      jsonObject [cliente]
            *   @param      Callbacks [success]
            *   @param      Callbacks [fail]
            *   @return     promise
            *   @example    clienteServices.registrar( {} , function( data ){ .... }, function( data ) { .... } )
            */
            agregar: function( cliente , success, fail ) {
                return cliente_resource.agregar( cliente ,
                    function( data ) {
                        success( data );
                    }, function( data ) {
                        fail( data.data );
                    }
                );
            },
            /**
            *   this function returns the promise that contains a json
            *   @author     Cesar herrera <kyele936@gmail.com>
            *   @since      03/08/2015
            *   @version    1
            *   @access     public
            *   @param      jsonObject [parametros]
            *   @param      Callbacks [callback]
            *   @return     promise
            *   @example    clienteServices.listar( { offset: 0 , eliminado: 0 } function( data ){ .... });
            */
            listar: function( parametros , callback ) {
                return cliente_listar.listar( parametros ,
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
            *   @example    clienteServices.modificar( datos_cliente , function( data ){ .... });
            */
            modificar: function( cliente , success , fail ) {
                return cliente_resource.actualizar( cliente ,
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
            *   @example    clienteServices.mostrar( datos_cliente , function( data ){ .... });
            */
            mostrar: function( id_cliente , callback ) {
                return cliente_resource.mostrar(
                    {
                        id_cliente: id_cliente,
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
            *   @example    clienteServices.eliminar( datos_cliente , function( data ){ .... });
            */
            eliminar: function( id_cliente , success , fail ) {
                return cliente_resource.eliminar(
                    {
                        id_cliente: id_cliente,
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
            *   @example    clienteServices.recuperar( datos_cliente , function( data ){ .... });
            */
            recuperar: function( id_cliente , success, fail ) {
                return cliente_recuperar.recuperar(
                    {
                        id_cliente: id_cliente,
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