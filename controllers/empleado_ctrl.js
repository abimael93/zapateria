var empleado = angular.module('apEmpleados',['app_paginado','angularUtils.directives.dirPagination']);

empleado.controller('ControladorEmpleados', function empleado_ControladorDos() {
	var emp = this;
	emp.empleados = [
		{
		    rendering: 'Trident', browser: 'Internet Explorer 4.0', plataform: 'Win 95+', version: '4',
		    grade: 'X'
		},
		{
		    rendering: 'Trident', browser: 'Internet Explorer 5.0', plataform: 'Win 95+', version: '5',
		    grade: 'C'
		},
		{
		    rendering: 'Trident', browser: 'Internet Explorer 5.5', plataform: 'Win 95+', version: '5.5',
		    grade: 'A'
		},
		{
		    rendering: 'Trident', browser: 'Internet Explorer 6', plataform: 'Win 98+', version: '6',
		    grade: 'A'
		}
	];
});

angular.module('apEmpleados').factory('Fabrica', function() {
  var servicio = {
    objeto: {mensaje: 'Saludos desde la Fabrica desde Controlador Empleados!'},
    msjInicial: function() {
      servicio.objeto['mensaje'] = 'Saludos desde la Fabrica!';
    },
    msjNuevo: function(msj) {
      servicio.objeto.mensaje = msj;
    }
  };
  return servicio;
});