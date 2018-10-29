<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 28/07/2017
 * Time: 17:04
 */
class Contrato_Model extends CI_Model
{
    private $chave;
    public function __construct() {
        $this->load->model('Lancamento_Model', 'lancamento');
        $this->chave = $this->session->userdata('chave');
        parent::__construct();
    }

    public function getAll() {
        $this->db->select("*")
            ->from("tb_contrato");

        return $this->db->get()->result_array();
    }

    public function getList() {
        $result = $this->db->query("SELECT con.id as id,
                                           lot.id as id_locatario,
                                           lot.nome as locatario,
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
                                    INNER JOIN tb_locatario as lot ON lot.id = con.id_locatario
                                    INNER JOIN tb_imovel as imo ON imo.id = con.id_imovel
                                    INNER JOIN tb_status as sta ON sta.id = con.id_status
                                    WHERE con.id_status = ? AND con.chave = ?
       ",[4,$this->chave]);
        return $result->result_array();
    }

    public function getContratosVigentes(){
        $result = $this->db->query("SELECT con.id as id,
                                           lot.id as id_locatario,
                                           lot.nome as locatario,
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
                                    INNER JOIN tb_locatario as lot ON lot.id = con.id_locatario
                                    INNER JOIN tb_imovel as imo ON imo.id = con.id_imovel
                                    INNER JOIN tb_status as sta ON sta.id = con.id_status
                                    WHERE con.id_status = 4 AND con.chave = ?
       ",[$this->chave]);

        return $result->result_array();
    }

    public function getContratosVencidos() {
        $result = $this->db->query("SELECT con.id as id,
                                           lot.id as id_locatario,
                                           lot.nome as locatario,
                                           lot.cpf as cpf,
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
                                    INNER JOIN tb_locatario as lot ON lot.id = con.id_locatario
                                    INNER JOIN tb_imovel as imo ON imo.id = con.id_imovel
                                    INNER JOIN tb_status as sta ON sta.id = con.id_status
                                    WHERE sta.id = 7 AND con.renovou = 0 AND con.chave = ?",[$this->chave]);

        return $result->result_array();
    }

    public function getQtdContratosVencidos() {
        $result = $this->db->query("SELECT COUNT(*) AS quantidade FROM
                                     (SELECT con.id as id,
                                           lot.id as id_locatario,
                                           lot.nome as locatario,
                                           lot.cpf as cpf,
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
                                    INNER JOIN tb_locatario as lot ON lot.id = con.id_locatario
                                    INNER JOIN tb_imovel as imo ON imo.id = con.id_imovel
                                    INNER JOIN tb_status as sta ON sta.id = con.id_status
                                    WHERE sta.id = 7 AND con.renovou = 0 AND con.chave = ?) AS tabela",[$this->chave]);

        return $result->row_array();
    }

    public function atualizaContratosVencidos(){
        $this->db->query("UPDATE tb_contrato SET id_status = 7 WHERE data_fim < now() and id_status =4");
    }

    public function atualizaAlugueisAtrasados(){
        $this->db->query("UPDATE tb_lancamento SET id_status = 2 WHERE data_vencimento < now() and id_status =1");
    }

    public function getContrato($id) {
        $result = $this->db->query("SELECT con.id as id,
                                           lot.id as id_locatario,
                                           lot.nome as nome_locatario,
                                           lot.cpf as cpf_locatario,
                                           lot.rg as rg_locatario,
                                           lot.orgao_expedidor as orgao_exp_locatario,
                                           lot.profissao as profissao_locatario,
                                           lot.bairro as bairro_locatario,
                                           lot.endereco as endereco_locatario,
                                           lot.uf_expedidor as uf_locatario,
                                           lot.cep as cep_locatario,
                                           lot.nacionalidade as nacionalidade_locatario,
                                           lot.cidade as cidade_locatario,
                                           lot.estado as estado_locatario,
                                           loc.id as id_locador,
                                           loc.nome as nome_locador,
                                           loc.cpf as cpf_locador,
                                           loc.rg as rg_locador,
                                           loc.cep as cep_locador,
                                           loc.orgao_expedidor as orgao_exp_locador,
                                           loc.uf_expedidor as uf_expedidor_locador,
                                           loc.endereco as endereco_locador,
                                           loc.numero as numero_locador,
                                           loc.bairro as bairro_locador,
                                           loc.complemento as complemento_locador,
                                           loc.cidade as cidade_locador,
                                           loc.estado as estado_locador,
                                           loc.profissao as profissao_locador,
                                           loc.nacionalidade as nacionalidade_locador,
                                           esc2.nome as estado_civil_locador,
                                           con.dia_vencimento as dia_vencimento,
                                           DATE_FORMAT(con.data_inicio, '%d/%m/%Y') as data_inicio,
                                           DATE_FORMAT(con.data_fim, '%d/%m/%Y') as data_fim,
                                           con.prazo,
                                           con.valor,
                                           con.primeiro_vencimento,
                                           imo.id as id_imovel,
                                           imo.nome as imovel,
                                           imo.uc as uc,
                                           imo.endereco as endereco_imovel,
                                           imo.complemento as complemento_imovel,
                                           imo.bairro as bairro_imovel,
                                           imo.cep as cep_imovel,
                                           sta.nome as status,
                                           esc.nome as estado_civil_locatario
                                    FROM tb_contrato as con
                                    LEFT JOIN tb_locatario as lot ON lot.id = con.id_locatario
                                    LEFT JOIN tb_imovel as imo ON imo.id = con.id_imovel
                                    LEFT JOIN tb_status as sta ON sta.id = con.id_status
                                    LEFT JOIN tb_locador as loc ON loc.id = con.id_locador
                                    LEFT JOIN tb_estado_civil esc ON esc.id = lot.id_estado_civil
                                    LEFT JOIN tb_estado_civil esc2 ON esc2.id = loc.id_estado_civil
                                    WHERE con.chave = ? AND con.id = ?",[$this->chave,$id]);
        return $result->row_array();
    }

    public function inserir($dados) {
        if (!isset($dados)) {
            $response["status"] = false;
            $response["message"] = "Dados não informados";
        } else {
            $this->db->trans_strict(TRUE);
            $this->db->trans_start();
            $dados = $this->preparaDados($dados);
            //error_log(var_export($dados, true), 3,'C:/xampp/htdocs/siskitnet/log.log');
            $status = $this->db->insert("tb_contrato",$dados);
            $idContrato = $this->db->insert_id();

            $datasVencimento = $this->gerarParcelas($dados['primeiro_vencimento'],$dados['prazo']);

                foreach ($datasVencimento as $value){

                 $dadosLancamento[] = [
                     'id_mes' =>  (int) date( 'm', strtotime( $value ) ),
                     'id_status' => 1,
                     'chave' => $this->chave,
                     'id_contrato' => $idContrato,
                     'valor' => $dados['valor'],
                     'data_vencimento' => $value,
                     'ano' =>date('Y'),
                 ];
                }
            //error_log(var_export($dadosLancamento, true), 3,'C:/xampp/htdocs/siskitnet/log.log');
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

//    public function preparaDados($dados){
//        $datasContrato = $this->gerarParcelas($dados['data_inicio'],$dados['prazo']);
//        $data['id_status'] = 4;
//        $data['id_locatario'] = $dados['id_locatario'];
//        $data['id_imovel'] = $dados['id_imovel'];
//        $data['valor'] = $dados['valor'];
//        $data['data_inicio'] = $dados['data_inicio'];
//        $data['chave'] = $this->chave;
//        $data['data_fim'] = $datasContrato[$dados['prazo']-1];
//        $data['dia_vencimento'] = date( 'd', strtotime( $dados['primeiro_vencimento']) );
//
//        return $data;
//    }

    public function renovarContrato($dados) {

        if (!isset($dados)) {
            $response["status"] = false;
            $response["message"] = "Dados não informados";
        } else {
            $this->db->trans_strict(TRUE);

            $this->db->trans_start();

            $dados = $this->preparaDadosRenovacao($dados);
            $this->db->where("id", $dados['id_contrato']);
            $this->db->update('tb_contrato', ['renovou'=> 1]);

            $this->db->insert("tb_contrato",$dados);
            //error_log(var_export($dados,true));
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

    public function naoRenovarContrato($id) {
        $response = [];
        if (!isset($id)) {
            $response["status"] = false;
            $response["message"] = "Nenhum parâmetro foi informado. Ocorreu um erro interno.";
        }else {

            $dados['id_status'] = 6;
            $this->db->where("id", $id);
            $this->db->update('tb_contrato', $dados);

            $afftectedRows =  $this->db->affected_rows();
            if ($afftectedRows ==  1){
                $response['status'] = true;
                $response['message'] = "O contrato contrato foi cumprido com sucesso.";
            }
            else{
                $error = $this->db->error();
                $response['status'] = false;
                $response['message'] = "Não foi possível cumprir o contrato. Por favor tente novamente!".$error['message'];
                $this->db->insert("tb_log",['message'=>$error['message']]);
            }
        }

        return $response;
    }

    private function preparaDados($dados) {
        $data = [];
        $datasContrato = $this->gerarParcelas($dados['data_inicio'],$dados['prazo']);
        $data['id_locatario'] = $dados['id_locatario'];
        $data['id_status'] = 4;
        $data['dia_vencimento'] = date( 'd', strtotime( $dados['primeiro_vencimento']) );
        $data['id_locador'] = $this->session->userdata('id_locador');
        $data['id_imovel'] = $dados['id_imovel'];
        $data['data_inicio'] = $dados['data_inicio'];
        $data['data_fim'] = $datasContrato[$dados['prazo']-1];
        $data['primeiro_vencimento'] = $dados['primeiro_vencimento'];
        $data['valor'] = $dados['valor'];
        $data['prazo'] = $dados['prazo'];
        $data['chave'] = $this->chave;

        return $data;
    }

    private function preparaDadosRenovacao($dados) {
        $chave = $this->session->userdata('chave');
        $data = [];
        $datasContrato = $this->gerarParcelas($dados['data_inicio'],$dados['prazo']);
        $data['id_locatario'] = $dados['id_locatario'];
        $data['data_inicio'] = $dados['data_inicio'];
        $data['primeiro_vencimento'] = $dados['primeiro_vencimento'];
        $data['data_fim'] = $datasContrato[$dados['prazo']-1];
        $data['valor'] = $dados['valor'];
        $data['id_status'] = 4;
        $dada['chave'] = $chave;
        $data['prazo'] = $dados['prazo'];
        $data['id_contrato'] = $dados['id_contrato'];
        $data['id_imovel'] = $dados['id_imovel'];
        $data['dia_vencimento'] = date( 'd', strtotime( $dados['primeiro_vencimento']) );
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
            $response['message'] = "Locaiário removido com sucesso.";
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