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

    public function insert($dados) {
//       if (!isset($dados)) {
//           $response["status"] = false;
//           $response["message"] = "Dados não informados";
//       } else {
//
//           $this->form_validation->set_data($dados);
//           // definimos as regras de validação
//           $this->form_validation->set_rules('nome','Nome','required|min_length[2]|trim');
//           $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[tb_locatarios.email]|trim');
//
//           if ($this->form_validation->run()==false) {
//               $response["status"] = false;
//               $response["message"] = validation_errors();
//           }else{
//               $status = $this->db->insert($dados);
//
//               if ($status){
//                   $response["status"] = true;
//                   $response["message"] = "Dados inseridos com sucesso";
//               }else{
//                   $response['status'] = false;
//                   $response['message'] = "Erro ao inserir os dados, tente novamente";
//               }
//           }
//        }
//      return $response;

        try {

           $this->form_validation->set_data($dados);
           $this->form_validation->set_rules('nome','Nome','required|min_length[2]|trim');
           $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[tb_locatarios.email]|trim');
            if ($this->form_validation->run()==true) {
                $id = $this->db->insert($dados);
                return [
                    'id' => $id,
                    'message' => "Dados inseridos com sucesso!"
                ];
            }else
                return [
                    'message' => validation_errors()
                ];

        }catch(Exception $e) {
            throw new Exception("Não foi possível cadastrar o locatário. Por favor tente novamente.");
        }

    }

    public function update($dados, $id) {

        try {
            $this->form_validation->set_data($dados);
            $this->form_validation->set_rules('nome','Nome','required|min_length[2]|trim');
            $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[tb_locatarios.email]|trim');

            if ($this->form_validation->run()==true) {
                $this->db->where("id", $id);
                $this->db->update('tb_locatario', $dados);
                return [
                    'message' => "Dados atualizados com sucesso!"
                ];
            }else
                return [
                    'message' => validation_errors()
                ];

        }catch(Exception $e) {
            throw new Exception("Não foi possível atualizar o locatário. Por favor, tente novamente!");
        }

    }

    public function delete($field, $value) {

        try {
            $this->db->where($field, $value);

            $this->db->delete('tb_locatario');

            return [
                'message' => "Registro removido com sucesso!"
            ];
        }catch(Exception $e) {
            throw new Exception("Não foi possível remover o locatário. Por favor tente novamente");
        }

    }


}