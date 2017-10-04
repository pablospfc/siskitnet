<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 28/07/2017
 * Time: 17:04
 */
class Contrato_Model extends CI_Model
{
    public function __construct() {
        $this->load->model('Lancamento_Model', 'lancamento');
        parent::__construct();
    }

    public function getAll() {
        $this->db->select("*")
            ->from("tb_contrato");

        return $this->db->get()->result_array();
    }

    public function inserir($dados) {
        if (!isset($dados)) {
            $response["status"] = false;
            $response["message"] = "Dados não informados";
        } else {
            $this->db->trans_strict(TRUE);
            $this->form_validation->set_data($dados);
            // definimos as regras de validação
            $this->form_validation->set_rules('nome','nome','required|min_length[2]|trim');
            $this->form_validation->set_rules('email','email','required|valid_email|is_unique[tb_locatario.email]|trim');
            $this->db->trans_start();
            if ($this->form_validation->run()==false) {
                $response['status'] = false;
                $response['message'] = validation_errors();
            }else{
                $datas = $this->gerarParcelas($dados['primeiro_vencimento'],$dados['prazo']);
                $dados['data_inicio'] = $datas[0];
                $dados['data_fim'] = $datas[$dados['prazo']-1];
                $this->db->insert("tb_contrato",$dados);
                foreach ($datas as $value){

                }

                $this->db->trans_complete();

                if ($status){
                    $response['status'] = true;
                    $response['message'] = "Dados inseridos com sucesso";
                }else{
                    $error = $this->db->error();
                    $response['status'] = false;
                    $response['message'] = "Não foi possível cadastrar o locatário. Por favor tente novamente!";
                    $this->db->insert("tb_log",['message'=>$error['message']]);
                }
            }

        }

        return $response;

    }

    public function atualizar($dados, $id) {
        $response = [];
        if (!isset($dados)) {
            $response["status"] = false;
            $response["message"] = "Dados não informados";
        }else {
            $this->form_validation->set_data($dados);
            $this->form_validation->set_rules('nome', 'Nome', 'required|min_length[2]|trim');

            if ($this->form_validation->run() == true) {
                $this->db->where("id", $id);
                $this->db->update('tb_locatario', $dados);
                $afftectedRows =  $this->db->affected_rows();
                if ($afftectedRows ==  1){
                    $response['status'] = true;
                    $response['message'] = "Dados atualizados com sucesso";
                }
                else{
                    $error = $this->db->error();
                    $response['status'] = false;
                    $response['message'] = "Não foi possível atualizar o locatário. Por favor tente novamente!";
                    $this->db->insert("tb_log",['message'=>$error['message']]);
                }
            } else {
                $response['status'] = false;
                $response['message'] = validation_errors();
            }
        }

        return $response;
    }

    public function remover($value)
    {
        $this->db->where("id", $value);

        $status = $this->db->delete('tb_locatario');

        if ($status) {
            $response['status'] = true;
            $response['message'] = "Locatário removido com sucesso.";
        } else {
            $error = $this->db->error();
            $response['status'] = false;
            $response['message'] = "Não foi possível remover o locatário. Por favor tente novamente";
            $this->db->insert("tb_log",['message'=>$error['message']]);
        }

        return $response;

    }

    private function gerarParcelas($data, $parcelas) {

// DATA PARA A PRIMEIRA PARCELA A PAGAR
/////////// ANO, MÊS, DIA
///
        $partes = explode("-", $data);
        $ano = $partes[0];
        $mes = $partes[1];
        $dia = $partes[2];

        $DP = Array($ano, $mes, $dia);

// ARRAY PARA AS DATAS
        $data_array = Array($DP[0], $DP[1], $DP[2]);
        $data_array2 = Array($DP[0], $DP[1], $DP[2]);

        $datas = [];

// ARMAZENANDO MÊS DA DATA MENOS 1
        $n = $data_array[1]-1;
        $v_i = $n;

// FOR PRINCIPAL
        for($i = 0; $i < $parcelas; $i++) {
            $v_i++;

// BASE PARA SOMAR OS MESES
            $v = strtotime ( '+'.$i.' month' , strtotime(implode("-", $data_array))) ;
            $v2 = strtotime ( '+'.$i.' month' , strtotime(implode("-", $data_array2))) ;
            $nd = date ( 'Y-m-d' , $v );
            $nd2 = date ( 'Y-m-d' , $v2 );

// PEDAÇOS DA DATA DO LAÇO
            $p = explode("-", $nd);

// ATÉ 12 MÊSES
            if($v_i <= 12) {

// BASE DO MÊS ATUAL
                $base_mes = date("Y-m-t", strtotime($nd));

// PEGANDO O ÚLTIMO DIA DO MÊS DO LAÇO
                $forma_data = $p[0].'-'.$v_i.'-01';
                $ultimo_dia_do_mes = date("Y-m-t", strtotime($forma_data));
                $b1 = explode("-", $base_mes); // EXPLODE DO BASE MES
                $b2 = explode("-", $ultimo_dia_do_mes); // EXPLODE DO ULTIMO DIA DO MÊS

                if($b1[2]!=$b2[2]) {
                    $datas[] = "{$b2[0]}-{$b2[1]}-{$b2[2]}<br>";
                } else {
                    $datas[] = "{$b1[0]}-{$b1[1]}-{$data_array[2]}<br>";
                }

            }
// ATÉ 12 MÊSES

// DE 12 À 24 MESES
            elseif($v_i > 12 && $v_i <= 24) {

// BASE DO MÊS ATUAL
                $base_mes = date("Y-m-t", strtotime($nd));

// PEGANDO O ÚLTIMO DIA DO MÊS DO LAÇO
                $forma_data = $p[0].'-'.($v_i-12).'-01';
                $ultimo_dia_do_mes = date("Y-m-t", strtotime($forma_data));
                $b1 = explode("-", $base_mes); // EXPLODE DO BASE MES
                $b2 = explode("-", $ultimo_dia_do_mes); // EXPLODE DO ULTIMO DIA DO MÊS

                if($b1[2]!=$b2[2]) {
                    $datas[] = "{$b2[0]}-{$b2[1]}-{$b2[2]}<br>";
                } else {
                    $datas[] = "{$b1[0]}-{$b1[1]}-{$data_array[2]}<br>";
                }

            }
// DE 12 À 24 MESES

// DE 24 À 36 MESES
            elseif($v_i > 24 && $v_i <= 36){

// BASE DO MÊS ATUAL
                $base_mes = date("Y-m-t", strtotime($nd));

// PEGANDO O ÚLTIMO DIA DO MÊS DO LAÇO
                $forma_data = $p[0].'-'.($v_i-24).'-01';
                $ultimo_dia_do_mes = date("Y-m-t", strtotime($forma_data));
                $b1 = explode("-", $base_mes); // EXPLODE DO BASE MES
                $b2 = explode("-", $ultimo_dia_do_mes); // EXPLODE DO ULTIMO DIA DO MÊS

                if($b1[2]!=$b2[2]) {
                    $datas[] = "{$b2[0]}-{$b2[1]}-{$b2[2]}<br>";
                } else {
                    $datas[] = "{$b1[0]}-{$b1[1]}-{$data_array[2]}<br>";
                }

            }
// DE 24 À 36 MESES

// DE 36 À 48 MESES
            elseif($v_i > 36 && $v_i <= 48){

// BASE DO MÊS ATUAL
                $base_mes = date("Y-m-t", strtotime($nd));

// PEGANDO O ÚLTIMO DIA DO MÊS DO LAÇO
                $forma_data = $p[0].'-'.($v_i-36).'-01';
                $ultimo_dia_do_mes = date("Y-m-t", strtotime($forma_data));
                $b1 = explode("-", $base_mes); // EXPLODE DO BASE MES
                $b2 = explode("-", $ultimo_dia_do_mes); // EXPLODE DO ULTIMO DIA DO MÊS

                if($b1[2]!=$b2[2]) {
                    $datas[] = "{$b2[0]}-{$b2[1]}-{$b2[2]}<br>";
                } else {
                    $datas[] = "{$b1[0]}-{$b1[1]}-{$data_array[2]}<br>";
                }

            }
// DE 36 À 48 MESES

// DE 48 À 60 MESES
            elseif($v_i > 48 && $v_i <= 60){

// BASE DO MÊS ATUAL
                $base_mes = date("Y-m-t", strtotime($nd));

// PEGANDO O ÚLTIMO DIA DO MÊS DO LAÇO
                $forma_data = $p[0].'-'.($v_i-48).'-01';
                $ultimo_dia_do_mes = date("Y-m-t", strtotime($forma_data));
                $b1 = explode("-", $base_mes); // EXPLODE DO BASE MES
                $b2 = explode("-", $ultimo_dia_do_mes); // EXPLODE DO ULTIMO DIA DO MÊS

                if($b1[2]!=$b2[2]) {
                    $datas[] = "{$b2[0]}-{$b2[1]}-{$b2[2]}<br>";
                } else {
                    $datas[] = "{$b1[0]}-{$b1[1]}-{$data_array[2]}<br>";
                }

            }
// DE 48 À 60 MESES

            else {
            } // FIM DO ELSEIF
        } // FIM DO FOR PRINCIPAL

        return $datas;
    }

}