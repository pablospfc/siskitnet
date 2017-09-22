var sisKitnetApp =  angular.module('sisKitnet-App',[
    'idf.br-filters',
    'ngRoute',
    'ngMessages',
    'angularModalService'
]);
sisKitnetApp.filter('dateToISO', function () {
    return function (input) {
        if (angular.isUndefined(input))
            return;
        // Split timestamp into [ Y, M, D, h, m, s ]
        var t = input.split(/[- :]/);
        // Apply each element to the Date function
        var d = new Date(Date.UTC(t[0], t[1] - 1, t[2], t[3], t[4], t[5]));
        return d.toISOString();
    };
});
// $scope.today = new Date();
// $scope.todayString = $filter('date')(new Date(), 'dd-MM-yyyy');
// console.log($scope.todayString);

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
