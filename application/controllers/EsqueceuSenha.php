<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 20/02/2018
 * Time: 11:52
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class EsqueceuSenha extends REST_Controller
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

        $response = $this->UsuarioMDL->verificarCPF($dados);

        $this->response($response, REST_Controller::HTTP_OK);
    }

}