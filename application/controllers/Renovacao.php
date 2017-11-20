<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 19/11/2017
 * Time: 12:14
 */


/**
 * Created by PhpStorm.
 * User: claud
 * Date: 30/09/2017
 * Time: 19:20
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Renovacao extends \REST_Controller
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
        $contratos = $this->ContratoMDL->getContratosVencidos();

        if ($contratos) {
            $response = $contratos;
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

        $response = $this->ContratoMDL->renovarContrato($dados);

        if ($response['status'])
            $this->response($response, REST_Controller::HTTP_OK);
        else
            $this->response(['message'=>'Não foi possível realizar a operação.'],REST_Controller::HTTP_NO_CONTENT);
    }

    /*
     * Essa função vai responder pela rota /api/usuarios sob o método POST
     */
    public function index_put()
    {
        $dados = $this->put();

        $response = $this->ContratoMDL->naoRenovarContrato($dados, $dados['id']);

        $this->response($response, REST_Controller::HTTP_OK);

    }

}