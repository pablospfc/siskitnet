sisKitnetApp.controller('RegistroController', function ($scope, $document, $timeout, ModalService, SiskitnetService) {

    $scope.registrarUsuario = function() {
        SiskitnetService.registrar($scope.formulario);
    };

});
