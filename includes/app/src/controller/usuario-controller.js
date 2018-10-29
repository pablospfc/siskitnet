/**
 * Created by claud on 23/02/2018.
 */
sisKitnetApp.controller('UsuarioController', function ($scope, $window, $document, PATHS,$location, $timeout, SiskitnetService) {

    //$scope.usuario = Usuario;
    $scope.redefinirSenha = function(){
        var pid = $location.search();
        $scope.formulario.token = pid.pid;
        SiskitnetService.redefinir($scope.formulario);
    };

    $scope.registrarUsuario = function() {
        console.log($scope.formulario);
        SiskitnetService.registrar($scope.formulario);
    };

    $scope.verificarUsuario = function() {
        SiskitnetService.verificarCPF($scope.formulario);
    };

    $scope.download = function() {
        $window.open(PATHS.PATH_ARQUIVOS + 'termo_de_uso.pdf', '_blank');
    }
});