sisKitnetApp.controller('LogoutController', function ($scope, $rootScope, $window, $document, $location, $timeout, AuthenticationService) {
    $rootScope.sair = function(){
        console.log("chegou aqui");
        AuthenticationService.ClearCredentials();

        $location.path('/login');
        $rootScope.logado = false;
        $window.location.reload();
    };

});