<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: claud
 * Date: 26/03/2017
 * Time: 15:46
 */
class Locatario_Model extends CI_Model
{
    private $chave;
    private $tabela;
    public function __construct() {
        parent::__construct();
        $this->chave = $this->session->userdata('chave');
        $this->id_usuario = $this->session->userdata('id');
        $this->tabela = "tb_locatario";
    }

    public function getAll() {

            $this->db->select("*")
                ->from($this->tabela)
                ->where("chave", $this->chave)
                ->order_by("nome", "ASC");

            return $this->db->get()->result_array();

    }

    public function getById($id) {

        if ($id <= 0) {
            return array();
        }

        $this->select("*")
            ->from($this->tabela)
            ->where("id", $id);

        return $this->db->get()->result_array();
    }

    public function inserir($dados) {
       if (!isset($dados)) {
           $response["status"] = false;
           $response["message"] = "Dados não informados";
       } else {
           $dados['chave'] = $this->chave;
           $this->form_validation->set_data($dados);
           // definimos as regras de validação
           $this->form_validation->set_rules('nome','nome','required|min_length[2]|trim');
           $this->form_validation->set_rules('email','email','required|valid_email|is_unique[tb_locatario.email]|trim');
          // $this->form_validation->set_rules('cpf', 'cpf', 'valid_cpf');


           if ($this->form_validation->run()==false) {
               $response['status'] = false;
               $response['message'] = validation_errors();
           }else{
               $status = $this->db->insert($this->tabela,$dados);

               if ($status){
                   $response['status'] = true;
                   $response['message'] = "Dados inseridos com sucesso";
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
        $response = [];
        if (!isset($dados)) {
            $response["status"] = false;
            $response["message"] = "Dados não informados";
        }else {
            $this->form_validation->set_data($dados);
            $this->form_validation->set_rules('nome', 'Nome', 'required|min_length[2]|trim');

            if ($this->form_validation->run() == true) {
                $this->db->where("id", $id);
                $this->db->update($this->tabela, $dados);
                $afftectedRows =  $this->db->affected_rows();
                if ($afftectedRows ==  1){
                    $response['status'] = true;
                    $response['message'] = "Dados atualizados com sucesso";
                }
                else{
                    $error = $this->db->error();
                    $response['status'] = false;
                    $response['message'] = "Não foi possível atualizar o locatário. Por favor tente novamente!";
                    $this->db->insert("tb_log",['message'=>$error['message']]);
                }
            } else {
                $response['status'] = false;
                $response['message'] = validation_errors();
            }
        }

        return $response;
    }

    public function remover($value)
    {
        $this->db->where("id", $value);

        $status = $this->db->delete($this->tabela);

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