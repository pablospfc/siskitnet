sisKitnetApp.controller('ImoveisController', function ($scope, $document, $timeout, ModalService, SiskitnetService) {
    var successGetImoveis = function(success) {
        $scope.imoveis = success.data;
        $scope.haveError  = false;
    };

    var errorGetImoveis = function(data) {
        $scope.imoveis = [];
        $scope.haveError  = data ;
    };

    SiskitnetService.getImoveis(successGetImoveis,errorGetImoveis);

    $scope.deleteImovel = function(idImovel) {
        bootbox.confirm("Você deseja realmente excluir este imóvel?", function(result) {
            if(result) {
                SiskitnetService.excluirImovel(idImovel);
            }
            $timeout(function () {
                SiskitnetService.getImoveis(successGetImoveis,errorGetImoveis)
            }, 1000);
        });
    };

    $scope.showImovelModal = function (imovel) {
        ModalService.showModal({
            templateUrl: 'templates/view/imovel/create.html',
            controller: "imovelModalController",
            inputs: {
                imovel : imovel,
            }
        }).then(function (modal) {
            modal.element.modal();
            modal.close.then(function (result) {
                SiskitnetService.getImoveis(successGetImoveis,errorGetImoveis);
                angular.element('.modal-backdrop').hide();
                angular.element($document[0].body).removeClass('modal-open');
                $timeout(function () {
                    $scope.flashMessage = false;
                }, 2000);
            });
        });
    };

});


sisKitnetApp.controller('imovelModalController', function ($scope, close, $filter, imovel, SiskitnetService) {

    var getFromArray = function(array,id) {
        var result = $.grep(array, function(e){ return e.id == id; });
        return result[0];
    };

    if(!angular.isUndefined(imovel)) {
        $scope.imovel = angular.copy(imovel);
    }

    var successGetTiposImoveis = function(success) {
        $scope.listTiposImoveis = success.data;
        $scope.haveError  = false;
        if (!angular.isUndefined($scope.imovel)){
            $scope.imovel.id_tipo_imovel = getFromArray($scope.listTiposImoveis,$scope.imovel.id_tipo_imovel);
        }
    };

    var errorGetTiposImoveis = function(data) {
        $scope.listTiposImoveis = [];
        $scope.haveError  = data ;
    };

    var successPostImovel = function(response) {
        if (response.data.status) {
            $scope.alert = {type: "success", title: "Parabéns!", message: response.data.message};
            $scope.imovel = undefined;
        }
        else
            $scope.alert = {type: "danger", title: "Ocorreu um problema!", message: response.data.message};
    };
    var errorPostImovel = function(response) {
        $scope.alert = {type: "danger", title: "Ocorreu um problema!", message: response.statusText};
    };

    SiskitnetService.getTipoImoveis(successGetTiposImoveis,errorGetTiposImoveis);

    $scope.fechar = function(result) {
        close(result, 200);
    };

    $scope.salvarImovel = function() {
        $scope.imovel.id_tipo_imovel = $scope.imovel.id_tipo_imovel.id;
        if (angular.isUndefined(imovel))
            SiskitnetService.inserirImovel($scope.imovel,successPostImovel, errorPostImovel);
        else
            SiskitnetService.atualizarImovel($scope.imovel,successPostImovel, errorPostImovel);

    };


});/**
 * Created by claud on 29/10/2017.
 */
