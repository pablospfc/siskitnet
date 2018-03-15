/**
 * Created by claud on 23/02/2018.
 */
sisKitnetApp.controller('RedefinicaoSenhaController', function ($scope, $document, $timeout, ModalService, SiskitnetService) {

$scope.redefinirSenha = function(){
    SiskitnetService.redefinir($scope.formulario);
};
});

