<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 18/11/2017
 * Time: 14:02
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Aluguel extends \REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Lancamento_Model','LancamentoMDL');

        // Configuração para os limites de requisições (por hora)
        $this->methods['index_get']['limit'] = 10;
    }

    public function index_get()
    {
        $action = $this->uri->segment(2);

        if ($action == 'getAlugueisMes')
            $this->getAlugueisMes();
        else
            $this->getAlugueisAtrasados();

    }

    public function index_post()
    {

    }

    public function index_put()
    {

    }

    public function index_delete()
    {

    }

    public function getAlugueisAtrasados() {
        $alugueis = $this->LancamentoMDL->getAlugueisAtrasados();

        if ($alugueis) {
            $response = $alugueis;
            $this->response($response, REST_Controller::HTTP_OK);
        } else {
            $this->response(null,REST_Controller::HTTP_NO_CONTENT);
        }
    }

    public function getAlugueisMes() {
        $alugueis = $this->LancamentoMDL->getAlugueisMes();

        if ($alugueis) {
            $response = $alugueis;
            $this->response($response, REST_Controller::HTTP_OK);
        } else {
            $this->response(null,REST_Controller::HTTP_NO_CONTENT);
        }
    }

}