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
angular.module( 'appZapateria' ).controller( 'ProveedorCtrl' , [ '$location' , '$modal' , 'catalogosServices' , 'proveedorServices' ,
    function( $location , $modal , catalogosServices , proveedorServices ) {

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
            proveedor.datos_form.razon_social    = proveedor.rfc;
            proveedor.datos_form.correo          = proveedor.correo;
            proveedor.datos_form.calle           = proveedor.calle;
            proveedor.datos_form.num_ext         = proveedor.num_ext;
            proveedor.datos_form.num_int         = proveedor.num_int;
            proveedor.datos_form.telefono        = proveedor.telefono;
            proveedor.datos_form.celular         = proveedor.celular;

            proveedorServices.agregar( proveedor.datos_form ,
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