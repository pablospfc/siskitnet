<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: claud
 * Date: 26/03/2017
 * Time: 15:46
 */
class Locatario_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {

            $this->db->select("*")
                ->from("tb_locatario")
                ->order_by("nome", "ASC");

            return $this->db->get()->result_array();

    }

    public function getById($id) {

        if ($id <= 0) {
            return array();
        }

        $this->select("*")
            ->from("tb_locatario")
            ->where("id", $id);

        return $this->db->get()->result_array();
    }

    public function inserir($dados) {
       if (!isset($dados)) {
           $response["status"] = false;
           $response["message"] = "Dados não informados";
       } else {

           $this->form_validation->set_data($dados);
           // definimos as regras de validação
           $this->form_validation->set_rules('nome','nome','required|min_length[2]|trim');
           $this->form_validation->set_rules('email','email','required|valid_email|is_unique[tb_locatario.email]|trim');

           if ($this->form_validation->run()==false) {
               $response["status"] = false;
               $response["message"] = validation_errors();
           }else{
               $status = $this->db->insert("tb_locatario",$dados);

               if ($status){
                   $response["status"] = true;
                   $response["message"] = "Dados inseridos com sucesso";
               }else{
                   $error = $this->db->error();
                   $response['status'] = false;
                   $response['message'] = "Não foi possível cadastrar o locatário. Por favor tente novamente!";
                   $this->db->insert("tb_log",['message'=>$error['message']]);
               }
           }
        }

      return $response;

    }

    public function atualizar($dados, $id) {
        if (!isset($dados)) {
            $response["status"] = false;
            $response["message"] = "Dados não informados";
        }else {
            $this->form_validation->set_data($dados);
            $this->form_validation->set_rules('nome', 'Nome', 'required|min_length[2]|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tb_locatarios.email]|trim');

            if ($this->form_validation->run() == true) {
                $this->db->where("id", $id);
                $this->db->update('tb_locatario', $dados);
                $afftectedRows =  $this->db->affected_rows();
                if ($afftectedRows ==  1){
                    $response["status"] = true;
                    $response["message"] = "Dados atualizados com sucesso";
                }
                else{
                    $error = $this->db->error();
                    $response['status'] = false;
                    $response['message'] = "Não foi possível atualizar o locatário. Por favor tente novamente!";
                    $this->db->insert("tb_log",['message'=>$error['message']]);
                }
            } else
                $response['status'] = false;
                $response["message"] = validation_errors();
        }

        return $response;
    }

    public function remover($value)
    {
        $this->db->where("id", $value);

        $status = $this->db->delete('tb_locatario');

        if ($status) {
            $response['status'] = true;
            $response['message'] = "Locatário removido com sucesso.";
        } else {
            $error = $this->db->error();
            $response['status'] = false;
            $response['message'] = "Não foi possível remover o locatário. Por favor tente novamente";
            $this->db->insert("tb_log",['message'=>$error['message']]);
        }

        return $response;

    }
}