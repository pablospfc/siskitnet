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

    public function getList() {
        $result = $this->db->query("SELECT con.id as id,
                                           loc.id as id_locatario,
                                           loc.nome as locatario,
                                           con.dia_vencimento as dia_vencimento,
                                           con.data_inicio,
                                           con.data_fim,
                                           con.prazo,
                                           con.valor,
                                           con.primeiro_vencimento,
                                           imo.id as id_imovel,
                                           imo.nome as imovel,
                                           sta.nome as status
                                    FROM tb_contrato as con
                                    INNER JOIN tb_locatario as loc ON loc.id = con.id_locatario
                                    INNER JOIN tb_imovel as imo ON imo.id = con.id_imovel
                                    INNER JOIN tb_status as sta ON sta.id = con.id_status
       ");
        return $result->result_array();
    }

    public function getContratosVigentes(){
        $result = $this->db->query("SELECT con.id as id,
                                           loc.id as id_locatario,
                                           loc.nome as locatario,
                                           con.dia_vencimento as dia_vencimento,
                                           con.data_inicio,
                                           con.data_fim,
                                           con.prazo,
                                           con.valor,
                                           con.primeiro_vencimento,
                                           imo.id as id_imovel,
                                           imo.nome as imovel,
                                           sta.nome as status
                                    FROM tb_contrato as con
                                    INNER JOIN tb_locatario as loc ON loc.id = con.id_locatario
                                    INNER JOIN tb_imovel as imo ON imo.id = con.id_imovel
                                    INNER JOIN tb_status as sta ON sta.id = con.id_status
                                    WHERE con.id_status = 4
       ");

        return $result->result_array();
    }

    public function getContratosVencidos() {
        $result = $this->db->query("SELECT con.id as id,
                                           loc.id as id_locatario,
                                           loc.nome as locatario,
                                           loc.cpf as cpf,
                                           con.dia_vencimento as dia_vencimento,
                                           con.data_inicio,
                                           con.data_fim,
                                           con.prazo,
                                           con.valor,
                                           imo.id as id_imovel,
                                           imo.nome as imovel,
                                           imo.uc as uc,
                                           sta.nome as status
                                    FROM tb_contrato as con
                                    INNER JOIN tb_locatario as loc ON loc.id = con.id_locatario
                                    INNER JOIN tb_imovel as imo ON imo.id = con.id_imovel
                                    INNER JOIN tb_status as sta ON sta.id = con.id_status
                                    WHERE sta.id = 7");

        return $result->result_array();
    }

    public function getQtdContratosVencidos() {
        $result = $this->db->query("SELECT COUNT(*) AS quantidade FROM
                                     (SELECT con.id as id,
                                           loc.id as id_locatario,
                                           loc.nome as locatario,
                                           loc.cpf as cpf,
                                           con.dia_vencimento as dia_vencimento,
                                           con.data_inicio,
                                           con.data_fim,
                                           con.prazo,
                                           con.valor,
                                           imo.id as id_imovel,
                                           imo.nome as imovel,
                                           imo.uc as uc,
                                           sta.nome as status
                                    FROM tb_contrato as con
                                    INNER JOIN tb_locatario as loc ON loc.id = con.id_locatario
                                    INNER JOIN tb_imovel as imo ON imo.id = con.id_imovel
                                    INNER JOIN tb_status as sta ON sta.id = con.id_status
                                    WHERE sta.id = 7) AS tabela");

        return $result->row_array();
    }

    public function getContrato($id) {
        $result = $this->db->query("SELECT con.id as id,
                                           loc.id as id_locatario,
                                           loc.nome as locatario,
                                           loc.cpf as cpf,
                                           loc.rg as rg,
                                           loc.orgao_expedidor as orgao_exp,
                                           loc.profissao as profissao,
                                           loc.bairro as bairro,
                                           loc.endereco as endereco,
                                           loc.uf_expedidor as uf,
                                           loc.cep as cep,
                                           con.dia_vencimento as dia_vencimento,
                                           con.data_inicio,
                                           con.data_fim,
                                           con.prazo,
                                           con.valor,
                                           con.primeiro_vencimento,
                                           imo.id as id_imovel,
                                           imo.nome as imovel,
                                           imo.uc as uc,
                                           sta.nome as status,
                                           esc.nome as estado_civil
                                    FROM tb_contrato as con
                                    INNER JOIN tb_locatario as loc ON loc.id = con.id_locatario
                                    INNER JOIN tb_imovel as imo ON imo.id = con.id_imovel
                                    INNER JOIN tb_status as sta ON sta.id = con.id_status
                                    INNER JOIN tb_estado_civil esc ON esc.id = loc.id_estado_civil
                                    WHERE con.id = ".$id);
        return $result->row_array();
    }

    public function inserir($dados) {
        if (!isset($dados)) {
            $response["status"] = false;
            $response["message"] = "Dados não informados";
        } else {
            $this->db->trans_strict(TRUE);
            // definimos as regras de validação
            $this->db->trans_start();
                $datasContrato = $this->gerarParcelas($dados['data_inicio'],$dados['prazo']);
                $dados['id_status'] = 4;
                $dados['data_fim'] = $datasContrato[$dados['prazo']-1];
                $dados['dia_vencimento'] = date( 'd', strtotime( $dados['primeiro_vencimento']) );
                $this->db->insert("tb_contrato",$dados);
                $idContrato = $this->db->insert_id();
                $datasVencimento = $this->gerarParcelas($dados['primeiro_vencimento'],$dados['prazo']);

                foreach ($datasVencimento as $value){

                 $dadosLancamento[] = [
                     'id_mes' =>  date( 'm', strtotime( $value ) ),
                     'id_status' => 1,
                     'id_contrato' =>$idContrato,
                     'valor' => $dados['valor'],
                     'data_vencimento' => $value,
                     'ano' =>2017,
                 ];
                }

                $this->lancamento->inserir($dadosLancamento);

                $this->db->trans_complete();

                if ($this->db->trans_status() === TRUE){
                    $response['status'] = true;
                    $response['message'] = "Dados inseridos com sucesso";
                }else{
                    $error = $this->db->error();
                    $response['status'] = false;
                    $response['message'] = "Não foi possível cadastrar o contrato. Por favor tente novamente!".$error;
                    $this->db->insert("tb_log",['message'=>$error['message']]);
                }
            }



        return $response;

    }

    private function preparaDados($dados) {
        $data = [];
        $datasContrato = $this->gerarParcelas($dados['data_inicio'],$dados['prazo']);
        $data['id_locatario'] = $dados['id_locatario'];
        $data['id_imovel'] = $dados['id_imovel'];
        $data['data_inicio'] = $dados['data_inicio'];
        $dados['data_fim'] = $datasContrato[$dados['prazo']-1];
        $data['dia_vencimento'] = $dados['dia_vencimento'];
        $data['valor'] = $dados['valor'];
        return $data;
    }

    public function atualizar($dados, $id) {
        $response = [];
        if (!isset($dados)) {
            $response["status"] = false;
            $response["message"] = "Dados não informados";
        }else {
            $this->db->trans_strict(TRUE);
            // definimos as regras de validação
            $this->db->trans_start();
            $datosContrato = $this->preparaDados($dados);
            $this->db->where("id", $id);
            $this->db->update('tb_contrato', $datosContrato);

             $lancamentos = $this->lancamento->getLancamentos($id);

             foreach ($lancamentos as $data) {
                 $partes = explode("-", $data['data_vencimento']);
                 $ano = $partes[0];
                 $mes = $partes[1];
                 $dia = $datosContrato['dia_vencimento'];

                  $dadosLancamento = [
                    'valor' => $datosContrato['valor'],
                    'data_vencimento' =>$ano.'-'.$mes.'-'.$dia,
                  ];

                  $this->lancamento->atualizar($data['id'],$dadosLancamento);
             }

               $this->db->trans_complete();

                //$afftectedRows =  $this->db->affected_rows();
                if ($this->db->trans_status() === true){
                    $response['status'] = true;
                    $response['message'] = "Dados de contrato atualizados com sucesso";
                }
                else{
                    $error = $this->db->error();
                    $response['status'] = false;
                    $response['message'] = "Não foi possível atualizar o locatário. Por favor tente novamente!".$error['message'];
                    $this->db->insert("tb_log",['message'=>$error['message']]);
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
                    $datas[] = "{$b2[0]}-{$b2[1]}-{$b2[2]}";
                } else {
                    $datas[] = "{$b1[0]}-{$b1[1]}-{$data_array[2]}";
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
                    $datas[] = "{$b2[0]}-{$b2[1]}-{$b2[2]}";
                } else {
                    $datas[] = "{$b1[0]}-{$b1[1]}-{$data_array[2]}";
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
                    $datas[] = "{$b2[0]}-{$b2[1]}-{$b2[2]}";
                } else {
                    $datas[] = "{$b1[0]}-{$b1[1]}-{$data_array[2]}";
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
                    $datas[] = "{$b2[0]}-{$b2[1]}-{$b2[2]}";
                } else {
                    $datas[] = "{$b1[0]}-{$b1[1]}-{$data_array[2]}";
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
                    $datas[] = "{$b2[0]}-{$b2[1]}-{$b2[2]}";
                } else {
                    $datas[] = "{$b1[0]}-{$b1[1]}-{$data_array[2]}";
                }

            }
// DE 48 À 60 MESES

            else {
            } // FIM DO ELSEIF
        } // FIM DO FOR PRINCIPAL

        return $datas;
    }

}