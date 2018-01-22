sisKitnetApp.service('SiskitnetService', function ($http, $q, $window, $rootScope,$httpParamSerializerJQLike) {
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
        $http.get("despesas/listar")
            .then(callbackSuccess, callbackError);
    };

    this.getTiposDespesas = function (success, error) {
        $http.get("tipodespesas/listar")
            .then(success,error);
    };

    this.inserirDespesa = function (data, callbackSuccess, callbackError) {
        $http.post("despesas/cadastrar", data)
            .then(callbackSuccess, callbackError);
    };

    this.atualizarDespesa = function ( data, callbackSuccess, callbackError) {
        $window.scrollTo(0,0);
        $http.put("despesas/atualizar", data)
            .then(callbackSuccess, callbackError);
    };

    this.excluirDespesa = function (id, callbackSuccess, callbackError) {

        var config = {
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: $httpParamSerializerJQLike({
                id: id
            })
        };

        $http.delete("despesas/remover",config)
            .then( callbackSuccess, callbackError );
    };

    /* PAGAMENTOS*/

    this.getPagamentos = function (callbackSuccess, callbackError) {
        $http.get("pagamento/listar")
            .then(callbackSuccess, callbackError);
    };

    this.getContratosVigentes = function (callbackSuccess, callbackError) {
        $http.get("contratos/getContratosVigentes")
            .then(callbackSuccess, callbackError);
    };

    this.inserirPagamento = function (data, callbackSuccess, callbackError) {
        $http.post("pagamento/cadastrar", data)
            .then(callbackSuccess, callbackError);
    };

    this.atualizarPagamento = function ( data, callbackSuccess, callbackError) {
        $http.put("pagamento/atualizar", data)
            .then(callbackSuccess, callbackError);
    };

    this.excluirPagamento = function (pagamento, callbackSuccess, callbackError) {

        var config = {
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: $httpParamSerializerJQLike({
                pagamento: pagamento
            })
        };

        $http.delete("pagamento/remover",config)
            .then( callbackSuccess, callbackError );
    };

    this.getQuantitativos = function (callbackSuccess, callbackError) {
        $http.get("home/index")
            .then(callbackSuccess, callbackError);
    };

    this.getContratosVencidos = function() {
        //var deferred = $q.defer();
        $http.get("renovacao/getContratosVencidos")
            .then(function mySuccess(data) {
                //deferred.resolve(data.data);
                $rootScope.contratos_vencidos = data.data;
                $rootScope.haveError  = false;
            }, function myError(meta) {
                //deferred.reject(meta);
                $rootScope.contratos_vencidos = [];
                $rootScope.haveError  = meta ;
            });
        //return deferred.promise;
    };

    this.getAlugueisMes = function() {
        var deferred = $q.defer();
        $http.get("alugueis/getAlugueisMes")
            .then(function mySuccess(data) {
                deferred.resolve(data.data);
            }, function myError(meta) {
                deferred.reject(meta);
            });

        return deferred.promise;
    };

    this.getAlugueisAtrasados = function() {
        var deferred = $q.defer();
        $http.get("aluguel/getAlugueisAtrasados")
            .then(function mySuccess(data) {
                deferred.resolve(data.data);
            }, function myError(meta) {
                deferred.reject(meta);
            });

        return deferred.promise;
    };

    this.renovar = function (data, callbackSuccess, callbackError) {
        $http.post("renovacao/renovar", data)
            .then(callbackSuccess, callbackError);
    };

    this.naoRenovar = function ( data, callbackSuccess, callbackError) {
        $http.put("renovacao/naoRenovar", data)
            .then(callbackSuccess, callbackError);
    };

    this.getLogin = function (dados) {
        console.log(dados);
        $http.post("login/autenticar",dados)
            .then(function mySuccess(data) {
                if (data.data.status) {
                    $rootScope.alert = {type: "success", title: "Parabéns!", message: data.data.message};
                    $rootScope.login = undefined;
                }
                else
                    $rootScope.alert = {type: "danger", title: "Ocorreu um problema!", message: data.data.message}
            }, function myError(meta) {
                $rootScope.alert = {type: "danger", title: "Ocorreu um problema!", message: meta.statusText};
            });
    };

    this.inserirIndenizacao = function (data) {
        $http.post("indenizacao/cadastrar", data)
            .then(function mySuccess(data) {
                if (response.data.status) {
                    $rootScope.alert = {type: "success", title: "Parabéns!", message: data.data.message};
                    $rootScope.indenizacao = undefined;
                }
                else
                    $rootScope.alert = {type: "danger", title: "Ocorreu um problema!", message: data.data.message};
            }, function myError(meta) {
                $rootScope.alert = {type: "danger", title: "Ocorreu um problema!", message: data.statusText};
            });
    };

    this.atualizarIndenizacao = function ( data) {
        $http.put("indenizacao/atualizar", data)
            .then(function mySuccess(data) {
                if (response.data.status) {
                    $rootScope.alert = {type: "success", title: "Parabéns!", message: data.data.message};
                    $rootScope.indenizacao = undefined;
                }
                else
                    $rootScope.alert = {type: "danger", title: "Ocorreu um problema!", message: data.data.message};

            }, function myError(meta) {
                $rootScope.alert = {type: "danger", title: "Ocorreu um problema!", message: data.statusText};

            });
    };

    this.getIndenizacoes = function() {
        //var deferred = $q.defer();
        $http.get("indenizacao/index")
            .then(function mySuccess(data) {
                $rootScope.indenizacoes = data.data;
                $rootScope.haveError  = false;
            }, function myError(meta) {
                $rootScope.indenizacoes = [];
                $rootScope.haveError  = meta ;
            });
    };

    this.excluirIndenizacao = function (id) {

        var config = {
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: $httpParamSerializerJQLike({
                id: id
            })
        };

        $http.delete("indenizacao/remover",config)
            .then(function mySuccess(data) {
              //
            }, function myError(meta) {
              //
            });
    };

});
