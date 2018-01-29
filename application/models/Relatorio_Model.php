<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 07/01/2018
 * Time: 11:57
 */
class Relatorio_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getRelatorioDespesas($ano, $mes, $tipo){
        $where = "";
        $bind = [];
        if ($ano != null){
            $where = "des.ano = %d";
            $bind[] = $ano;
        }

        if ($mes != null){
            $where = " AND mes.id = %d";
            $bind[] = $mes;
        }

        if ($tipo != null){
            $where = " AND tip.id = %d";
            $bind[] = $tipo;
        }

        $query = "SELECT
                          des.data as data,
                          des.descricao as descricao,
                          des.valor as valor,
                          des.ano as ano,
                          mes.nome as mes,
                          tip.nome as tipo_despesa
                    FROM tb_despesa des
                    INNER JOIN tb_mes mes ON mes.id = des.id_mes
                    INNER JOIN tb_tipo_despesa tip ON tip.id = des.id_tipo_despesa
                    ";

        $result = $this->db->query($query.$where,$bind);

        return $result->result_array();

    }

    public function getRelatorioAlugueis($mes,$ano){
      
    }

    public function getRelatorioIndenizacoes($mes,$ano){

    }

}