sisKitnetApp.controller('RenovacaoController', function ($scope, $document, $timeout, ModalService, SiskitnetService) {
    //$scope.contratos_vencidos = Vencidos;
    SiskitnetService.getContratosVencidos();
    $scope.naoRenovarContrato = function(idContrato) {
        bootbox.confirm("Você deseja realmente NÃO renovar este contrato?", function(result) {
            if(result) {
                SiskitnetService.naoRenovar(idContrato);
            }
            $timeout(function () {
                //$window.location.reload();
                SiskitnetService.getContratosVencidos();
            }, 1000);
        });
    };

    $scope.showRenovacaoModal = function (contrato) {
        ModalService.showModal({
            templateUrl: 'templates/view/renovacao/create.html',
            controller: "renovacaoModalController",
            inputs: {
                contrato : contrato,
            }
        }).then(function (modal) {
            modal.element.modal();
            modal.close.then(function (result) {
                //$scope.contratos_vencidos = Vencidos;
                SiskitnetService.getContratosVencidos();
                angular.element('.modal-backdrop').hide();
                angular.element($document[0].body).removeClass('modal-open');
                $timeout(function () {
                    $scope.flashMessage = false;
                }, 2000);
            });
        });
    };
});

sisKitnetApp.controller('renovacaoModalController', function ($scope, close, $filter, contrato, SiskitnetService) {
    var successPostRenovacao = function(response) {
        if (response.data.status) {
            $scope.alert = {type: "success", title: "Parabéns!", message: response.data.message};
            $scope.contrato = undefined;
        }
        else
            $scope.alert = {type: "danger", title: "Ocorreu um problema!", message: response.data.message};
    };
    var errorPostRenovacao = function(response) {
        $scope.alert = {type: "danger", title: "Ocorreu um problema!", message: response.statusText};
    };

    $scope.fechar = function(result) {
        close(result, 200);
    };

    $scope.renovarContrato = function() {
        $scope.renovacao.id_contrato = contrato.id;
        $scope.renovacao.id_locatario = contrato.id_locatario;
        $scope.renovacao.id_imovel = contrato.id_imovel;
        this.tratarData();
            SiskitnetService.renovar($scope.renovacao,successPostRenovacao, errorPostRenovacao);
    };

    $scope.tratarData = function() {
        if (angular.isDate($scope.renovacao.data_inicio)) {
            $scope.renovacao.data_inicio = $filter('date')($scope.renovacao.data_inicio, 'yyyy-MM-dd');
            var dateChanged = $scope.renovacao.data_inicio.replace(/\//g, "-");
            $scope.renovacao.data_inicio = $filter('date')(dateChanged, 'yyyy-MM-dd');
        }else
            $scope.renovacao.data_inicio = $scope.renovacao.data_inicio.split("/").reverse().join("-");

        if (angular.isDate($scope.renovacao.primeiro_vencimento)) {
            $scope.renovacao.primeiro_vencimento = $filter('date')($scope.renovacao.primeiro_vencimento, 'yyyy-MM-dd');
            var dateChanged = $scope.renovacao.primeiro_vencimento.replace(/\//g, "-");
            $scope.renovacao.primeiro_vencimento = $filter('date')(dateChanged, 'yyyy-MM-dd');
        }else
            $scope.renovacao.primeiro_vencimento = $scope.renovacao.primeiro_vencimento.split("/").reverse().join("-");

    }

});



