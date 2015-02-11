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
angular.module( 'appZapateria' ).controller( 'EmpleadoCtrl' , [ '$location' , '$modal' , 'catalogosServices' ,
    function( $location , $modal , catalogosServices ) {

        var empleado = this;

        empleado.agregar = function( ) {
            if (empleado.empleado_form.$valid) {
                // Submit as normal
            } else {
                empleado.empleado_form.submitted = true;
            }
        }

        catalogosServices.tipo( 'pais', function( data ) {
            empleado.departamentos = data;
        });

        catalogosServices.tipoDependiente( { tipo: 'estado', id_padre: 1 } , function( data ) {
            empleado.estados = data;
        });

        empleado.cargaMunicipios = function( ) {
            catalogosServices.tipoDependiente( { tipo: 'municipio', id_padre: empleado.estado.id_estado } , function( data ) {
                empleado.municipios = data;
            });
        }
    }
]);