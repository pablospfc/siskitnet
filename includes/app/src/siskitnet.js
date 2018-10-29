var sisKitnetApp =  angular.module('sisKitnet-App',[
    'idf.br-filters',
    'ngRoute',
    'ngMessages',
    'angularModalService',
    'ui.utils.masks',
    'authentication',
    'ngCookies',
    'angularUtils.directives.dirPagination',
    'ngCpfCnpj'
]);

sisKitnetApp.constant('PATHS', {
    PATH_ARQUIVOS: 'http://siskitnet.cdsantosdumont.com.br/docs/'
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

sisKitnetApp.directive("matchPassword", function () {
    return {
        require: "ngModel",
        scope: {
            otherModelValue: "=matchPassword"
        },
        link: function(scope, element, attributes, ngModel) {

            ngModel.$validators.matchPassword = function(modelValue) {
                return modelValue == scope.otherModelValue;
            };

            scope.$watch("otherModelValue", function() {
                ngModel.$validate();
            });
        }
    }
});

sisKitnetApp.config(function($routeProvider, $locationProvider, $httpProvider) {
    $locationProvider.html5Mode( { enabled : false, requireBase : false } );
    $locationProvider.hashPrefix('');
    // $httpProvider.defaults.headers.common['Access-Control-Allow-Headers'] = '*';
    // $httpProvider.defaults.useXDomain = true;
    // delete $httpProvider.defaults.headers.common['X-Requested-With'];

    $routeProvider.when('/', {
        templateUrl: 'templates/view/home/index.html',
        controller: 'HomeController',
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
    when('/indenizacoes', {
        templateUrl: 'templates/view/indenizacao/index.html',
        controller: 'IndenizacoesController'
    }).
    when('/relatorios', {
        templateUrl: 'templates/view/relatorio/index.html',
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
        controller: 'RenovacaoController'
    }).
    when('/login', {
        templateUrl: 'templates/view/login/index.html',
        controller: 'LoginController',
    }).
    when('/registro', {
        templateUrl: 'templates/view/usuario/registro.html',
        controller: 'UsuarioController'
    }).
    when('/redefinicaosenha', {
        templateUrl: 'templates/view/usuario/redefinicao-senha.html',
        controller: 'UsuarioController'
    }).
    when('/esqueceusenha', {
        templateUrl: 'templates/view/usuario/esqueceu-senha.html',
        controller: 'UsuarioController'
    }).
    when('/conta', {
        templateUrl: 'templates/view/usuario/altera-senha.html',
        controller: 'ContaController',
    }).
    when('/proprietario', {
        templateUrl: 'templates/view/proprietario/index.html',
        controller: 'ProprietarioController',
        resolve: {
            Proprietario: function (SiskitnetService) {
                return SiskitnetService.getDadosProprietario();
            }
        }
    }).
    when('/alterasenha', {
        templateUrl: 'templates/view/usuario/altera-senha.html',
        controller: 'UsuarioController',

    })


    .otherwise ({ redirectTo: '/login' });

});

sisKitnetApp.run(['$rootScope', '$location', '$cookieStore', '$http',
    function ($rootScope, $location, $cookieStore, $http) {
        // keep user logged in after page refresh
        $rootScope.globals = $cookieStore.get('globals') || {};
        if ($rootScope.globals.currentUser) {
            $http.defaults.headers.common['Authorization'] = 'Basic ' + $rootScope.globals.currentUser.authdata; // jshint ignore:line
        }

        $rootScope.$on('$locationChangeStart', function (event, next, current) {
            // redirect to login page if not logged in
            if ($location.path() !== '/login' &&
                $location.path() !== '/registro' &&
                $location.path() !== '/redefinicaosenha' &&
                $location.path() !== '/esqueceusenha' &&
                !$rootScope.globals.currentUser) {
                $location.path('/login');
            }
        });
    }]);
