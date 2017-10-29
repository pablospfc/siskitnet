<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 29/10/2017
 * Time: 09:55
 */
//require_once __DIR__ . '/vendor/autoload.php';
require FCPATH.'vendor/autoload.php';
class Impressao extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Contrato_Model','ContratoMDL');

    }

    public function imprimir($id) {
        // Instancia a classe mPDF
       $mpdf = new \Mpdf\Mpdf();
       $data['dados'] = $this->ContratoMDL->getList($id);
        $html = $this->load->view('templates/contrato/contrato',$data,TRUE);
        // Define um Cabeçalho para o arquivo PDF
        $mpdf->SetHeader('Cpntrato de locação de imóvel');
        // Define um rodapé para o arquivo PDF, nesse caso inserindo o número da
        // página através da pseudo-variável PAGENO
        $mpdf->SetFooter('{PAGENO}');
        // Insere o conteúdo da variável $html no arquivo PDF
        $mpdf->writeHTML($html);

        $mpdf->Output('arquivo.pdf','D');
    }

}