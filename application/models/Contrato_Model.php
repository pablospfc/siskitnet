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
        parent::__construct();
    }

    public function getAll() {
        $this->db->select("*")
            ->from("tb_contrato");

        return $this->db->get()->result_array();
    }

}