<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 28/07/2017
 * Time: 16:53
 */
class Imovel_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $this->db->select("*")
            ->from("tb_imovel")
            //->where("disponivel", 1)
            ->order_by("id", "ASC");

        return $this->db->get()->result_array();
    }

    public function getById($id) {

        if ($id <= 0) {
            return array();
        }

        $this->select("*")
            ->from("tb_imovel")
            ->where("id", $id);

        return $this->db->get()->result_array();
    }

    public function insert($dados) {

        try {

            $this->form_validation->set_data($dados);
            $this->form_validation->set_rules('nome','Nome','required|min_length[2]|trim');
            $this->form_validation->set_rules('endereco','Endereco','required|min_length[25]|trim');

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
            throw new Exception("Não foi possível cadastrar o imóvel. Por favor tente novamente.");
        }

    }

    public function update($dados, $id) {

        try {
            $this->form_validation->set_data($dados);
            $this->form_validation->set_rules('nome','Nome','required|min_length[2]|trim');
            $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[tb_locatarios.email]|trim');

            if ($this->form_validation->run()==true) {
                $this->db->where("id", $id);
                $this->db->update('tb_imovel', $dados);
                return [
                    'message' => "Dados atualizados com sucesso!"
                ];
            }else
                return [
                    'message' => validation_errors()
                ];

        }catch(Exception $e) {
            throw new Exception("Não foi possível atualizar o imóvel. Por favor, tente novamente!");
        }

    }

    public function delete($field, $value) {

        try {
            $this->db->where($field, $value);

            $this->db->delete('tb_imovel');

            return [
                'message' => "Registro removido com sucesso!"
            ];
        }catch(Exception $e) {
            throw new Exception("Não foi possível remover o imóvel. Por favor tente novamente");
        }

    }

}