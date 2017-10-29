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

}