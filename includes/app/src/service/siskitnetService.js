sisKitnetApp.service('SiskitnetService', function ($http, $window, $httpParamSerializerJQLike) {
    this.getLocatarios = function (callbackSuccess, callbackError) {
        $http.get("locatarios/listar")
            .then(callbackSuccess, callbackError);
    };

    this.inserirLocatario = function (data, callbackSuccess, callbackError) {
        $window.scrollTo(0, 0);
        $http.post("locatarios/cadastrar", data)
            .then(callbackSuccess, callbackError);

    };

    this.atualizarLocatario = function ( data, callbackSuccess, callbackError) {
        $window.scrollTo(0,0);
        $http.put("locatarios/atualizar", data)
            .then(callbackSuccess, callbackError);
    };

    this.excluirLocatario = function (id, callbackSuccess, callbackError) {

        var config = {
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: $httpParamSerializerJQLike({
                id: id
            })
        };

    $http.delete("locatarios/remover",config)
        .then( callbackSuccess, callbackError );


    //     var dt = $(params).serialize();
    //     $http({
    //         method: 'DELETE',
    //         url: 'locatarios/remover',
    //         data: $httpParamSerializerJQLike(params),
    //         headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    //     }).then( callbackSuccess, callbackError );
    // };
};
    
});
