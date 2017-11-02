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

        $this->db->select("id, nome")
            ->from("tb_imovel")
            ->order_by("id", "ASC");

        return $this->db->get()->result_array();

    }

    public function getList() {
        $result = $this->db->query("SELECT imo.*,
                                           tip.nome as tipo_imovel
                                    FROM tb_imovel as imo
                                    INNER JOIN tb_tipo_imovel as tip ON tip.id = imo.id_tipo_imovel
       ");
        return $result->result_array();
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

    public function inserir($dados) {

        if (!isset($dados)) {
            $response["status"] = false;
            $response["message"] = "Dados não informados";
        } else {
            $this->form_validation->set_data($dados);
            $this->form_validation->set_rules('nome', 'nome', 'required|min_length[2]|trim');
            $this->form_validation->set_rules('endereco', 'endereco', 'required|min_length[5]|trim');

            if ($this->form_validation->run()==false) {
                $response['status'] = false;
                $response['message'] = validation_errors();
            }else{
                $status = $this->db->insert("tb_imovel",$dados);

                if ($status){
                    $response['status'] = true;
                    $response['message'] = "Dados inseridos com sucesso";
                }else{
                    $error = $this->db->error();
                    $response['status'] = false;
                    $response['message'] = "Não foi possível cadastrar o imóvel. Por favor tente novamente!";
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
            $dados = $this->preparaDados($dados);
            $this->form_validation->set_data($dados);
            $this->form_validation->set_rules('nome', 'nome', 'required|min_length[2]|trim');
            $this->form_validation->set_rules('endereco', 'endereco', 'required|min_length[5]|trim');

            if ($this->form_validation->run() == true) {
                $this->db->where("id", $id);
                $this->db->update('tb_imovel', $dados);
                $afftectedRows =  $this->db->affected_rows();
                if ($afftectedRows > 0){
                    $response['status'] = true;
                    $response['message'] = "Dados atualizados com sucesso";
                }
                else{
                    $error = $this->db->error();
                    $response['status'] = false;
                    $response['message'] = "Não foi possível atualizar o imóvel. Por favor tente novamente!";
                    $this->db->insert("tb_log",['message'=>$error['message']]);
                }
            } else {
                $response['status'] = false;
                $response['message'] = validation_errors();
            }
        }
        return $response;
    }

    private function preparaDados($dados) {
        $data = [];
        $data['nome'] = $dados['nome'];
        $data['id_tipo_imovel'] = $dados['id_tipo_imovel'];
        $data['uc'] = $dados['uc'];
        $data['endereco'] = $dados['endereco'];
        $data['numero'] = $dados['numero'];
        return $data;
    }

    public function remover($value)
    {
        $this->db->where("id", $value);

        $status = $this->db->delete('tb_imovel');

        if ($status) {
            $response['status'] = true;
            $response['message'] = "Locatário removido com sucesso.";
        } else {
            $error = $this->db->error();
            $response['status'] = false;
            $response['message'] = "Não foi possível remover o imóvel. Por favor tente novamente";
            $this->db->insert("tb_log",['message'=>$error['message']]);
        }

        return $response;
    }

}