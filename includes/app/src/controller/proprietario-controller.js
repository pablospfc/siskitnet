sisKitnetApp.controller('ProprietarioController', function ($scope, $document, Proprietario, $location, $timeout, SiskitnetService) {

    $scope.proprietario = Proprietario;

    var getFromArray = function(array,id) {
        var result = $.grep(array, function(e){ return e.id == id; });
        return result[0];
    };

    var successGetEstadosCivis = function(success) {
        $scope.listEstadosCivis = success.data;
        $scope.haveError  = false;

        $scope.proprietario.id_estado_civil = getFromArray($scope.listEstadosCivis,$scope.proprietario.id_estado_civil);

    };

    var errorGetEstadosCivis = function(data) {
        $scope.listEstadosCivis = [];
        $scope.haveError  = data ;
    };

    SiskitnetService.getEstadosCivis(successGetEstadosCivis,errorGetEstadosCivis);

    $scope.atualizar = function(){
        $scope.proprietario.id_estado_civil = $scope.proprietario.id_estado_civil.id;
        SiskitnetService.atualizarProprietario($scope.proprietario);

    }
});