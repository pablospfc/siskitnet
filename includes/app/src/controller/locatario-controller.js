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


sisKitnetApp.controller('locatarioModalController', function ($scope, close, $filter, locatario, SiskitnetService) {

    var getFromArray = function(array,id) {
        var result = $.grep(array, function(e){ return e.id == id; });
        return result[0];
    };

    if(!angular.isUndefined(locatario)) {
        $scope.locatario = angular.copy(locatario);
         //$scope.locatario.data_nascimento = new Date($scope.locatario.data_nascimento);
        // $scope.data_nascimento.setDate($scope.data_nascimento.getDate() + 1);
        // $scope.locatario.data_nascimento = $scope.data_nascimento;
        // console.log($scope.data_nascimento);
        $scope.locatario.data_nascimento =  $filter('date')($scope.locatario.data_nascimento, 'dd/MM/yyyy');
    }

    var successGetEstadosCivis = function(success) {
        $scope.listEstadosCivis = success.data;
        $scope.haveError  = false;
        if (!angular.isUndefined($scope.locatario)){
            $scope.locatario.id_estado_civil = getFromArray($scope.listEstadosCivis,$scope.locatario.id_estado_civil);
        }
    };

    var errorGetEstadosCivis = function(data) {
        $scope.listEstadosCivis = [];
        $scope.haveError  = data ;
    };

    var successPostLocatario = function(response) {
        if (response.data.status) {
            $scope.alert = {type: "success", title: "Parabéns!", message: response.data.message};
            $scope.locatario = undefined;
        }
        else
            $scope.alert = {type: "danger", title: "Ocorreu um problema!", message: response.data.message};
    };
    var errorPostLocatario = function(response) {
        $scope.alert = {type: "danger", title: "Ocorreu um problema!", message: response.statusText};
    };

    SiskitnetService.getEstadosCivis(successGetEstadosCivis,errorGetEstadosCivis);

    $scope.fechar = function(result) {
        close(result, 200);
    };

    $scope.salvarLocatario = function() {

        $scope.locatario.id_estado_civil = $scope.locatario.id_estado_civil.id;
        this.tratarData();
        if (angular.isUndefined(locatario))
            SiskitnetService.inserirLocatario($scope.locatario,successPostLocatario, errorPostLocatario)
        else
            SiskitnetService.atualizarLocatario($scope.locatario,successPostLocatario, errorPostLocatario)

    };

    $scope.tratarData = function() {
        if (angular.isDate($scope.locatario.data_nascimento)) {
            $scope.locatario.data_nascimento = $filter('date')($scope.locatario.data_nascimento, 'yyyy-MM-dd');
            var dateChanged = $scope.locatario.data_nascimento.replace(/\//g, "-");
            $scope.locatario.data_nascimento = $filter('date')(dateChanged, 'yyyy-MM-dd');
        }else
            $scope.locatario.data_nascimento = $scope.locatario.data_nascimento.split("/").reverse().join("-");

    }


});