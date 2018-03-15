sisKitnetApp.controller('LoginController', function ($scope, $window, $rootScope, $document, $location, $timeout, AuthenticationService) {
    AuthenticationService.ClearCredentials();
    //console.log($rootScope.globals);
    $scope.autenticar = function(){
        $scope.dataLoading = true;
        AuthenticationService.getLogin($scope.formulario, function(response) {
            if(response.data.status == true) {
                AuthenticationService.SetCredentials($scope.formulario.email, $scope.formulario.senha);

                 $location.path('/');
                $window.location.reload();
                $rootScope.conectado = true;
            } else {

                $scope.alert = {type: "danger", title: "Ocorreu um problema!", message: response.data.message}
                $scope.dataLoading = false;
            }
        });
    };
});



// 'use strict';
//
// angular.module('Authentication', 'sisKitnetApp')
//
// .controller('LoginController',
//         ['$scope', '$rootScope', '$location', 'AuthenticationService',
//             function ($scope, $rootScope, $location, AuthenticationService) {
//                 // reset login status
//                 AuthenticationService.ClearCredentials();
//
//                 $scope.login = function () {
//                     $scope.dataLoading = true;
//                     AuthenticationService.getLogin($scope.formulario, function(response) {
//                         if(response.success) {
//                             AuthenticationService.SetCredentials($scope.formulario.login, $scope.formulario.senha);
//                             $location.path('/');
//                         } else {
//                             $scope.alert = response.message;
//                             $scope.dataLoading = false;
//                         }
//                     });
//                 };
//             }]);