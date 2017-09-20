sisKitnetApp.controller('LocatariosController', function ($scope, $document, $timeout, ModalService, SiskitnetService) {
    var successGetLocatarios = function(success) {
        $scope.locatarios = success.data;
        $scope.haveError  = false;
    };

    var errorGetLocatarios = function(data) {
        $scope.locatarios = [];
        $scope.haveError  = data ;
    };

    SiskitnetService.getLocatarios(successGetLocatarios,errorGetLocatarios);

    $scope.deleteLocatario = function(idLocatario) {
        bootbox.confirm("Você deseja realmente excluir este locatário?", function(result) {
            if(result) {
                SiskitnetService.excluirLocatario(idLocatario);
            }
            $timeout(function () {
                //$window.location.reload();
                SiskitnetService.getLocatarios(successGetLocatarios,errorGetLocatarios)
            }, 1000);
        });
    };

    $scope.showLocatarioModal = function (locatario) {
        ModalService.showModal({
            templateUrl: 'templates/view/locatario/create.html',
            controller: "locatarioModalController",
            inputs: {
                locatario : locatario,
            }
        }).then(function (modal) {
            modal.element.modal();
            modal.close.then(function (result) {
                SiskitnetService.getLocatarios(successGetLocatarios,errorGetLocatarios);
                angular.element('.modal-backdrop').hide();
                angular.element($document[0].body).removeClass('modal-open');
                $timeout(function () {
                    $scope.flashMessage = false;
                }, 2000);
            });
        });
    };

});


sisKitnetApp.controller('locatarioModalController', function ($scope, close, locatario, SiskitnetService) {

    var getFromArray = function(array,id) {
        var result = $.grep(array, function(e){ return e.id == id; });
        return result[0];
    };

    var successGetEstadosCivis = function(success) {
        $scope.listEstadosCivis = success.data;
        $scope.haveError  = false;
        if ($scope.locatario.id){
            $scope.locatario.id_estado_civil = getFromArray($scope.listEstadosCivis,$scope.locatario.id_estado_civil);
        }
    };

    var errorGetEstadosCivis = function(data) {
        $scope.listEstadosCivis = [];
        $scope.haveError  = data ;
    };

    SiskitnetService.getEstadosCivis(successGetEstadosCivis,errorGetEstadosCivis);

    $scope.fechar = function(result) {
        close(result, 200);
    };

    if(!angular.isUndefined(locatario))
        $scope.locatario = angular.copy(locatario);

    $scope.salvarLocatario = function() {
        if (angular.isUndefined(locatario)) {
            SiskitnetService.inserirLocatario($scope.locatario, function (response) {
                if (response.data.status)
                    $scope.alert = {type: "success", title: "Parabéns!", message: response.data.message};
                else
                    $scope.alert = {type: "danger", title: "Ocorreu um problema!", message: response.data.message};

            }, function (response) {
                $scope.alert = {type: "danger", title: "Ocorreu um problema!", message: response.statusText};
            })
        }
        else {
            SiskitnetService.atualizarLocatario($scope.locatario, function (response) {
                if (response.data.status)
                    $scope.alert = {type: "success", title: "Parabéns!", message: response.data.message};
                else
                    $scope.alert = {type: "danger", title: "Ocorreu um problema!", message: response.data.message};

            }, function (response) {
                $scope.alert = {type: "danger", title: "Ocorreu um problema!", message: response.statusText};
            })
        }

    };


});