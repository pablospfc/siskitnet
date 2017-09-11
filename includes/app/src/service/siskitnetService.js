sisKitnetApp.service('SiskitnetService', function ($http) {
    this.getLocatarios = function( callbackSuccess, callbackError ) {
        $http.get("locatarios/listar")
            .then( callbackSuccess, callbackError );
    };

    this.postLocatarios = function( data, callbackSuccess, callbackError ) {
        $http.post( "locatarios/cadastrar", data )
            .then( callbackSuccess, callbackError );
    };

    this.excluirLocatario = function( id, callbackSuccess, callbackError ) {
        $http.get("locatarios/remover/"+id)
            .then( callbackSuccess, callbackError );
    };

    
});
