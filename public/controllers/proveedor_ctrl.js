angular.module('appZapateria').controller('ProveedorCtrl',['$log', function ($log) {
  var prov = this;
  prov.totalItems = 64;
  prov.currentPage = 4;

  prov.setPage = function (pageNo) {
    prov.currentPage = pageNo;
  };

  prov.pageChanged = function() {
    $log.log('Page changed to: ' + prov.currentPage);
  };

  prov.maxSize = 5;
  prov.bigTotalItems = 175;
  prov.bigCurrentPage = 1;
  prov.itemsPerPage = 50;
}]);