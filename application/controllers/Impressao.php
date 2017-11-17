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
        $this->load->model('Pagamento_Model','PagamentoMDL');

    }

    public function imprimirContrato($id) {
        // Instancia a classe mPDF
       $mpdf = new \Mpdf\Mpdf();
       $data['dados'] = $this->ContratoMDL->getContrato($id);
       $data['dados']['prazo_extenso'] = $this->convert_number_to_words($data['dados']['prazo']);
       $data['dados']['valor_extenso'] = $this->convert_number_to_words($data['dados']['valor']);
        $html = $this->load->view('templates/contrato/contrato',$data,TRUE);
        // Define um Cabeçalho para o arquivo PDF
        $mpdf->SetHeader('Contrato de locação de imóvel');
        // Define um rodapé para o arquivo PDF, nesse caso inserindo o número da
        // página através da pseudo-variável PAGENO
        $mpdf->SetFooter('{PAGENO}');
        // Insere o conteúdo da variável $html no arquivo PDF
        $mpdf->writeHTML($html);

        $mpdf->Output($data['dados']['locatario'].'-'.date('Y-m-d H:i:s').'.pdf','D');
    }

    public function imprimirRecibo($id) {
        // Instancia a classe mPDF
        $mpdf = new \Mpdf\Mpdf();
        $data['dados'] = $this->PagamentoMDL->getRecibo($id);
        $data['dados']['valor_total_extenso'] = $this->convert_number_to_words($data['dados']['valor_total']);
        $html = $this->load->view('templates/pagamento/recibo',$data,TRUE);
        // Define um Cabeçalho para o arquivo PDF
        $mpdf->SetHeader('Recibo de pagamento de aluguel');
        // Define um rodapé para o arquivo PDF, nesse caso inserindo o número da
        // página através da pseudo-variável PAGENO
        $mpdf->SetFooter('{PAGENO}');
        // Insere o conteúdo da variável $html no arquivo PDF
        $mpdf->writeHTML($html);

        $mpdf->Output($data['dados']['recibo'].'-'.date('Y-m-d H:i:s').'.pdf','D');
    }

    public function convert_number_to_words($number) {

        $hyphen      = '-';
        $conjunction = ' e ';
        $separator   = ', ';
        $negative    = 'menos ';
        $decimal     = ' ponto ';
        $dictionary  = array(
            0                   => 'zero',
            1                   => 'um',
            2                   => 'dois',
            3                   => 'três',
            4                   => 'quatro',
            5                   => 'cinco',
            6                   => 'seis',
            7                   => 'sete',
            8                   => 'oito',
            9                   => 'nove',
            10                  => 'dez',
            11                  => 'onze',
            12                  => 'doze',
            13                  => 'treze',
            14                  => 'quatorze',
            15                  => 'quinze',
            16                  => 'dezesseis',
            17                  => 'dezessete',
            18                  => 'dezoito',
            19                  => 'dezenove',
            20                  => 'vinte',
            30                  => 'trinta',
            40                  => 'quarenta',
            50                  => 'cinquenta',
            60                  => 'sessenta',
            70                  => 'setenta',
            80                  => 'oitenta',
            90                  => 'noventa',
            100                 => 'cento',
            200                 => 'duzentos',
            300                 => 'trezentos',
            400                 => 'quatrocentos',
            500                 => 'quinhentos',
            600                 => 'seiscentos',
            700                 => 'setecentos',
            800                 => 'oitocentos',
            900                 => 'novecentos',
            1000                => 'mil',
            1000000             => array('milhão', 'milhões'),
            1000000000          => array('bilhão', 'bilhões'),
            1000000000000       => array('trilhão', 'trilhões'),
            1000000000000000    => array('quatrilhão', 'quatrilhões'),
            1000000000000000000 => array('quinquilhão', 'quinquilhões')
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words só aceita números entre ' . PHP_INT_MAX . ' à ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . $this->convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $conjunction . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = floor($number / 100)*100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds];
                if ($remainder) {
                    $string .= $conjunction . $this->convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                if ($baseUnit == 1000) {
                    $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[1000];
                } elseif ($numBaseUnits == 1) {
                    $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit][0];
                } else {
                    $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit][1];
                }
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= $this->convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }

}