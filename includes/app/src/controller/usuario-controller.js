/**
 * Created by claud on 23/02/2018.
 */
sisKitnetApp.controller('UsuarioController', function ($scope, $document, $location, $timeout, SiskitnetService) {

    //$scope.usuario = Usuario;
    $scope.redefinirSenha = function(){
        var pid = $location.search();
        $scope.formulario.token = pid.pid;
        SiskitnetService.redefinir($scope.formulario);
    };

    $scope.registrarUsuario = function() {
        SiskitnetService.registrar($scope.formulario);
    };

    $scope.verificarUsuario = function() {
        console.log($scope.formulario);
        SiskitnetService.verificarCPF($scope.formulario);
    };
});