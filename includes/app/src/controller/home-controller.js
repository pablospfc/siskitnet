sisKitnetApp.controller('HomeController', function ($scope,$rootScope, $document, $timeout, ModalService, SiskitnetService) {
    var successGetQuanitativos = function(success) {
        $scope.quantitativos = success.data;
        $scope.haveError  = false;
    };

    var errorGetQuanitativos = function(data) {
        $scope.quantitativos = [];
        $scope.haveError  = data ;
    };
    SiskitnetService.getQuantitativos(successGetQuanitativos,errorGetQuanitativos);
});