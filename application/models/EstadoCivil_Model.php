<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 17/09/2017
 * Time: 10:32
 */
class EstadoCivil_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {

        $this->db->select("*")
            ->from("tb_estado_civil")
            ->order_by("id", "ASC");

        return $this->db->get()->result_array();

    }

}