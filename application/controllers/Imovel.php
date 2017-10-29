<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 28/07/2017
 * Time: 16:53
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Imovel extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Imovel_model','ImovelMDL');

        // Configuração para os limites de requisições (por hora)
        $this->methods['index_get']['limit'] = 10;
    }

    public function index_get() {
        $response = $this->ImovelMDL->getAll();

        $this->response($response,REST_Controller::HTTP_OK);
    }

}