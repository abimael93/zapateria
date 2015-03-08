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
angular.module( 'appZapateria' ).controller( 'EmpleadoAltaCtrl' , [ '$location' , '$modal' , 'catalogosServices' , 'empleadoServices' ,
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

        /**
        *   Esta función carga el catálogo de municipios
        *   @author     Christian Velazquez <chris.abimael93@gmail.com>
        *   @since      02/11/2015
        *   @version    1
        *   @access     public
        *   @return     void
        *   @example    empleado.cargaMunicipios( );
        */
        empleado.cargaMunicipios = function( ) {
            catalogosServices.tipoDependiente( { tipo: 'municipio', id_padre: empleado.estado.id_estado } , function( data ) {
                empleado.municipios = data;
            });
        };

        /**
        *   Esta función carga el catálogo de colonias
        *   @author     Christian Velazquez <chris.abimael93@gmail.com>
        *   @since      02/11/2015
        *   @version    1
        *   @access     public
        *   @return     void
        *   @example    empleado.cargaColonias( );
        */
        empleado.cargaColonias = function( ) {
            catalogosServices.tipoDependiente( { tipo: 'colonia', id_padre: empleado.municipio.id_municipio } , function( data ) {
                empleado.colonias = data;
            });
        };

        /**
        *   Esta función crea un nuevo empleado
        *   @author     Christian Velazquez <chris.abimael93@gmail.com>
        *   @since      02/11/2015
        *   @version    1
        *   @access     public
        *   @return     void
        *   @example    empleado.agregar( );
        */
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

        /*empleadoServices.listar( { offset: 0 , eliminado: 0 } , 
            function( data ) {
                console.log( data );
            }
        );*/
    }
]);

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
angular.module( 'appZapateria' ).controller( 'EmpleadoListCtrl' , [ '$location' , '$modal' , 'catalogosServices' , 'empleadoServices' ,
    function( $location , $modal , catalogosServices , empleadoServices ) {

        var empleado_list   = this,
            offset          = 0;

        empleado_list.empleados = [];
        empleado_list.estatus   = 0;

        empleado_list.listar( );

        /**
        *   Esta función carga el catálogo de empleados
        *   @author     Christian Velazquez <chris.abimael93@gmail.com>
        *   @since      07/03/2015
        *   @version    1
        *   @access     public
        *   @return     void
        *   @example    empleado.cargaMunicipios( );
        */
        empleado_list.listar = function( ) {
            empleadoServices.listar( 
                {
                    offset:         empleado_list.offset, 
                    eliminado:      empleado_list.estatus,
                    palabra_clave:  empleado_list.palabra_clave,
                }, 
                function( data ) {
                    empleado_list.empleados = data.data;
                    //console.log( empleado_list.empleados.nombre );
                    //console.log( data );
                }
            );
        }
        
        /**
        *   Esta función carga el catálogo de colonias
        *   @author     Christian Velazquez <chris.abimael93@gmail.com>
        *   @since      02/11/2015
        *   @version    1
        *   @access     public
        *   @return     void
        *   @example    empleado.cargaColonias( );
        */
        

        /**
        *   Esta función crea un nuevo empleado
        *   @author     Christian Velazquez <chris.abimael93@gmail.com>
        *   @since      02/11/2015
        *   @version    1
        *   @access     public
        *   @return     void
        *   @example    empleado.agregar( );
        */
        

        
    }
]);