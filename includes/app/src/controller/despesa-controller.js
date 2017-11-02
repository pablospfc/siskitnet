sisKitnetApp.controller('DespesasController', function ($scope, $document, $timeout, ModalService, SiskitnetService) {
    var successGetDespesas = function(success) {
        $scope.despesas = success.data;
        $scope.haveError  = false;
    };

    var errorGetDespesas = function(data) {
        $scope.despesas = [];
        $scope.haveError  = data ;
    };

    SiskitnetService.getDespesas(successGetDespesas,errorGetDespesas);

    $scope.deleteDespesa = function(idDespesa) {
        bootbox.confirm("Você deseja realmente excluir este imóvel?", function(result) {
            if(result) {
                SiskitnetService.excluirDespesa(idDespesa);
            }
            $timeout(function () {
                SiskitnetService.getDespesas(successGetDespesas,errorGetDespesas)
            }, 1000);
        });
    };

    $scope.showDespesaModal = function (despesa) {
        ModalService.showModal({
            templateUrl: 'templates/view/despesa/create.html',
            controller: "despesaModalController",
            inputs: {
                despesa : despesa,
            }
        }).then(function (modal) {
            modal.element.modal();
            modal.close.then(function (result) {
                SiskitnetService.getDespesas(successGetDespesas,errorGetDespesas)
                angular.element('.modal-backdrop').hide();
                angular.element($document[0].body).removeClass('modal-open');
                $timeout(function () {
                    $scope.flashMessage = false;
                }, 2000);
            });
        });
    };

});


sisKitnetApp.controller('despesaModalController', function ($scope, close, $filter, despesa, SiskitnetService) {

    var getFromArray = function(array,id) {
        var result = $.grep(array, function(e){ return e.id == id; });
        return result[0];
    };

    if(!angular.isUndefined(despesa)) {
        $scope.despesa = angular.copy(despesa);
        $scope.despesa.data =  $filter('date')($scope.despesa.data, 'dd/MM/yyyy');
    }

    var successGetTiposDespesas = function(success) {
        $scope.listTiposDespesas = success.data;
        $scope.haveError  = false;
        if (!angular.isUndefined($scope.despesa)){
            $scope.despesa.id_tipo_despesa = getFromArray($scope.listTiposDespesas,$scope.despesa.id_tipo_despesa);
        }
    };

    var errorGetTiposDespesas = function(data) {
        $scope.listTiposDespesas = [];
        $scope.haveError  = data ;
    };

    var successPostDespesa = function(response) {
        if (response.data.status) {
            $scope.alert = {type: "success", title: "Parabéns!", message: response.data.message};
            $scope.despesa = undefined;
        }
        else
            $scope.alert = {type: "danger", title: "Ocorreu um problema!", message: response.data.message};
    };
    var errorPostDespesa = function(response) {
        $scope.alert = {type: "danger", title: "Ocorreu um problema!", message: response.statusText};
    };

    SiskitnetService.getTiposDespesas(successGetTiposDespesas,errorGetTiposDespesas);

    $scope.fechar = function(result) {
        close(result, 200);
    };

    $scope.salvarDespesa = function() {
        $scope.despesa.id_tipo_despesa = $scope.despesa.id_tipo_despesa.id;
        this.tratarData();
        if (angular.isUndefined(despesa))
            SiskitnetService.inserirDespesa($scope.despesa,successPostDespesa, errorPostDespesa);
        else
            SiskitnetService.atualizarDespesa($scope.despesa,successPostDespesa, errorPostDespesa);

    };

    $scope.tratarData = function() {
        if (angular.isDate($scope.despesa.data)) {
            $scope.despesa.data = $filter('date')($scope.despesa.data, 'yyyy-MM-dd');
            var dateChanged = $scope.despesa.data.replace(/\//g, "-");
            $scope.despesa.data = $filter('date')(dateChanged, 'yyyy-MM-dd');
        }else
            $scope.despesa.data = $scope.despesa.data.split("/").reverse().join("-");

    }


});/**
 * Created by claud on 29/10/2017.
 */
