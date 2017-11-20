var sisKitnetApp =  angular.module('sisKitnet-App',[
    'idf.br-filters',
    'ngRoute',
    'ngMessages',
    'angularModalService',
    'ui.utils.masks',
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
        templateUrl: 'templates/view/home/index.html',
        controller: 'HomeController'
    }).
    when('/locatarios', {
        templateUrl: 'templates/view/locatario/index.html',
        controller: 'LocatariosController'
    }).
    when('/contratos', {
        templateUrl: 'templates/view/contrato/index.phtml',
        controller: 'ContratosController'
    }).
    when('/despesas', {
        templateUrl: 'templates/view/despesa/index.html',
        controller: 'DespesasController'
    }).
    when('/imoveis', {
        templateUrl: 'templates/view/imovel/index.html',
        controller: 'ImoveisController'
    }).
    when('/pagamentos', {
        templateUrl: 'templates/view/pagamento/index.phtml',
        controller: 'PagamentosController'
    }).
    when('/relatorios', {
        templateUrl: 'templates/view/relatorio/index.hhtml',
        controller: 'RelatoriosController'
    }).
    when('/perfis', {
        templateUrl: 'templates/view/perfil/index.phtml',
        controller: 'PerfisController'
    }).
    when('/usuarios', {
        templateUrl: 'templates/view/usuario/index.phtml',
        controller: 'UsuariosController'
    }).
    when('/alugueis-mes', {
        templateUrl: 'templates/view/aluguel/alugueis-mes.html',
        controller: 'AlugueisController',
        resolve: {
            Alugueis: function (SiskitnetService) {
                return SiskitnetService.getAlugueisMes();
            }
        }
    }).
    when('/alugueis-atrasados', {
        templateUrl: 'templates/view/aluguel/alugueis-atrasados.html',
        controller: 'AlugueisController',
        resolve: {
            Alugueis: function (SiskitnetService) {
                return SiskitnetService.getAlugueisAtrasados();
            }
        }
    }).
    when('/contratos-vencidos', {
        templateUrl: 'templates/view/renovacao/index.html',
        controller: 'RenovacaoController',
        resolve: {
            Vencidos: function (SiskitnetService) {
                return SiskitnetService.getContratosVencidos();
            }
        }
    })
    .otherwise ({ redirectTo: '/' });

});

// sisKitnetApp.run(function ($rootScope, $location, SiskitnetService) {
//     $rootScope.goTo = function (url) {
//         if (url=='alugueis-atrasados') {
//             SiskitnetService.getAlugueisAtrasados($rootScope);
//             $location.path(url);
//         }else{
//             SiskitnetService.getAlugueisMes($rootScope);
//             $location.path(url);
//         }
//     };
// });
