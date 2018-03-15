<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 07/01/2018
 * Time: 11:57
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Relatorio extends \REST_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Relatorio_Model','RelatorioMDL');

        // Configuração para os limites de requisições (por hora)
        $this->methods['index_get']['limit'] = 10;
    }

    public function index_get()
    {
        $action = $this->get('action');
        $idMes = $this->get('id_mes');
        $ano = $this->get('ano');
        $tipoDespesa = $this->get('tipo_despesa');

        switch ($action) {
            case "getRelatorioDespesas":
                $dados = $this->RelatorioMDL->getRelatorioDespesas($idMes,$ano,$tipoDespesa);
                break;
            case "getRelatorioAlugueis":
                $dados = $this->RelatorioMDL->getRelatorioAlugueis();
                break;
            case "getRelatorioIndenizacoes":
                $dados = $this->RelatorioMDL->getRelatorioIndenizacoes();
                break;
            case "getRelatorioLocatarios":
                $dados = $this->RelatorioMDL->getRelatorioLocatarios();
                break;
            case "getRelatorioImoveiss":
                $dados = $this->RelatorioMDL->getRelatorioImoveiss();
                break;
        }

        if ($dados) {
            $response = $dados;
            $this->response($response, REST_Controller::HTTP_OK);
        } else {
            $this->response(null,REST_Controller::HTTP_NO_CONTENT);
        }
    }

}