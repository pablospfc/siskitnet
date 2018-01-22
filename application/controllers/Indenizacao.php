<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 21/01/2018
 * Time: 12:52
 */
require APPPATH . '/libraries/REST_Controller.php';
class Indenizacao extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Indenizacao_Model','IndenizacaoMDL');

        // Configuração para os limites de requisições (por hora)
        $this->methods['index_get']['limit'] = 10;
    }

    public function index_get()
    {
        $indenizacoes = $this->IndenizacaoMDL->getList();

        if ($indenizacoes) {
            $response = $indenizacoes;
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

        $response = $this->IndenizacaoMDL->inserir($dados);

        $this->response($response, REST_Controller::HTTP_OK);
    }

    /*
     * Essa função vai responder pela rota /api/usuarios sob o método POST
     */
    public function index_put()
    {
        $dados = $this->put();

        $response = $this->IndenizacaoMDL->atualizar($dados, $dados['id']);

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

        $response = $this->IndenizacaoMDL->remover($id);

        $this->response($response, REST_Controller::HTTP_OK);
    }
}