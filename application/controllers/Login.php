<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 01/12/2017
 * Time: 20:38
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Login extends \REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Login_Model','LoginMDL');

        // Configuração para os limites de requisições (por hora)
        $this->methods['index_get']['limit'] = 10;
    }

    public function index_get()
    {

    }

    public function index_post()
    {
        $dados = $this->post();
        error_log(var_export($dados,true));
        $response = $this->LoginMDL->getLogin($dados);
        if (is_array($response))
            $this->response($response, REST_Controller::HTTP_OK);
        else
            $this->response(['message'=>'Não foi possível realizar a operação.'],REST_Controller::HTTP_NO_CONTENT);

    }

    public function index_put()
    {

    }

    public function index_delete()
    {

    }

}