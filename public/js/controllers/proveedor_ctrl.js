/**
    *   This controller allows us to manipulate information of employees.
    *   @author     Cesar Herrera <kyele936@gmail.com>
    *   @since      02/07/2015
    *   @version    1
    *   @access     public
    *   @param      Service [$resource]
    *   @param      Service [$location]
    *   @param      Service [routeServices]
    *   @return     
    *   @example    proveedor.registrar( .... )
*/
angular.module( 'appZapateria' ).controller( 'ProveedorCtrl' , [ '$location' , '$modal' , 'catalogosServices' , 'proveedorServices' , '$state' ,
    function( $location , $modal , catalogosServices , proveedorServices , $state ) {

        var proveedor = this;

        proveedor.datos_form = {};

        //Carga de catálogos        
        catalogosServices.tipoDependiente( { tipo: 'estado', id_padre: 1 } , function( data ) {
            proveedor.estados = data;
        });

        proveedor.cargaMunicipios = function( ) {
            catalogosServices.tipoDependiente( { tipo: 'municipio', id_padre: proveedor.estado.id_estado } , function( data ) {
                proveedor.municipios = data;
            });
        };

        proveedor.cargaColonias = function( ) {
            catalogosServices.tipoDependiente( { tipo: 'colonia', id_padre: proveedor.municipio.id_municipio } , function( data ) {
                proveedor.colonias = data;
            });
        };

        proveedor.agregar = function( ) {
            proveedor.datos_form.id_pais         = 1;
            proveedor.datos_form.id_estado       = proveedor.estado.id_estado;
            proveedor.datos_form.id_municipio    = proveedor.municipio.id_municipio;
            proveedor.datos_form.id_colonia      = proveedor.colonia.id_colonia;
            proveedor.datos_form.nombre          = proveedor.nombre;
            proveedor.datos_form.apellidos       = proveedor.apellidos;
            proveedor.datos_form.rfc             = proveedor.rfc;
            proveedor.datos_form.razon_social    = proveedor.razon_social;
            proveedor.datos_form.correo          = proveedor.correo;
            proveedor.datos_form.calle           = proveedor.calle;
            proveedor.datos_form.num_ext         = proveedor.num_ext;
            proveedor.datos_form.num_int         = proveedor.num_int;
            proveedor.datos_form.telefono        = proveedor.telefono;
            proveedor.datos_form.celular         = proveedor.celular;

            proveedorServices.agregar( proveedor.datos_form ,
                function( data ) {
                    console.log( data.message );
                    $state.go("gestion.proveedor_list");
                }, function( data ) {
                    console.log( data.message );
                }
            );
        };
    }
]);

/**
    *   This controller allows us to manipulate information of employees.
    *   @author     Cesar Herrera <kyele936@gmail.com>
    *   @since      03/08/2015
    *   @version    1
    *   @access     public
    *   @param      Service [$resource]
    *   @param      Service [$location]
    *   @param      Service [routeServices]
    *   @return     
    *   @example    proveedor.listar( .... )
*/
angular.module( 'appZapateria' ).controller( 'ProveedorListCtrl' , [ '$location' , '$modal' , 'catalogosServices' , 'proveedorServices' ,
    function( $location , $modal , catalogosServices , proveedorServices ) {

        var proveedor_list   = this,
            offset          = 0;

        proveedor_list.proveedors = [];
        proveedor_list.estatus   = 0;
        

        /**
        *   Esta función carga el catálogo de proveedores
        *   @author     Cesar Herrera <kyele936@gmail.com>
        *   @since      03/08/2015
        *   @version    1
        *   @access     public
        *   @return     void
        *   @example    proveedor_list.listar( );
        */
        proveedor_list.listar = function( ) {
            proveedorServices.listar( 
                {
                    offset:         offset, 
                    eliminado:      proveedor_list.estatus,
                    palabra_clave:  proveedor_list.palabra_clave,
                }, 
                function( data ) {
                    proveedor_list.proveedores = data.data;
                    //console.log( proveedor_list.proveedors.nombre );
                    //console.log( data );
                }
            );
        };

        /**
        *   Esta función crea un modal donde se cargan los datos de un proveedor
        *   @author     Cesar Herrera <kyele936@gmail.com>
        *   @since      03/08/2015
        *   @version    1
        *   @access     public
        *   @param      int [id_proveedor]
        *   @return     void
        *   @example    proveedor_list.proveedor_details( id_proveedor );
        */
        proveedor_list.proveedor_details = function( id_proveedor ) {
            var instancia_modal = $modal.open( 
                {
                    templateUrl:    'views/modals/proveedor_modal_details.html',
                    controller:     'ProveedorModalDetailsCtrl',
                    controllerAs:   'proveedor',
                    size:           'lg',
                    resolve: {
                        id_proveedor: function() {
                            return id_proveedor;
                        }
                    }
                }
            );
        };

        /**
        *   Esta función permite eliminar un proveedor activo
        *   @author     Cesar Herrera <kyele936@gmail.com>
        *   @since      03/08/2015
        *   @version    1
        *   @access     public
        *   @param      int [id_proveedor]
        *   @return     void
        *   @example    proveedor_list.proveedor_eliminar( id_proveedor );
        */
        proveedor_list.proveedor_eliminar = function( id_proveedor ) {
            proveedorServices.eliminar( id_proveedor,
                function( data ) {
                    console.log( data );
                    proveedor_list.listar( );
                }, function( data ) {
                    console.log( data );
                }
            );
        };

        /**
        *   Esta función permite recuperar un proveedor eliminado
        *   @author     Christian Velazquez <chris.abimael93@gmail.com>
        *   @since      07/03/2015
        *   @version    1
        *   @access     public
        *   @param      int [id_proveedor]
        *   @return     void
        *   @example    proveedor_list.proveedor_recuperar( id_proveedor );
        */
        proveedor_list.proveedor_recuperar = function( id_proveedor ) {
            proveedorServices.recuperar( id_proveedor,
                function( data ) {
                    console.log( data );
                    proveedor_list.listar( );
                }, function( data ) {
                    console.log( data );
                }
            );
        };
        proveedor_list.listar( );
    }
]);

angular.module( 'appZapateria' ).controller( 'ProveedorModalDetailsCtrl' , [ 'id_proveedor' , 'proveedorServices' , '$state' , 'catalogosServices' , 
    function( id_proveedor , proveedorServices , $state , catalogosServices ) {

        var proveedor = this;

        //Carga de catálogos
        catalogosServices.tipoDependiente( { tipo: 'estado', id_padre: 1 } , function( data ) {
            proveedor.estados = data;
        });
        proveedor.cargaMunicipios = function( ) {
            catalogosServices.tipoDependiente( { tipo: 'municipio', id_padre: proveedor.estado.id_estado } , function( data ) {
                proveedor.municipios = data;
            });
        };

        proveedor.cargaColonias = function( ) {
            catalogosServices.tipoDependiente( { tipo: 'colonia', id_padre: proveedor.municipio.id_municipio } , function( data ) {
                proveedor.colonias = data;
            });
        };
        
        proveedorServices.mostrar( id_proveedor , 
            function( data ) {
                console.log( data.data );
                proveedor.datos = data.data;

            }
        );

        proveedor.actualizar = function( ) {
            proveedor.datos_form.id_proveedor = id_proveedor;

            proveedorServices.actualizar( 
                proveedor.datos_form , 
                function( data ) {
                    console.log( data );
                    $state.go( 'gestion.proveedor_list' );
                },
                function( data ) {
                    console.log( data );
                }
            );
        };
    }
]);