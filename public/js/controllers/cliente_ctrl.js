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
    *   @example    cliente.registrar( .... )
*/
angular.module( 'appZapateria' ).controller( 'ClienteCtrl' , [ '$location' , '$modal' , 'catalogosServices' , 'clienteServices' , '$state' ,
    function( $location , $modal , catalogosServices , clienteServices , $state) {

        var cliente = this;

        cliente.datos_form = {};

        //Carga de catálogos        
        catalogosServices.tipoDependiente( { tipo: 'estado', id_padre: 1 } , function( data ) {
            cliente.estados = data;
        });

        cliente.cargaMunicipios = function( ) {
            catalogosServices.tipoDependiente( { tipo: 'municipio', id_padre: cliente.estado.id_estado } , function( data ) {
                cliente.municipios = data;
            });
        };

        cliente.cargaColonias = function( ) {
            catalogosServices.tipoDependiente( { tipo: 'colonia', id_padre: cliente.municipio.id_municipio } , function( data ) {
                cliente.colonias = data;
            });
        };

        cliente.agregar = function( ) {
            cliente.datos_form.id_pais         = 1;
            cliente.datos_form.id_estado       = cliente.estado.id_estado;
            cliente.datos_form.id_municipio    = cliente.municipio.id_municipio;
            cliente.datos_form.id_colonia      = cliente.colonia.id_colonia;
            cliente.datos_form.nombre          = cliente.nombre;
            cliente.datos_form.apellidos       = cliente.apellidos;
            cliente.datos_form.rfc             = cliente.rfc;
            cliente.datos_form.razon_social    = cliente.razon_social;
            cliente.datos_form.correo          = cliente.correo;
            cliente.datos_form.calle           = cliente.calle;
            cliente.datos_form.num_ext         = cliente.num_ext;
            cliente.datos_form.num_int         = cliente.num_int;
            cliente.datos_form.telefono        = cliente.telefono;
            cliente.datos_form.celular         = cliente.celular;

            clienteServices.agregar( cliente.datos_form ,
                function( data ) {
                    console.log( data.message );
                    $state.go("gestion.cliente_list");
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
    *   @example    cliente.listar( .... )
*/
angular.module( 'appZapateria' ).controller( 'ClienteListCtrl' , [ '$location' , '$modal' , 'catalogosServices' , 'clienteServices' ,
    function( $location , $modal , catalogosServices , clienteServices ) {

        var cliente_list   = this,
            offset          = 0;

        cliente_list.clientes = [];
        cliente_list.estatus   = 0;
        

        /**
        *   Esta función carga el catálogo de clientees
        *   @author     Cesar Herrera <kyele936@gmail.com>
        *   @since      03/08/2015
        *   @version    1
        *   @access     public
        *   @return     void
        *   @example    cliente_list.listar( );
        */
        cliente_list.listar = function( ) {
            clienteServices.listar( 
                {
                    offset:         offset, 
                    eliminado:      cliente_list.estatus,
                    palabra_clave:  cliente_list.palabra_clave,
                }, 
                function( data ) {
                    cliente_list.clientes = data.data;
                    //console.log( cliente_list.clientes.nombre );
                    //console.log( data );
                }
            );
        }

        /**
        *   Esta función crea un modal donde se cargan los datos de un cliente
        *   @author     Cesar Herrera <kyele936@gmail.com>
        *   @since      03/08/2015
        *   @version    1
        *   @access     public
        *   @return     void
        *   @example    cliente_list.cliente_details( );
        */
        cliente_list.cliente_details = function( datos_cliente ) {
            var instancia_modal = $modal.open( 
                {
                    templateUrl: 'views/modals/cliente_modal_details.html',
                    controller: 'clienteModalDetailsCtrl',
                    size: 'lg',
                    resolve: {
                    datos_cliente: function() {
                        return datos_cliente;
                    }
                }
            });
        };

        cliente_list.listar( );
    }
]);