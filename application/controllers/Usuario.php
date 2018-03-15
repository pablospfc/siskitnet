<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 01/12/2017
 * Time: 20:27
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Usuario extends \REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Usuarios_Model','UsuarioMDL');

        // Configuração para os limites de requisições (por hora)
        $this->methods['index_get']['limit'] = 10;
    }

    public function index_get()
    {
        $action = $this->get('action');

        if ($action == 'getUsuarioLogado')
            $response = $this->UsuarioMDL->getUsuarioLogado();

        $this->response($response, REST_Controller::HTTP_OK);


    }

    public function index_post()
    {

    }

    public function index_put()
    {
        $dados = $this->put();

        $response = $this->UsuarioMDL->atualizar($dados, $dados['id']);

        $this->response($response, REST_Controller::HTTP_OK);

    }

    public function index_delete()
    {

    }

}