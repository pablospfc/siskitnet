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
        return $this->db->insert("tb_lancamento",$dados);
    }

}