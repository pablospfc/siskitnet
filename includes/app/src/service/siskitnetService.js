sisKitnetApp.service('SiskitnetService', function ($http, $window, $httpParamSerializerJQLike) {
    /*LOCATÁRIOS*/
    this.getLocatarios = function (callbackSuccess, callbackError) {
        $http.get("locatarios/listar")
            .then(callbackSuccess, callbackError);
    };

    this.getEstadosCivis = function (success, error) {
      $http.get("estadoscivis/listar")
          .then(success,error);
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

        $http.delete("locatarios/remover", config)
            .then(callbackSuccess, callbackError);
    };


    //     var dt = $(params).serialize();
    //     $http({
    //         method: 'DELETE',
    //         url: 'locatarios/remover',
    //         data: $httpParamSerializerJQLike(params),
    //         headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    //     }).then( callbackSuccess, callbackError );
    // };

        /* CONTRATOS*/

        this.getContratos = function (callbackSuccess, callbackError) {
            $http.get("contratos/listar")
                .then(callbackSuccess, callbackError);
        };

        this.getImoveis = function (success, error) {
            $http.get("imoveis/listar")
                .then(success,error);
        };

        this.getLocatarios = function (success, error) {
            $http.get("locatarios/listar")
                .then(success,error);
        };


        this.inserirContrato = function (data, callbackSuccess, callbackError) {
            $window.scrollTo(0, 0);
            $http.post("contratos/cadastrar", data)
                .then(callbackSuccess, callbackError);
        };

        this.atualizarContrato = function ( data, callbackSuccess, callbackError) {
            $window.scrollTo(0,0);
            $http.put("contratos/atualizar", data)
                .then(callbackSuccess, callbackError);
        };

        this.excluirContrato = function (id, callbackSuccess, callbackError) {

            var config = {
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                data: $httpParamSerializerJQLike({
                    id: id
                })
            };

            $http.delete("contratos/remover",config)
                .then( callbackSuccess, callbackError );
       };
    
});
