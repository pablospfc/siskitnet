sisKitnetApp.controller('IndenizacoesController', function ($scope, $document, $timeout, ModalService, SiskitnetService) {

    SiskitnetService.getIndenizacoes();

    $scope.deleteIndenizacao = function(id) {
        bootbox.confirm("Você deseja realmente excluir esta indenização?", function(result) {
            if(result) {
                SiskitnetService.excluirIndenizacao(id);
            }
            $timeout(function () {
                SiskitnetService.getIndenizacoes();
            }, 1000);
        });
    };

    $scope.showIndenizacaoModal = function (indenizacao) {
        ModalService.showModal({
            templateUrl: 'templates/view/indenizacao/create.html',
            controller: "indenizacaoModalController",
            inputs: {
                indenizacao : indenizacao,
            }
        }).then(function (modal) {
            modal.element.modal();
            modal.close.then(function (result) {
                SiskitnetService.getIndenizacoes();
                angular.element('.modal-backdrop').hide();
                angular.element($document[0].body).removeClass('modal-open');
                $timeout(function () {
                    $scope.flashMessage = false;
                }, 2000);
            });
        });
    };

});


sisKitnetApp.controller('indenizacaoModalController', function ($scope, close, $filter, indenizacao, SiskitnetService) {

    var getFromArray = function(array,id) {
        var result = $.grep(array, function(e){ return e.id == id; });
        return result[0];
    };

    if(!angular.isUndefined(indenizacao)) {
        $scope.indenizacao = angular.copy(indenizacao);
        $scope.indenizacao.data =  $filter('date')($scope.indenizacao.data, 'dd/MM/yyyy');

    }

    var successGetLocatarios = function(success) {
        $scope.listLocatarios = success.data;
        $scope.haveError  = false;
        if (!angular.isUndefined($scope.indenizacao)){
            $scope.indenizacao.id_locatario = getFromArray($scope.listLocatarios,$scope.indenizacao.id_locatario);
        }
    };

    var errorGetLocatarios = function(data) {
        $scope.listLocatarios = [];
        $scope.haveError  = data ;
    };

    SiskitnetService.getLocatarios(successGetLocatarios,errorGetLocatarios);

    $scope.fechar = function(result) {
        close(result, 200);
    };

    $scope.salvarIndenizacao = function() {
        $scope.indenizacao.id_locatario = $scope.indenizacao.id_locatario.id;
        this.tratarData();
        if (angular.isUndefined(indenizacao))
            SiskitnetService.inserirIndenizacao($scope.indenizacao);
        else
            SiskitnetService.atualizarIndenizacao($scope.indenizacao);

    };
    $scope.tratarData = function() {
        if (angular.isDate($scope.indenizacao.data)) {
            $scope.indenizacao.data = $filter('date')($scope.indenizacao.data, 'yyyy-MM-dd');
            var dateChanged = $scope.indenizacao.data.replace(/\//g, "-");
            $scope.indenizacao.data = $filter('date')(dateChanged, 'yyyy-MM-dd');
        } else
            $scope.indenizacao.data = $scope.indenizacao.data.split("/").reverse().join("-");
    }


});/**
 * Created by claud on 29/10/2017.
 */
