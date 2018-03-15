<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 04/02/2018
 * Time: 10:33
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Mes extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mes_model','MesMDL');

        // Configuração para os limites de requisições (por hora)
        $this->methods['index_get']['limit'] = 10;
    }

    public function index_get() {
        $response = $this->MesMDL->getAll();

        $this->response($response,REST_Controller::HTTP_OK);
    }

}