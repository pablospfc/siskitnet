<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 28/07/2017
 * Time: 17:06
 */
class Despesa_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function getAll() {

        $this->db->select("id, nome")
            ->from("tb_despesa")
            ->order_by("id", "ASC");

        return $this->db->get()->result_array();

    }

    public function getList() {
        $result = $this->db->query("SELECT des.*,
                                           tip.nome as tipo_despesa
                                    FROM tb_despesa as des
                                    INNER JOIN tb_tipo_despesa as tip ON tip.id = des.id_tipo_despesa
       ");
        return $result->result_array();
    }

    public function getById($id) {

        if ($id <= 0) {
            return array();
        }

        $this->select("*")
            ->from("tb_despesa")
            ->where("id", $id);

        return $this->db->get()->result_array();
    }

    public function inserir($dados) {

        if (!isset($dados)) {
            $response["status"] = false;
            $response["message"] = "Dados não informados";
        } else {
            $this->form_validation->set_data($dados);
            $this->form_validation->set_rules('descricao', 'descricao', 'required|min_length[2]|trim');

            if ($this->form_validation->run()==false) {
                $response['status'] = false;
                $response['message'] = validation_errors();
            }else{

                $dados = $this->preparaDados($dados);
                $partes = explode("-", $dados['data']);
                $dados['id_mes'] = (int) $partes[1];
                $dados['ano'] = (int) $partes[0];

                $status = $this->db->insert("tb_despesa",$dados);

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

    private function preparaDados($dados) {
        $data = [];
        $data['id_tipo_despesa'] = $dados['id_tipo_despesa'];
        $data['data'] = $dados['data'];
        $data['descricao'] = $dados['descricao'];
        $data['valor'] = $dados['valor'];
        return $data;
    }

    public function atualizar($dados, $id) {
        $response = [];
        if (!isset($dados)) {
            $response["status"] = false;
            $response["message"] = "Dados não informados";
        }else {
            $dados = $this->preparaDados($dados);
            $this->form_validation->set_data($dados);
            $this->form_validation->set_rules('descricao', 'descricao', 'required|min_length[2]|trim');

            if ($this->form_validation->run() == true) {
                $partes = explode("-", $dados['data']);
                $dados['id_mes'] = (int) $partes[1];
                $dados['ano'] = (int) $partes[0];
                $this->db->where("id", $id);
                $this->db->update('tb_despesa', $dados);
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

    public function remover($value)
    {
        $this->db->where("id", $value);

        $status = $this->db->delete('tb_despesa');

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