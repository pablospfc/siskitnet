<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 17/09/2017
 * Time: 10:34
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class EstadoCivil extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('EstadoCivil_Model','EstadoCivilMDL');

        // Configuração para os limites de requisições (por hora)
        $this->methods['index_get']['limit'] = 10;
    }

    public function index_get() {
        $response = $this->EstadoCivilMDL->getAll();

        $this->response($response,REST_Controller::HTTP_OK);
    }

}