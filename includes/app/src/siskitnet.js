var sisKitnetApp =  angular.module('sisKitnet-App',[
    'Barbara-Js',
    'idf.br-filters',
    'ngRoute',
    'ngMessages'
]);

sisKitnetApp.config(function($routeProvider, $locationProvider) {
    $locationProvider.html5Mode( { enabled : false, requireBase : false } );
    $locationProvider.hashPrefix('');
    $routeProvider.when('/', {
        templateUrl: 'templates/view/home.html',
        controller: 'HomeController'
    }).
    when('/locatarios', {
        templateUrl: 'templates/view/locatarios.html',
        controller: 'LocatariosController'
    }).
    when('/contratos', {
        templateUrl: 'templates/view/contratos.html',
        controller: 'ContratosController'
    }).
    when('/despesas', {
        templateUrl: 'templates/view/despesas.html',
        controller: 'DespesasController'
    }).
    when('/imoveis', {
        templateUrl: 'templates/view/imoveis.html',
        controller: 'ImoveisController'
    }).
    when('/indenizacoes', {
        templateUrl: 'templates/view/indenizacoes.html',
        controller: 'IndenizacoesController'
    }).
    when('/pagamentos', {
        templateUrl: 'templates/view/pagamentos.html',
        controller: 'PagamentosController'
    }).
    when('/relatorios', {
        templateUrl: 'templates/view/relatorios.html',
        controller: 'RelatoriosController'
    }).
    when('/perfis', {
        templateUrl: 'templates/view/perfis.html',
        controller: 'PerfisController'
    }).
    when('/usuarios', {
        templateUrl: 'templates/view/usuarios.html',
        controller: 'UsuariosController'
    })
    .otherwise ({ redirectTo: '/' });

});

sisKitnetApp.run(function ($rootScope, bootstrap) {

    $rootScope.alert   = bootstrap.alert();
    $rootScope.loading = bootstrap.loading();

});
