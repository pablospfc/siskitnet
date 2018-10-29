<?php
/**
 * Created by PhpStorm.
 * User: claud
 * Date: 30/03/2018
 * Time: 15:06
 */

class Locador_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function inserir($dados) {
        $dados = $this->preparaDados($dados);
         $this->db->insert("tb_locador",$dados);
         return $this->db->insert_id();
    }

    public function preparaDados($dados){
        $data['nome'] = $dados['nome'];
        $data['cpf'] = $dados["cpf"];
        $data['email'] = $dados["email"];
        $data['telefone'] = $dados["telefone"];
        return $data;
    }

}