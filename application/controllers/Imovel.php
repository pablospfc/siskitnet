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
        $this->load->model('Imovel_Model','ImovelMDL');

        // Configuração para os limites de requisições (por hora)
        $this->methods['index_get']['limit'] = 10;
    }

    public function index_get()
    {
        $imoveis = $this->ImovelMDL->getList();

        if ($imoveis) {
            $response = $imoveis;
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

        $response = $this->ImovelMDL->inserir($dados);

        $this->response($response, REST_Controller::HTTP_OK);
    }

    /*
     * Essa função vai responder pela rota /api/usuarios sob o método POST
     */
    public function index_put()
    {
        $dados = $this->put();

        $response = $this->ImovelMDL->atualizar($dados, $dados['id']);

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

        $response = $this->ImovelMDL->remover($id);

        $this->response($response, REST_Controller::HTTP_OK);
    }

}