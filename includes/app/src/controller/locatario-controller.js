sisKitnetApp.controller('LocatariosController', function ($scope, $timeout, ModalService, SiskitnetService) {
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
                $scope.flashMessage = false;
            }
            $timeout(function () {
                //$window.location.reload();
                SiskitnetService.getLocatarios(successGetLocatarios,errorGetLocatarios)
            }, 1000);
        });
    };

    $scope.showLocatarioModal = function (id_locatario) {
        ModalService.showModal({
            templateUrl: 'templates/view/locatario/create.html',
            controller: "locatarioModalController",
            inputs: {
                id_locatario : id_locatario,
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


sisKitnetApp.controller('locatarioModalController', function ($scope, id_locatario, SiskitnetService) {

    $scope.fechar = function(result) {
        close(result, 200);
    };

    $scope.salvarLocatario = function() {
      SiskitnetService.postLocatarios($scope.locatario, function( response ){
console.log(response.data);
            if( response.data.status )
                $scope.alert = { type: "success", title: "Parabéns!", message : response.data.message };
            else
                $scope.alert = { type: "danger", title: "Ocorreu um problema!", message : response.data.message };

        }, function( response ){
            $scope.alert = { type: "danger", title: "Ocorreu um problema!",  message : response.statusText };
        })
    }
});