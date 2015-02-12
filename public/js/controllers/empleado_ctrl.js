/**
    *   This controller allows us to manipulate information of employees.
    *   @author     Christian Velázquez <chris.abimael93@gmail.com>
    *   @since      02/07/2015
    *   @version    1
    *   @access     public
    *   @param      Service [$resource]
    *   @param      Service [$location]
    *   @param      Service [routeServices]
    *   @return     
    *   @example    empleado.registrar( .... )
*/
angular.module( 'appZapateria' ).controller( 'EmpleadoCtrl' , [ '$location' , '$modal' , 'catalogosServices' , 'empleadoServices' ,
    function( $location , $modal , catalogosServices , empleadoServices ) {

        var empleado = this;

        empleado.datos_form = {};

        //Carga de catálogos
        catalogosServices.tipo( 'departamento' , function( data ) {
            empleado.departamentos = data;
        });

        catalogosServices.tipo( 'cargo' , function( data ) {
            empleado.cargos = data;
        });

        catalogosServices.tipoDependiente( { tipo: 'estado', id_padre: 1 } , function( data ) {
            empleado.estados = data;
        });

        empleado.cargaMunicipios = function( ) {
            catalogosServices.tipoDependiente( { tipo: 'municipio', id_padre: empleado.estado.id_estado } , function( data ) {
                empleado.municipios = data;
            });
        };

        empleado.cargaColonias = function( ) {
            catalogosServices.tipoDependiente( { tipo: 'colonia', id_padre: empleado.municipio.id_municipio } , function( data ) {
                empleado.colonias = data;
            });
        };

        empleado.agregar = function( ) {
            empleado.datos_form.id_cargo        = empleado.cargo.id_cargo;
            empleado.datos_form.id_departamento = empleado.departamento.id_departamento;
            empleado.datos_form.id_pais         = 1;
            empleado.datos_form.id_estado       = empleado.estado.id_estado;
            empleado.datos_form.id_municipio    = empleado.municipio.id_municipio;
            empleado.datos_form.id_colonia      = empleado.colonia.id_colonia;
            empleado.datos_form.nombre          = empleado.nombre;
            empleado.datos_form.apellidos       = empleado.apellidos;
            empleado.datos_form.rfc             = empleado.rfc;
            empleado.datos_form.foto            = empleado.foto;
            empleado.datos_form.correo          = empleado.correo;
            empleado.datos_form.usuario         = empleado.usuario;
            //empleado.datos_form.password      = empleado.password;
            empleado.datos_form.calle           = empleado.calle;
            empleado.datos_form.num_ext         = empleado.num_ext;
            empleado.datos_form.num_int         = empleado.num_int;
            empleado.datos_form.telefono        = empleado.telefono;
            empleado.datos_form.celular         = empleado.celular;

            empleadoServices.agregar( empleado.datos_form ,
                function( data ) {
                    console.log( data.message );
                }, function( data ) {
                    console.log( data.message );
                }
            );
        };
    }
]);