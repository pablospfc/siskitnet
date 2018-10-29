<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 02/10/2017
 * Time: 20:36
 */
class Lancamento_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function inserir($dados) {
        return $this->db->insert_batch("tb_lancamento",$dados);
    }

    public function atualizar($id,$dados) {
        $this->db->where("id", $id);
        return $this->db->update('tb_lancamento', $dados);
    }

    //retorna todos os lancamentos do contrato que estejam em aberto ou em atraso, para a alteração da data de vencimento
    public function getLancamentos($idContrato){
        $chave = $this->session->userdata('chave');
        if ($idContrato <= 0) {
            return array();
        }

        $this->db->select("*")
            ->from("tb_lancamento")
            ->where("id_contrato", $idContrato)
            ->where("id_status <>", 3)
            ->where("chave", $chave);

        return $this->db->get()->result_array();
    }

    public function atualizaPagamento($mes, $contrato, $dados) {
        $this->db->where("id_mes", $mes);
        $this->db->where("id_contrato", $contrato);
        return $this->db->update('tb_lancamento', $dados);
    }

    public function getAlugueisMes(){
        $chave = $this->session->userdata('chave');
        $result = $this->db->query("SELECT
                                           lot.nome as locatario,
                                           lot.cpf as cpf,
                                           lan.ano as ano,
                                           lan.data_vencimento,
                                           mes.nome as mes,
                                           con.valor,
                                           lan.valor_pago,
                                           lan.data_pagamento,
                                           imo.nome as imovel,
                                           sta.nome as status
                                    FROM tb_contrato as con
                                    INNER JOIN tb_locatario as lot ON lot.id = con.id_locatario
                                    INNER JOIN tb_imovel as imo ON imo.id = con.id_imovel
                                    INNER JOIN tb_lancamento lan ON lan.id_contrato = con.id
                                    INNER JOIN tb_status as sta ON sta.id = lan.id_status
                                    INNER JOIN tb_mes mes ON mes.id = lan.id_mes
                                    WHERE YEAR(lan.data_vencimento) = YEAR(now()) 
                                    AND MONTH(lan.data_vencimento) =  MONTH(now()) 
                                   AND lan.chave = ?",[$chave]);

        return $result->result_array();
    }

    public function getQtdAlugueisMes(){
        $chave = $this->session->userdata('chave');
        $result = $this->db->query("SELECT COUNT(*) as quantidade  FROM 
                                        (SELECT
                                           lot.nome as locatario,
                                           lot.cpf as cpf,
                                           lan.ano as ano,
                                           lan.data_vencimento,
                                           mes.nome as mes,
                                           con.valor,
                                           imo.nome as imovel,
                                           sta.nome as status
                                    FROM tb_contrato as con
                                    INNER JOIN tb_locatario as lot ON lot.id = con.id_locatario
                                    INNER JOIN tb_imovel as imo ON imo.id = con.id_imovel
                                    INNER JOIN tb_lancamento lan ON lan.id_contrato = con.id
                                    INNER JOIN tb_status as sta ON sta.id = lan.id_status
                                    INNER JOIN tb_mes mes ON mes.id = lan.id_mes
                                    WHERE YEAR(lan.data_vencimento) = YEAR(now()) 
                                    AND MONTH(lan.data_vencimento) =  MONTH(now())
                                    AND lan.chave = ?
                                    ) as tabela;",[$chave]);

         return $result->row_array();
    }

    public function getAlugueisAtrasados() {
        $chave = $this->session->userdata('chave');
        $result = $this->db->query("SELECT
                                           lot.nome as locatario,
                                           lot.cpf as cpf,
                                           lan.ano as ano,
                                           lan.data_vencimento,
                                           mes.nome as mes,
                                           con.valor,
                                           imo.nome as imovel,
                                           sta.nome as status
                                    FROM tb_contrato as con
                                    INNER JOIN tb_locatario as lot ON lot.id = con.id_locatario
                                    INNER JOIN tb_imovel as imo ON imo.id = con.id_imovel
                                    INNER JOIN tb_lancamento lan ON lan.id_contrato = con.id
                                    INNER JOIN tb_status as sta ON sta.id = lan.id_status
                                    INNER JOIN tb_mes mes ON mes.id = lan.id_mes
                                    WHERE lan.id_status = 2 AND lan.chave = ?
                                    ",[$chave]);

        return $result->result_array();
    }

    public function getQtdAlugueisAtrasados() {
        $chave = $this->session->userdata('chave');
        $result = $this->db->query("SELECT COUNT(*) AS quantidade FROM
                                          (SELECT
                                           lot.nome as locatario,
                                           lot.cpf as cpf,
                                           lan.ano as ano,
                                           lan.data_vencimento,
                                           mes.nome as mes,
                                           con.valor,
                                           imo.nome as imovel,
                                           sta.nome as status
                                    FROM tb_contrato as con
                                    INNER JOIN tb_locatario as lot ON lot.id = con.id_locatario
                                    INNER JOIN tb_imovel as imo ON imo.id = con.id_imovel
                                    INNER JOIN tb_status as sta ON sta.id = con.id_status
                                    INNER JOIN tb_lancamento lan ON lan.id_contrato = con.id
                                    INNER JOIN tb_mes mes ON mes.id = lan.id_mes
                                    WHERE lan.id_status = 2 AND lan.chave = ?) AS tabela
                                    ",[$chave]);

        return $result->row_array();
    }

}