<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 14/11/2017
 * Time: 22:34
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Home extends \REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Contrato_Model','ContratoMDL');
        $this->load->model('Lancamento_Model','LancamentoMDL');

        // Configuração para os limites de requisições (por hora)
        $this->methods['index_get']['limit'] = 10;
    }

    public function index_get()
    {
        $qtdContratosVencidos = $this->ContratoMDL->getQtdContratosVencidos()['quantidade'];
        $qtdAlugueisAtrasados = $this->LancamentoMDL->getQtdAlugueisAtrasados()['quantidade'];
        $qtdAluguesMes = $this->LancamentoMDL->getQtdAlugueisMes()['quantidade'];

        $this->ContratoMDL->atualizaContratosVencidos();
        $this->ContratoMDL->atualizaAlugueisAtrasados();

        $response = [
            'qtdContratosVencidos' => $qtdContratosVencidos,
            'qtdAlugueisAtrasados' => $qtdAlugueisAtrasados,
            'qtdAlugueisMes' => $qtdAluguesMes,
        ];

            $this->response($response, REST_Controller::HTTP_OK);
    }

    public function getContratos() {
        $contratos = $this->ContratoMDL->getContratosVigentes();

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

        $response = $this->ContratoMDL->inserir($dados);

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


    }

    /*
     * Essa função vai responder pela rota /api/usuarios sob o método DELETE
     */
    public function index_delete()
    {

    }

}