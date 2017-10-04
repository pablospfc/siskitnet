<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 30/09/2017
 * Time: 19:20
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Contrato extends \REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Contrato_Model','ContratoMDL');

        // Configuração para os limites de requisições (por hora)
        $this->methods['index_get']['limit'] = 10;
    }

    public function index_get()
    {
        $locatarios = $this->ContratoMDL->getAll();

        if ($locatarios) {
            $response = $locatarios;
            $this->response($response, REST_Controller::HTTP_OK);
        } else {
            $this->response(null,REST_Controller::HTTP_NO_CONTENT);
        }
    }

    /*
     * Essa função vai responder pela rota /api/usuarios sob o método POST
     */
    public function index_post()
    {
        $dados = $this->post();

        $response = $this->ContratoMDL->inserir($dados);

        $this->response($response, REST_Controller::HTTP_OK);
    }

    /*
     * Essa função vai responder pela rota /api/usuarios sob o método POST
     */
    public function index_put()
    {
        $dados = $this->put();

        $response = $this->ContratoMDL->atualizar($dados, $dados['id']);

        $this->response($response, REST_Controller::HTTP_OK);

    }

    /*
     * Essa função vai responder pela rota /api/usuarios sob o método DELETE
     */
    public function index_delete()
    {
        $id = $this->delete('id');

        if (!$id)
        {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }

        $response = $this->ContratoMDL->remover($id);

        $this->response($response, REST_Controller::HTTP_OK);
    }

}