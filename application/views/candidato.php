<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="utf-8">
    <title>RestServer com CodeIgniter</title>
    <link rel="stylesheet" href="<?=base_url('bower_components/bootstrap/dist/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('bower_components/datatables.net-bs/css/dataTables.bootstrap.css')?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css">
</head>
<body>
<div class="container" ng-app="restServerApp" ng-controller="UsuarioController">
    <div class="row">
        <div class="col-lg-12">
            <h1>Usuários</h1>
            <a href="#" id="btn-atualiza-datatable" class="btn btn-primary pull-left">ATUALIZAR TABELA</a>
            <a href="#" id="btn-novo-usuario" data-toggle="modal" data-target="#formUsuarioModal" class="btn btn-success pull-right">NOVO USUÁRIO</a>
        </div>

        <div class="row ng-hide" ng-show="haveError">
            <div class="col-sm-12 ">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <strong>Desculpe-nos!</strong> Mas ocorreu um erro ao tentar
                    carregar os dados!
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="formUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Novo Usuário</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="<?=base_url('api/usuarios')?>" id="formUsuario" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="nome">Nome</label>
                        <div class="col-md-9">
                            <input id="nome" name="nome" placeholder="Seu nome" class="form-control input-md" type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="email">Email</label>
                        <div class="col-md-9">
                            <input id="email" name="email" placeholder="Seu email" class="form-control input-md" type="email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="senha">Senha</label>
                        <div class="col-md-9">
                            <input id="senha" name="senha" placeholder="senha" class="form-control input-md" type="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="biografia">Biografia</label>
                        <div class="col-md-9">
                            <textarea class="form-control" id="biografia" name="biografia" placeholder="Fale um pouco sobre você"></textarea>
                        </div>
                    </div>

                    <div class="form-group" id="foto-input">
                        <label class="col-md-3 control-label" for="foto">Foto</label>
                        <div class="col-md-9">
                            <input id="foto" name="avatar" placeholder="Foto de perfil" type="file">
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left hidden" data-dismiss="modal" id="btn-remover-usuario" >Remover</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn-submit-form">Salvar</button>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url('bower_components/jquery/dist/jquery.min.js')?>"></script>
<script src="<?=base_url('bower_components/angular/angular.min.js')?>"></script>
<script src="<?=base_url('bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('bower_components/datatables.net/js/jquery.dataTables.min.js')?>"></script>
<script src="<?=base_url('bower_components/datatables.net-select/js/dataTables.select.min.js')?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

<script src="<?=base_url('includes/js/siskitnet.js')?>"></script>
</body>
</html>
