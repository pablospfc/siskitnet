sisKitnetApp.controller('RelatoriosController', function ($scope, $document, $timeout, ModalService, SiskitnetService) {
    $scope.abrirFormularioDespesa = function () {
        SiskitnetService.getMeses($scope);
        SiskitnetService.getTiposDeDespesas($scope);
        $scope.formularioDespesa = true;
        $scope.formularioLocatario = false;
        $scope.formularioImovel = false;
        $scope.formularioIndenizacao = false;
        $scope.formularioAluguel = false;
    };

    $scope.abrirFormularioLocatario = function () {
        $scope.formularioLocatario = true;
        $scope.formularioDespesa = false;
        $scope.formularioImovel = false;
        $scope.formularioIndenizacao = false;
        $scope.formularioAluguel = false;
        $scope.relatorio = undefined;
    };

    $scope.abrirFormularioImovel = function () {
        $scope.formularioImovel = true;
        $scope.formularioLocatario = false;
        $scope.formularioDespesa = false;
        $scope.formularioIndenizacao = false;
        $scope.formularioAluguel = false;
        $scope.relatorio = undefined;
    }
    ;
    $scope.abrirFormularioIndenizacao = function () {
        $scope.formularioIndenizacao = true;
        $scope.formularioLocatario = false;
        $scope.formularioDespesa = false;
        $scope.formularioAluguel = false;
        $scope.formularioImovel = false;
        $scope.relatorio = undefined;
    };

    $scope.abrirFormularioAluguel = function () {
        $scope.formularioAluguel = true;
        $scope.formularioIndenizacao = false;
        $scope.formularioLocatario = false;
        $scope.formularioDespesa = false;
        $scope.formularioImovel = false;
        $scope.relatorio = undefined;
    };

    $scope.getRelatorioDespesas = function(mes,ano,tipo){
        SiskitnetService.relatorioDespesas($scope,mes,ano,tipo).then(function(dados){
         $scope.relatorio = dados;
        });
    };

    $scope.getRelatorioLocatarios = function(){
        SiskitnetService.relatorioLocatarios();
    };
});