<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 02/11/2017
 * Time: 18:14
 */
class TipoDespesa_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {

        $this->db->select("*")
            ->from("tb_tipo_despesa")
            ->order_by("id", "ASC");

        return $this->db->get()->result_array();

    }


}