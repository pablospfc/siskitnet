<?php
/**
 * Created by PhpStorm.
 * User: claud
 * Date: 24/03/2018
 * Time: 16:36
 */

class Proprietario_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function getDadosProprietario(){
        $chave = $this->session->userdata('chave');
        $query = "SELECT loc.* 
                  FROM tb_locador loc
                  INNER JOIN tb_usuario usu ON usu.id_locador = loc.id
                  WHERE usu.chave = '{$chave}'";
        $result = $this->db->query($query);

        return $result->result_array();
    }

    public function inserir($dados) {
        if (!isset($dados)) {
            $response["status"] = false;
            $response["message"] = "Dados não informados";
        } else {
            $dados = $this->preparaDados($dados);
            $this->form_validation->set_data($dados);
            // definimos as regras de validação
            $this->form_validation->set_rules('nome','nome','required|min_length[2]|trim');

            if ($this->form_validation->run()==false) {
                $response['status'] = false;
                $response['message'] = validation_errors();
            }else{
                $status = $this->db->insert("tb_proprietario",$dados);

                if ($status){
                    $response['status'] = true;
                    $response['message'] = "Cadastro realizado com sucesso.";
                }else{
                    $error = $this->db->error();
                    $response['status'] = false;
                    $response['message'] = "Não foi possível registrar os dados do proprietário. Por favor tente novamente!";
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
                $this->db->update('tb_locador', $dados);
                $afftectedRows =  $this->db->affected_rows();
                if ($afftectedRows ==  1){
                    $response['status'] = true;
                    $response['message'] = "Dados atualizados com sucesso";
                }
                else{
                    $error = $this->db->error();
                    $response['status'] = false;
                    $response['message'] = "Não foi possível atualizar os seus dados. Por favor tente novamente!";
                    $this->db->insert("tb_log",['message'=>$error['message']]);
                }
            } else {
                $response['status'] = false;
                $response['message'] = validation_errors();
            }
        }

        return $response;
    }

}