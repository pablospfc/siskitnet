var sisKitnetApp =  angular.module('sisKitnet-App',[
    'idf.br-filters',
    'ngRoute',
    'ngMessages',
    'angularModalService',
    'ui.utils.masks',
    'ngPrint'
]);
// $scope.today = new Date();
// $scope.todayString = $filter('date')(new Date(), 'dd-MM-yyyy');
// console.log($scope.todayString);

sisKitnetApp.directive('cpfValido', function () {
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function (scope, elem, attrs, ctrl) {

            scope.$watch(attrs.ngModel, function () {

                if (elem[0].value.length == 0)
                    ctrl.$setValidity('cpfValido', true);
                else if (elem[0].value.length < 11) {
                    //aplicar o algoritmo de validação completo do CPF
                    ctrl.$setValidity('cpfValido', false);
                }
                else ctrl.$setValidity('cpfValido', true);
            });
        }
    };
});

sisKitnetApp.directive('stringToNumber', function() {
    return {
        require: 'ngModel',
        link: function (scope, element, attrs, ngModel) {
            ngModel.$parsers.push(function (value) {
                return '' + value;
            });
            ngModel.$formatters.push(function (value) {
                return parseFloat(value);
            });
        }
    }
});

sisKitnetApp.config(function($routeProvider, $locationProvider) {
    $locationProvider.html5Mode( { enabled : false, requireBase : false } );
    $locationProvider.hashPrefix('');
    $routeProvider.when('/', {
        templateUrl: 'templates/view/home/index.phtml',
        controller: 'HomeController'
    }).
    when('/locatarios', {
        templateUrl: 'templates/view/locatario/index.phtml',
        controller: 'LocatariosController'
    }).
    when('/contratos', {
        templateUrl: 'templates/view/contrato/index.phtml',
        controller: 'ContratosController'
    }).
    when('/despesas', {
        templateUrl: 'templates/view/despesa/index.phtml',
        controller: 'DespesasController'
    }).
    when('/imoveis', {
        templateUrl: 'templates/view/imovel/index.phtml',
        controller: 'ImoveisController'
    }).
    when('/pagamentos', {
        templateUrl: 'templates/view/pagamento/index.phtml',
        controller: 'PagamentosController'
    }).
    when('/relatorios', {
        templateUrl: 'templates/view/relatorio/index.phtml',
        controller: 'RelatoriosController'
    }).
    when('/perfis', {
        templateUrl: 'templates/view/perfil/index.phtml',
        controller: 'PerfisController'
    }).
    when('/usuarios', {
        templateUrl: 'templates/view/usuario/index.phtml',
        controller: 'UsuariosController'
    })
    .otherwise ({ redirectTo: '/' });

});
