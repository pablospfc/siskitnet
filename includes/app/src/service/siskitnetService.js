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

    /* IMOVEIS*/

    this.getListImoveis = function (callbackSuccess, callbackError) {
        $http.get("imoveis/listar")
            .then(callbackSuccess, callbackError);
    };

    this.getTipoImoveis = function (success, error) {
        $http.get("tipoimoveis/listar")
            .then(success,error);
    };

    this.inserirImovel = function (data, callbackSuccess, callbackError) {
        console.log(data);
        $http.post("imoveis/cadastrar", data)
            .then(callbackSuccess, callbackError);
    };

    this.atualizarImovel = function ( data, callbackSuccess, callbackError) {
        $window.scrollTo(0,0);
        $http.put("imoveis/atualizar", data)
            .then(callbackSuccess, callbackError);
    };

    this.excluirImovel = function (id, callbackSuccess, callbackError) {

        var config = {
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: $httpParamSerializerJQLike({
                id: id
            })
        };

        $http.delete("imoveis/remover",config)
            .then( callbackSuccess, callbackError );
    };

    /* DESPESAS*/

    this.getDespesas = function (callbackSuccess, callbackError) {
        $http.get("despesa/listar")
            .then(callbackSuccess, callbackError);
    };

    this.getTiposDespesas = function (success, error) {
        $http.get("tipodespesas/listar")
            .then(success,error);
    };

    this.inserirDespesa = function (data, callbackSuccess, callbackError) {
        $http.post("despesa/cadastrar", data)
            .then(callbackSuccess, callbackError);
    };

    this.atualizarDespesa = function ( data, callbackSuccess, callbackError) {
        $window.scrollTo(0,0);
        $http.put("despesa/atualizar", data)
            .then(callbackSuccess, callbackError);
    };

    this.excluirDespesa = function (id, callbackSuccess, callbackError) {

        var config = {
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: $httpParamSerializerJQLike({
                id: id
            })
        };

        $http.delete("despesa/remover",config)
            .then( callbackSuccess, callbackError );
    };
});
