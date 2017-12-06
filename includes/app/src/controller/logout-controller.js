sisKitnetApp.controller('LogoutController', function ($scope, $document, $location, $timeout, AuthenticationService) {
    $scope.sair = function(){
        console.log("chegou aqui");
        AuthenticationService.ClearCredentials();

        $location.path('/login');
    };

});