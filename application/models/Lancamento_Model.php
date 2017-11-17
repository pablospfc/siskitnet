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
        if ($idContrato <= 0) {
            return array();
        }

        $this->db->select("*")
            ->from("tb_lancamento")
            ->where("id_contrato", $idContrato)
            ->where("id_status <>", 3);

        return $this->db->get()->result_array();
    }

    public function atualizaPagamento($mes, $contrato, $dados) {
        $this->db->where("id_mes", $mes);
        $this->db->where("id_contrato", $contrato);
        return $this->db->update('tb_lancamento', $dados);
    }

    public function getAlugueisMes(){
        $result = $this->db->query("SELECT
                                           loc.nome as locatario,
                                           loc.cpf as cpf,
                                           lan.ano as ano,
                                           lan.data_vencimento,
                                           mes.nome as mes,
                                           con.valor,
                                           imo.nome as imovel,
                                           sta.nome as status
                                    FROM tb_contrato as con
                                    INNER JOIN tb_locatario as loc ON loc.id = con.id_locatario
                                    INNER JOIN tb_imovel as imo ON imo.id = con.id_imovel
                                    INNER JOIN tb_status as sta ON sta.id = con.id_status
                                    INNER JOIN tb_lancamento lan ON lan.id_contrato = con.id
                                    INNER JOIN tb_mes mes ON mes.id = lan.id_mes
                                    WHERE YEAR(lan.data_vencimento) = YEAR(now()) 
                                    AND MONTH(lan.data_vencimento) =  MONTH(now());");

        return $result->result_array();
    }

    public function getQtdAlugueisMes(){
        $result = $this->db->query("SELECT COUNT(*) as quantidade  FROM 
                                        (SELECT
                                           loc.nome as locatario,
                                           loc.cpf as cpf,
                                           lan.ano as ano,
                                           lan.data_vencimento,
                                           mes.nome as mes,
                                           con.valor,
                                           imo.nome as imovel,
                                           sta.nome as status
                                    FROM tb_contrato as con
                                    INNER JOIN tb_locatario as loc ON loc.id = con.id_locatario
                                    INNER JOIN tb_imovel as imo ON imo.id = con.id_imovel
                                    INNER JOIN tb_status as sta ON sta.id = con.id_status
                                    INNER JOIN tb_lancamento lan ON lan.id_contrato = con.id
                                    INNER JOIN tb_mes mes ON mes.id = lan.id_mes
                                    WHERE YEAR(lan.data_vencimento) = YEAR(now()) 
                                    AND MONTH(lan.data_vencimento) =  MONTH(now())) as tabela;");

         return $result->row_array();
    }

    public function getAlugueisAtrasados() {
        $result = $this->db->query("SELECT
                                           loc.nome as locatario,
                                           loc.cpf as cpf,
                                           lan.ano as ano,
                                           lan.data_vencimento,
                                           mes.nome as mes,
                                           con.valor,
                                           imo.nome as imovel,
                                           sta.nome as status
                                    FROM tb_contrato as con
                                    INNER JOIN tb_locatario as loc ON loc.id = con.id_locatario
                                    INNER JOIN tb_imovel as imo ON imo.id = con.id_imovel
                                    INNER JOIN tb_status as sta ON sta.id = con.id_status
                                    INNER JOIN tb_lancamento lan ON lan.id_contrato = con.id
                                    INNER JOIN tb_mes mes ON mes.id = lan.id_mes
                                    WHERE sta.id = 2
                                    ");

        return $result->result_array();
    }

    public function getQtdAlugueisAtrasados() {
        $result = $this->db->query("SELECT COUNT(*) AS quantidade FROM
                                          (SELECT
                                           loc.nome as locatario,
                                           loc.cpf as cpf,
                                           lan.ano as ano,
                                           lan.data_vencimento,
                                           mes.nome as mes,
                                           con.valor,
                                           imo.nome as imovel,
                                           sta.nome as status
                                    FROM tb_contrato as con
                                    INNER JOIN tb_locatario as loc ON loc.id = con.id_locatario
                                    INNER JOIN tb_imovel as imo ON imo.id = con.id_imovel
                                    INNER JOIN tb_status as sta ON sta.id = con.id_status
                                    INNER JOIN tb_lancamento lan ON lan.id_contrato = con.id
                                    INNER JOIN tb_mes mes ON mes.id = lan.id_mes
                                    WHERE sta.id = 2) AS tabela
                                    ");

        return $result->row_array();
    }

}