<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 26/03/2017
 * Time: 14:40
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Locatario extends REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Locatario_model','LocatarioMDL');

        // Configuração para os limites de requisições (por hora)
        $this->methods['index_get']['limit'] = 10;
    }

    /*
     * Essa função vai responder pela rota /api/usuarios sob o método GET
     */
    public function index_get()
    {
        $locatarios = $this->LocatarioMDL->getAll();

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

        $response = $this->LocatarioMDL->inserir($dados);

        $this->response($response, REST_Controller::HTTP_OK);
    }

    /*
     * Essa função vai responder pela rota /api/usuarios sob o método POST
     */
    public function index_put()
    {
        // recupera os dados informado no formulário
        $usuario = $this->put();
        $usuario_id = $this->uri->segment(3);

        // processa o update no banco de dados
        $update = $this->LocatarioMDL->Update('id',$usuario_id, $usuario);
        // define a mensagem do processamento
        $response['message'] = $update['message'];

        // verifica o status do update para retornar o cabeçalho corretamente
        // e a mensagem
        if ($update['status']) {
            $this->response($response, REST_Controller::HTTP_OK);
        } else {
            $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    /*
     * Essa função vai responder pela rota /api/usuarios sob o método DELETE
     */
    public function index_delete()
    {
        $id = $this->uri->segment(3);
        error_log($id);

        if (!$id)
        {
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST);
        }

        $response = $this->LocatarioMDL->remover($id);

        $this->response($response, REST_Controller::HTTP_OK);
    }

}