<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 29/10/2017
 * Time: 15:49
 */
class TipoImovel_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {

        $this->db->select("*")
            ->from("tb_tipo_imovel")
            ->order_by("id", "ASC");

        return $this->db->get()->result_array();

    }


}