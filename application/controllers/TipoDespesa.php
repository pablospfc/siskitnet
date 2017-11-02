<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 02/11/2017
 * Time: 18:14
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class TipoDespesa extends \REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('TipoDespesa_Model','TipoDespesaMDL');

        // Configuração para os limites de requisições (por hora)
        $this->methods['index_get']['limit'] = 10;
    }

    public function index_get() {
        $response = $this->TipoDespesaMDL->getAll();

        $this->response($response,REST_Controller::HTTP_OK);
    }

}