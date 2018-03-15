<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 21/01/2018
 * Time: 10:42
 */
class Indenizacao_Model extends CI_Model
{
    private $chave;

    public function __construct()
    {
        $this->chave = $this->session->userdata('chave');
        parent::__construct();
    }

    public function getAll()
    {
        $this->db->select("id, nome")
            ->from("tb_indenizacao")
            ->where('chave', $this->chave)
            ->order_by("id", "ASC");

        return $this->db->get()->result_array();

    }

    public function getList()
    {

        $result = $this->db->query("SELECT ind.*,
                                           loc.nome as locatario,
                                           mes.nome as mes
                                    FROM tb_indenizacao as ind
                                    INNER JOIN tb_locatario as loc ON loc.id = ind.id_locatario
                                    INNER JOIN tb_mes as mes ON mes.id = ind.id_mes
                                    WHERE ind.chave = ?
       ", [$this->chave]);
        return $result->result_array();
    }

    public function inserir($dados)
    {

        if (!isset($dados)) {
            $response["status"] = false;
            $response["message"] = "Dados não informados";
        } else {
            $dados = $this->preparaDados($dados);
            $this->form_validation->set_data($dados);
            $this->form_validation->set_rules('descricao', 'descricao', 'required|min_length[5]|trim');

            if ($this->form_validation->run() == false) {
                $response['status'] = false;
                $response['message'] = validation_errors();
            } else {
                $data['chave'] = $this->chave;
                $status = $this->db->insert("tb_indenizacao", $dados);

                if ($status) {
                    $response['status'] = true;
                    $response['message'] = "Dados inseridos com sucesso";
                } else {
                    $error = $this->db->error();
                    $response['status'] = false;
                    $response['message'] = "Não foi possível cadastrar a indenização. Por favor tente novamente!";
                    $this->db->insert("tb_log", ['message' => $error['message']]);
                }
            }

        }

        return $response;

    }

    public function atualizar($dados, $id)
    {
        $response = [];
        if (!isset($dados)) {
            $response["status"] = false;
            $response["message"] = "Dados não informados";
        } else {
            $dados = $this->preparaDados($dados);
            $this->form_validation->set_data($dados);
            $this->form_validation->set_rules('descricao', 'descricao', 'required|min_length[5]|trim');

            if ($this->form_validation->run() == true) {
                $this->db->where("id", $id);
                $this->db->update('tb_indenizacao', $dados);
                $afftectedRows = $this->db->affected_rows();
                if ($afftectedRows > 0) {
                    $response['status'] = true;
                    $response['message'] = "Dados atualizados com sucesso";
                } else {
                    $error = $this->db->error();
                    $response['status'] = false;
                    $response['message'] = "Não foi possível atualizar a indenização. Por favor tente novamente!";
                    $this->db->insert("tb_log", ['message' => $error['message']]);
                }
            } else {
                $response['status'] = false;
                $response['message'] = validation_errors();
            }
        }
        return $response;
    }

    private function preparaDados($dados)
    {
        $data = [];
        $data['id_locatario'] = $dados['id_locatario'];
        $data['descricao'] = $dados['descricao'];
        $data['id_mes'] = date('m', strtotime($dados['data']));;
        $data['data'] = $dados['data'];
        $data['ano'] = date('Y', strtotime($dados['data']));
        $data['chave'] = $this->chave;
        $data['valor'] = $dados['valor'];
        return $data;
    }

    public function remover($value)
    {
        $this->db->where("id", $value);

        $status = $this->db->delete('tb_indenizacao');

        if ($status) {
            $response['status'] = true;
            $response['message'] = "Indenização removida com sucesso.";
        } else {
            $error = $this->db->error();
            $response['status'] = false;
            $response['message'] = "Não foi possível remover a indenização. Por favor tente novamente";
            $this->db->insert("tb_log", ['message' => $error['message']]);
        }

        return $response;
    }


}