sisKitnetApp.controller('PagamentosController', function ($scope, $document, $timeout, ModalService, SiskitnetService) {
    var successGetPagamentos = function(success) {
        $scope.pagamentos = success.data;
        $scope.haveError  = false;
    };

    var errorGetPagamentos = function(data) {
        $scope.pagamentos = [];
        $scope.haveError  = data ;
    };

    SiskitnetService.getPagamentos(successGetPagamentos,errorGetPagamentos);

    $scope.deletePagamento = function(pagamento) {
        bootbox.confirm("Você deseja realmente excluir este imóvel?", function(result) {
            if(result) {
                SiskitnetService.excluirPagamento(pagamento);
            }
            $timeout(function () {
                SiskitnetService.getPagamentos(successGetPagamentos,errorGetPagamentos)
            }, 1000);
        });
    };

    $scope.showPagamentoModal = function (pagamento) {
        ModalService.showModal({
            templateUrl: 'templates/view/pagamento/create.html',
            controller: "pagamentoModalController",
            inputs: {
                pagamento : pagamento,
            }
        }).then(function (modal) {
            modal.element.modal();
            modal.close.then(function (result) {
                SiskitnetService.getPagamentos(successGetPagamentos,errorGetPagamentos)
                angular.element('.modal-backdrop').hide();
                angular.element($document[0].body).removeClass('modal-open');
                $timeout(function () {
                    $scope.flashMessage = false;
                }, 2000);
            });
        });
    };

});


sisKitnetApp.controller('pagamentoModalController', function ($scope, close, $filter, pagamento, SiskitnetService) {

    var getFromArray = function(array,id) {
        var result = $.grep(array, function(e){ return e.id == id; });
        return result[0];
    };

    if(!angular.isUndefined(pagamento)) {
        $scope.pagamento = angular.copy(pagamento);
        console.log($scope.pagamento);
        $scope.pagamento.data_pagamento =  $filter('date')($scope.pagamento.data_pagamento, 'dd/MM/yyyy');
        $scope.pagamento.periodo_inicial =  $filter('date')($scope.pagamento.periodo_inicial, 'dd/MM/yyyy');
        $scope.pagamento.periodo_final =  $filter('date')($scope.pagamento.periodo_final, 'dd/MM/yyyy');
    }

    var successGetContratosVigentes = function(success) {
        $scope.listContratosVigentes = success.data;
        $scope.haveError  = false;
        if (!angular.isUndefined($scope.pagamento)){
            $scope.pagamento.id_contrato = getFromArray($scope.listContratosVigentes,$scope.pagamento.id_contrato);
        }
    };

    var errorGetContratosVigentes = function(data) {
        $scope.listContratosVigentes = [];
        $scope.haveError  = data ;
    };

    var successPostPagamento = function(response) {
        if (response.data.status) {
            $scope.alert = {type: "success", title: "Parabéns!", message: response.data.message};
            $scope.pagamento = undefined;
        }
        else
            $scope.alert = {type: "danger", title: "Ocorreu um problema!", message: response.data.message};
    };
    var errorPostPagamento = function(response) {
        $scope.alert = {type: "danger", title: "Ocorreu um problema!", message: response.statusText};
    };

    SiskitnetService.getContratosVigentes(successGetContratosVigentes,errorGetContratosVigentes);

    $scope.setValorBase = function(){
        //$scope.pagamento.desconto = 0;
        $scope.pagamento.valor_base = $scope.pagamento.id_contrato.valor;
        //$scope.pagamento.valor_total = parseFloat($scope.pagamento.desconto) + parseFloat($scope.pagamento.valor_base);
    };

    $scope.setValorTotal = function(){
        $scope.pagamento.valor_total = parseFloat($scope.pagamento.valor_base) - parseFloat($scope.pagamento.desconto);
    };

    $scope.fechar = function(result) {
        close(result, 200);
    };



    $scope.salvarPagamento = function() {
        $scope.pagamento.id_contrato = $scope.pagamento.id_contrato.id;
        this.tratarData();
        if (angular.isUndefined(pagamento))
            SiskitnetService.inserirPagamento($scope.pagamento,successPostPagamento, errorPostPagamento);
        else
            SiskitnetService.atualizarPagamento($scope.pagamento,successPostPagamento, errorPostPagamento);

    };

    $scope.tratarData = function() {
        if (angular.isDate($scope.pagamento.periodo_inicial)) {
            $scope.pagamento.periodo_inicial = $filter('date')($scope.pagamento.periodo_inicial, 'yyyy-MM-dd');
            var dateChanged = $scope.pagamento.periodo_inicial.replace(/\//g, "-");
            $scope.pagamento.periodo_inicial = $filter('date')(dateChanged, 'yyyy-MM-dd');
        }else
            $scope.pagamento.periodo_inicial = $scope.pagamento.periodo_inicial.split("/").reverse().join("-");

        if (angular.isDate($scope.pagamento.periodo_final)) {
            $scope.pagamento.periodo_final = $filter('date')($scope.pagamento.periodo_final, 'yyyy-MM-dd');
            var dateChanged = $scope.pagamento.periodo_final.replace(/\//g, "-");
            $scope.pagamento.periodo_final = $filter('date')(dateChanged, 'yyyy-MM-dd');
        }else
            $scope.pagamento.periodo_final = $scope.pagamento.periodo_final.split("/").reverse().join("-");

        if (angular.isDate($scope.pagamento.data_pagamento)) {
            $scope.pagamento.data_pagamento = $filter('date')($scope.pagamento.data_pagamento, 'yyyy-MM-dd');
            var dateChanged = $scope.pagamento.data_pagamento.replace(/\//g, "-");
            $scope.pagamento.data_pagamento = $filter('date')(dateChanged, 'yyyy-MM-dd');
        }else
            $scope.pagamento.data_pagamento = $scope.pagamento.data_pagamento.split("/").reverse().join("-");

    }


});/**
 * Created by claud on 29/10/2017.
 */

