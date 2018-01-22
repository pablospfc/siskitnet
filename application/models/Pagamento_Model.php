<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 28/07/2017
 * Time: 17:04
 */
class Pagamento_Model extends CI_Model
{
    private $chave;
    public function __construct() {
        $this->load->model('Lancamento_Model', 'lancamento');
        parent::__construct();
        $this->chave = $chave = $this->session->userdata('chave');
    }

    public function getAll() {

        $this->db->select("id, nome")
            ->from("tb_pagamento")
            ->order_by("id", "ASC");

        return $this->db->get()->result_array();

    }

    public function getList() {
        $result = $this->db->query("SELECT loc.nome as locatario,
                                           mes.id as id_mes,
                                           mes.nome as mes,
                                           pag.data_pagamento as data_pagamento,
                                           pag.valor_total as valor_total,
                                           pag.periodo_inicial,
                                           pag.periodo_final,
                                           pag.valor_base,
                                           pag.id_contrato,
                                           pag.desconto,
                                           pag.id as id
                                    FROM tb_pagamento pag
                                    INNER JOIN tb_contrato con ON con.id = pag.id_contrato
                                    INNER JOIN tb_locatario loc ON loc.id = con.id_locatario
                                    INNER JOIN tb_mes mes ON mes.id = pag.id_mes
                                    WHERE pag.chave = ?
       ",[$this->chave]);
        return $result->result_array();
    }

    public function getById($id) {

        if ($id <= 0) {
            return array();
        }

        $this->select("*")
            ->from("tb_pagamento")
            ->where("id", $id);

        return $this->db->get()->result_array();
    }

    public function getRecibo($id) {
        $result = $this->db->query("SELECT loc.nome as locatario,
                                           loc.cpf as cpf,
                                           imo.numero as numero_imovel,
                                           imo.endereco as endereco_imovel,
                                           imo.complemento as complemento_imovel,
                                           imo.cep as cep_imovel,
                                           DATE_FORMAT(pag.data_pagamento, '%d/%m/%Y') as data_pagamento,
                                           pag.recibo as recibo,
                                           pag.valor_total as valor_total,
                                           DATE_FORMAT(pag.periodo_inicial, '%d/%m/%Y') as periodo_inicial,
                                           DATE_FORMAT(pag.periodo_final, '%d/%m/%Y') AS periodo_final,
                                           lod.nome as locador,
                                           lod.cpf_cnpj as cpf_cnpj_locador
                                    FROM tb_pagamento pag
                                    INNER JOIN tb_contrato con ON con.id = pag.id_contrato
                                    INNER JOIN tb_locatario loc ON loc.id = con.id_locatario
                                    INNER JOIN tb_locador lod ON lod.id = con.id_locador
                                    INNER JOIN tb_imovel imo on imo.id = con.id_imovel
                                    WHERE pag.id = {$id}
       ");
        return $result->row_array();
    }

    public function inserir($dados) {



        if (!isset($dados)) {
            $response["status"] = false;
            $response["message"] = "Dados não informados";
        } else {

            $this->db->trans_strict(TRUE);
            // definimos as regras de validação
            $this->db->trans_start();

            $dados = $this->preparaDados($dados);

            $this->db->insert("tb_pagamento",$dados);

            $dadosLancamento = [
                'id_status' => 3,
                'valor_pago' => $dados['valor_total'],
                'data_pagamento' => $dados['data_pagamento']
            ];

            $this->lancamento->atualizaPagamento($dados['id_mes'],$dados['id_contrato'],$dadosLancamento);

            $this->db->trans_complete();

                if ($this->db->trans_status() === TRUE){
                    $response['status'] = true;
                    $response['message'] = "Dados inseridos com sucesso";
                }else{
                    $error = $this->db->error();
                    $response['status'] = false;
                    $response['message'] = "Não foi possível cadastrar o pagamento. Por favor tente novamente!";
                    $this->db->insert("tb_log",['message'=>$error['message']]);
                }
            }

        return $response;

    }

    private function preparaDados($dados) {
        $data = [];
        $data['id_contrato'] = $dados['id_contrato'];
        $data['data_pagamento'] = $dados['data_pagamento'];
        $data['valor_total'] = $dados['valor_total'];
        $data['valor_base'] = $dados['valor_base'];
        $data['periodo_inicial'] = $dados['periodo_inicial'];
        $data['periodo_final'] = $dados['periodo_final'];
        $data['desconto'] = $dados['desconto'];
        $data['id_mes'] = date( 'm', strtotime( $dados['periodo_inicial'] ) );
        $data['ano'] = date( 'Y', strtotime( $dados['periodo_inicial'] ) );
        $data['recibo'] = $dados['id_contrato'].date( 'm', strtotime( '2008-10-08' ) ).date( 'Y', strtotime( '2008-10-08' ) );;
        return $data;
    }

    public function atualizar($dados, $id) {
        $response = [];
        if (!isset($dados)) {
            $response["status"] = false;
            $response["message"] = "Dados não informados";
        }else {
            $dados = $this->preparaDados($dados);

            $this->db->trans_strict(TRUE);
            // definimos as regras de validação
            $this->db->trans_start();

            $dados = $this->preparaDados($dados);

            $dadosLancamento = [
                'valor_pago' => $dados['valor_total'],
                'data_pagamento' => $dados['data_pagamento']
            ];

            $this->db->where("id", $id);

            $this->db->update('tb_pagamento', $dados);

            $this->lancamento->atualizaPagamento($dados['id_mes'],$dados['id_contrato'],$dadosLancamento);
            $this->db->trans_complete();
                if ($this->db->trans_status() === true){
                    $response['status'] = true;
                    $response['message'] = "Dados atualizados com sucesso";
                }
                else{
                    $error = $this->db->error();
                    $response['status'] = false;
                    $response['message'] = "Não foi possível atualizar o imóvel. Por favor tente novamente!";
                    $this->db->insert("tb_log",['message'=>$error['message']]);
                }

        }
        return $response;
    }

    public function remover($dados)
    {
        $this->db->trans_strict(TRUE);
        // definimos as regras de validação
        $this->db->trans_start();

        error_log(var_export($dados,true));

        $this->db->where("id", $dados['id']);

        $status = $this->db->delete('tb_pagamento');

        $dadosLancamento = [
            'valor_pago' => null,
            'data_pagamento' => null,
            'id_status' => 1,
        ];

        $this->lancamento->atualizaPagamento($dados['id_mes'],$dados['id_contrato'],$dadosLancamento);

        $this->db->trans_complete();

        if ($this->db->trans_status() === true) {
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