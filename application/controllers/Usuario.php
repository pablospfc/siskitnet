<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 01/12/2017
 * Time: 20:27
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Usuario extends \REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Usuario_Model','UsuarioMDL');

        // Configuração para os limites de requisições (por hora)
        $this->methods['index_get']['limit'] = 10;
    }

    public function index_get()
    {
        $action = $this->uri->segment(2);

        if ($action == 'autenticar')
            $this->UsuarioMDL->getLogin();
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

}