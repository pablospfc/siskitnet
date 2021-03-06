<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 01/12/2017
 * Time: 20:45
 */
class Login_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }

    public function getLogin($dados){
        $this->db->select('usu.*, loc.*')
            ->from('tb_usuario as usu')
            ->join('tb_locador as loc', 'loc.id = usu.id_locador')
            ->where('login',$dados['email'])
            ->where('senha',md5($dados['senha']));
        $dadosLogin = $this->db->get()->result_array();

        if (!empty($dadosLogin) && is_array($dadosLogin))
            return ['data'=> $dadosLogin, 'status'=> true];
        else
            return ['status'=> false, 'message'=> 'Não foi possível realizar o seu login no sistema. Por favor tente novamente!'];
    }




}