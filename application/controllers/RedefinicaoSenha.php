<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 23/02/2018
 * Time: 11:32
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class RedefinicaoSenha extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Usuario_Model','UsuarioMDL');

        // Configuração para os limites de requisições (por hora)
        $this->methods['index_get']['limit'] = 10;
    }

    public function index_post()
    {
        $dados = $this->post();

        $response = $this->UsuarioMDL->redefinirSenha($dados);

        $this->response($response, REST_Controller::HTTP_OK);
    }

}