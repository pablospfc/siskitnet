<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 03/11/2017
 * Time: 20:12
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Pagamento extends \REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pagamento_Model','PagamentoMDL');

        // Configuração para os limites de requisições (por hora)
        $this->methods['index_get']['limit'] = 10;
    }

    public function index_get()
    {
        $pagamentos = $this->PagamentoMDL->getList();

        if ($pagamentos) {
            $response = $pagamentos;
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

        $response = $this->PagamentoMDL->inserir($dados);

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

        $response = $this->PagamentoMDL->atualizar($dados, $dados['id']);

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

        $response = $this->PagamentoMDL->remover($id);

        $this->response($response, REST_Controller::HTTP_OK);
    }

}