<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 04/02/2018
 * Time: 10:30
 */
class Mes_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {

        $this->db->select("*")
            ->from("tb_mes")
            ->order_by("id", "ASC");

        return $this->db->get()->result_array();
    }

}