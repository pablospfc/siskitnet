sisKitnetApp.controller('ContratosController', function ($scope, $document, $timeout, ModalService, SiskitnetService) {
    var successGetContratos = function(success) {
        $scope.contratos = success.data;
        $scope.haveError  = false;
    };

    var errorGetContratos = function(data) {
        $scope.contratos = [];
        $scope.haveError  = data ;
    };

    SiskitnetService.getContratos(successGetContratos,errorGetContratos);

    $scope.deleteContrato = function(idLocatario) {
        bootbox.confirm("Você deseja realmente excluir este contrato?", function(result) {
            if(result) {
                SiskitnetService.excluirContrato(idContrato);
            }
            $timeout(function () {
                //$window.location.reload();
                SiskitnetService.getContratos(successGetContratos,errorGetContratos)
            }, 1000);
        });
    };


    $scope.showContratoModal = function (contrato) {
        ModalService.showModal({
            templateUrl: 'templates/view/contrato/create.html',
            controller: "contratoModalController",
            inputs: {
                contrato : contrato,
            }
        }).then(function (modal) {
            modal.element.modal();
            modal.close.then(function (result) {
                SiskitnetService.getContratos(successGetContratos,errorGetContratos);
                angular.element('.modal-backdrop').hide();
                angular.element($document[0].body).removeClass('modal-open');
                $timeout(function () {
                    $scope.flashMessage = false;
                }, 2000);
            });
        });
    };
});

sisKitnetApp.controller('contratoModalController', function ($scope, close, $filter, contrato, SiskitnetService) {

    var getFromArray = function(array,id) {
        var result = $.grep(array, function(e){ return e.id == id; });
        return result[0];
    };

    if(!angular.isUndefined(contrato)) {
        $scope.contrato = angular.copy(contrato);
        $scope.contrato.data_inicio =  $filter('date')($scope.contrato.data_inicio, 'dd/MM/yyyy');
        $scope.contrato.primeiro_vencimento =  $filter('date')($scope.contrato.primeiro_vencimento, 'dd/MM/yyyy');
    }

    var successGetImoveis = function(success) {
        $scope.listImoveis = success.data;
        $scope.haveError  = false;
        if (!angular.isUndefined($scope.contrato)){
            $scope.contrato.id_imovel = getFromArray($scope.listImoveis,$scope.contrato.id_imovel);
        }
    };

    var errorGetImoveis = function(data) {
        $scope.listImoveis = [];
        $scope.haveError  = data ;
    };

    var successGetLocatarios = function(success) {
        $scope.listLocatarios = success.data;
        $scope.haveError  = false;
        if (!angular.isUndefined($scope.contrato)){
            $scope.contrato.id_locatario = getFromArray($scope.listLocatarios,$scope.contrato.id_locatario);
        }
    };

    var errorGetLocatarios = function(data) {
        $scope.listLocatarios = [];
        $scope.haveError  = data ;
    };

    var successPostContrato = function(response) {
        if (response.data.status) {
            $scope.alert = {type: "success", title: "Parabéns!", message: response.data.message};
            $scope.contrato = undefined;
        }
        else
            $scope.alert = {type: "danger", title: "Ocorreu um problema!", message: response.data.message};
    };
    var errorPostContrato = function(response) {
        $scope.alert = {type: "danger", title: "Ocorreu um problema!", message: response.statusText};
    };

    SiskitnetService.getImoveis(successGetImoveis,errorGetImoveis);
    SiskitnetService.getLocatarios(successGetLocatarios,errorGetLocatarios);

    $scope.fechar = function(result) {
        close(result, 200);
    };

    $scope.salvarContrato = function() {

        $scope.contrato.id_imovel = $scope.contrato.id_imovel.id;
        $scope.contrato.id_locatario = $scope.contrato.id_locatario.id;
        this.tratarData();
        console.log($scope.contrato);
        if (angular.isUndefined(contrato))
            SiskitnetService.inserirContrato($scope.contrato,successPostContrato, errorPostContrato)
        else
            SiskitnetService.atualizarContrato($scope.contrato,successPostContrato, errorPostContrato)

    };

    $scope.tratarData = function() {
        if (angular.isDate($scope.contrato.primeiro_vencimento)) {
            $scope.contrato.primeiro_vencimento = $filter('date')($scope.contrato.primeiro_vencimento, 'yyyy-MM-dd');
            var dateChanged = $scope.contrato.primeiro_vencimento.replace(/\//g, "-");
            $scope.contrato.primeiro_vencimento = $filter('date')(dateChanged, 'yyyy-MM-dd');
        }else
            $scope.contrato.primeiro_vencimento = $scope.contrato.primeiro_vencimento.split("/").reverse().join("-");

        if (angular.isDate($scope.contrato.data_inicio)) {
            $scope.contrato.data_inicio = $filter('date')($scope.contrato.data_inicio, 'yyyy-MM-dd');
            var dateChanged = $scope.contrato.data_inicio.replace(/\//g, "-");
            $scope.contrato.data_inicio = $filter('date')(dateChanged, 'yyyy-MM-dd');
        }else
            $scope.contrato.data_inicio = $scope.contrato.data_inicio.split("/").reverse().join("-");

    }


});
