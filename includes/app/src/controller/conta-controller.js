/**
 * Created by claud on 24/02/2018.
 */
sisKitnetApp.controller('ContaController', function ($scope, $document, Usuario, $location, $timeout, SiskitnetService) {

    $scope.usuario = Usuario;
    $scope.redefinirSenha = function(){
        var pid = $location.search();
        $scope.formulario.token = pid.pid;
        SiskitnetService.redefinir($scope.formulario);
    };

    $scope.registrarUsuario = function() {
        SiskitnetService.registrar($scope.formulario);
    };

    $scope.verificarUsuario = function() {
        SiskitnetService.verificarCPF($scope.formulario);
    };

    $scope.atualizar = function(){
        console.log($scope.usuario);
        SiskitnetService.atualizarUsuario($scope.usuario);

    }
});