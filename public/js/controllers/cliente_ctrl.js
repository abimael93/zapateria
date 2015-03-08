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