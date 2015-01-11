var miAp = angular.module('miAp', []);

function ControladorUno($scope, Fabrica) {
  $scope.nuevo = function() {
    Fabrica.msjNuevo($scope.nuevoMensaje);
  };

  $scope.dato = Fabrica.objeto;
};

function ControladorDos($scope, Fabrica) {
  $scope.nuevo = function() {
    Fabrica.msjNuevo($scope.nuevoMensaje);
  };

  $scope.dato = Fabrica.objeto;
};

function ControladorTres($scope, Fabrica) {
  $scope.resetear = function() {
    Fabrica.msjInicial();
  };
};