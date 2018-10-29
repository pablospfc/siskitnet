<?php
/**
 * Created by PhpStorm.
 * User: claud
 * Date: 24/03/2018
 * Time: 16:36
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Proprietario extends \REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Proprietario_Model','ProprietarioMDL');

    }

    public function index_get()
    {
        $response = $this->ProprietarioMDL->getDadosProprietario();

        $this->response($response, REST_Controller::HTTP_OK);
    }

    public function index_post()
    {

    }

    public function index_put()
    {
        $dados = $this->put();
        $response = $this->ProprietarioMDL->atualizar($dados, $dados['id']);

        $this->response($response, REST_Controller::HTTP_OK);

    }

    public function index_delete()
    {

    }

}