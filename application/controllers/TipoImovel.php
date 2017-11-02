<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 29/10/2017
 * Time: 15:49
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class TipoImovel extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('TipoImovel_Model','TipoImovelMDL');

        // Configuração para os limites de requisições (por hora)
        $this->methods['index_get']['limit'] = 10;
    }

    public function index_get() {
        $response = $this->TipoImovelMDL->getAll();

        $this->response($response,REST_Controller::HTTP_OK);
    }

}