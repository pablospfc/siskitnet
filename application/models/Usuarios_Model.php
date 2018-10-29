<?php

/**
 * Created by PhpStorm.
 * User: claud
 * Date: 19/02/2018
 * Time: 14:21
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
class Usuarios_Model extends CI_Model
{
    public function __construct() {
        $this->load->model('Locador_Model', 'locador');
        parent::__construct();

        $this->load->helper(array('email'));
        $this->load->library(array('email'));
    }

    public function inserir($dados) {

        if (!isset($dados)) {
            $response["status"] = false;
            $response["message"] = "Dados não informados";
        } else {
            $this->db->trans_strict(TRUE);
            $this->db->trans_start();

                //error_log(var_export("chegou aqui", true), 3,'C:/xampp/htdocs/siskitnet/log.log');

                $idLocador = $this->locador->inserir($dados);

                $dados['id_locador'] = $idLocador;
                $dadosUsuario = $this->preparaDados($dados);
                 $this->db->insert("tb_usuario",$dadosUsuario);
                $this->db->trans_complete();
                if ($this->db->trans_status() === TRUE){
                    $response['status'] = true;
                    $response['message'] = "O seu registro foi completado com sucesso. Agora você estará apto para acessar o sistema.";
                }else{
                    $error = $this->db->error();
                    $response['status'] = false;
                    $response['message'] = "Não foi possível registrar o usuário. Por favor tente novamente!";
                    $this->db->insert("tb_log",['message'=>$error['message']]);
                }

        }

        return $response;

    }

    public function atualizarSenha($dados, $id) {
        $response = [];
        if (!isset($dados)) {
            $response["status"] = false;
            $response["message"] = "Dados não informados";
        }else {
            $dados = $this->preparaDadosAtualizacao($dados);
            $this->form_validation->set_data($dados);
            $this->form_validation->set_rules('nome', 'Nome', 'required|min_length[2]|trim');

            if ($this->form_validation->run() == true) {
                $this->db->where("id", $id);
                $this->db->update('tb_usuario', $dados);
                $afftectedRows =  $this->db->affected_rows();
                if ($afftectedRows ==  1){
                    $response['status'] = true;
                    $response['message'] = "Senha atualizada com sucesso";
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

    private function verificaSenhaAtual($senha){
        $senha = $this->session->userdata('senha');
        if ((md5($senha)) != $senha)
            return false;
    }

    private function preparaDadosAtualizacao($dados){
        $data['senha'] = md5($dados['nova_senha']);

        return $data;
    }

    public function verificarCPF($dados){
        $this->db->select('*')
            ->from('tb_usuario')
            ->where('email',$dados['email'])
            ->where('cpf',$dados['cpf']);
        $result = $this->db->get()->row_array();

        if (!empty($result) && is_array($result))
            return $this->enviarEmail($result);
            //return ['status'=>true,'message'=>'OK'];
        else
            return ['status'=> false, 'message'=> 'Não foi possível localizar seus dados no sistema. Por favor tente novamente!'];
    }

    public function getUsuarioLogado(){
        error_log(var_export($this->session->userdata(),true));
        return $this->session->userdata();
    }

    public function enviarEmail($dados){
        $response=[];
        $mail = new PHPMailer(true);
        $mail->CharSet = "UTF-8";
        $mail->IsSMTP(); //Definimos que usaremos o protocolo SMTP para envio.
        $mail->SMTPAuth = true; //Habilitamos a autenticação do SMTP. (true ou false)
        $mail->SMTPSecure = "ssl"; //Estabelecemos qual protocolo de segurança será usado.
        $mail->Host = "	br326.hostgator.com.br"; //Podemos usar o servidor do gMail para enviar.
        $mail->Port = 465; //Estabelecemos a porta utilizada pelo servidor do gMail.
        $mail->Username = "no-reply@cdsantosdumont.com.br"; //Usuário do gMail
        $mail->Password = "45enef80khs1"; //Senha do gMail
        //$mail->SMTPDebug = 1;
        $mail->SetFrom('no-reply@cdsantosdumont.com.br', 'Siskitnet - Redefinição de senha'); //Quem está enviando o e-mail.
        //$mail->AddReplyTo("response@email.com","Nome Completo"); //Para que a resposta será enviada.
        $mail->Subject = "Redefinição de senha"; //Assunto do e-mail.

        $token = $this->gerarToken($dados);
        date_default_timezone_set('America/Sao_Paulo');
        $dataExpiracao = date('Y-m-d H:i:s', strtotime('+30 minutes'));
        $this->db->insert("tb_token",['id_usuario'=>$dados['id'],'token'=>$token,'data_expiracao'=>$dataExpiracao]);
        $mail->Body = "<h2>Olá {$dados['nome']},</h2>
                        <p>Você solicitou a redefinição de senha de acesso ao Sistema de Controle de Kitnets - Siskitnet. </p>
                        <p>Você será redirecionado para uma página onde poderá definir uma nova senha.  </p>
                          <a>Clique <a href='http://siskitnet.cdsantosdumont.com.br/#redefinicaosenha?pid={$token}'>aqui</a> para redefinir a sua senha.</p>
             
                          <p>Atenciosamente</p>

                       <br />";

        $mail->AltBody = "Corpo em texto puro.";
        $destino = $dados['email'];
        $mail->AddAddress($destino, $dados['nome']);

        if($mail->Send())
        {
            $response['status'] = true;
            $response['message'] = "Foi enviado um e-mail para ".$dados['email']." com o link para redefinicao de sua senha";
        }
        else
        {
            $response['status'] = false;
            $response['message'] = "Não foi possível o envio de e-mail para redefinição de senha. Por favor entre em contato com o suporte técnico!";
        }


        return $response;

    }

    public function redefinirSenha($dados){
        if (!isset($dados)) {
            $response["status"] = false;
            $response["message"] = "Dados não informados";
        }else {

                $id = $this->getUsuarioByToken($dados['token']);

                if ($id) {
                    $this->db->where("id", $id);
                    $this->db->update('tb_usuario', ['senha' => md5($dados['senha'])]);
                    $afftectedRows = $this->db->affected_rows();
                    if ($afftectedRows == 1) {
                        $response['status'] = true;
                        $response['message'] = "A sua senha foi redefinida com sucesso!";
                    } else {
                        $error = $this->db->error();
                        $response['status'] = false;
                        $response['message'] = "Não foi possível redefinir a sua senha. Digite uma senha diferente da cadastrada no sistema e tente novamente!";
                        $this->db->insert("tb_log", ['message' => $error['message']]);
                    }
                }else
                    return [
                        'status'=> false,
                        'message'=> 'A sua sessão foi expirada. Por favor repita o processo de recuperação de senha!'
                    ];
        }

        return $response;
    }

    public function gerarToken($usuarioLogado){
        $senha = $usuarioLogado['id'].$usuarioLogado['senha'].date('Y-m-d H:i:s');
        $custo = '08';
        $salt = 'Cf1f11ePArKlBJomM0F6aJ';
        $hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');

        return $hash;
    }

    public function getUsuarioByToken($token){

        $this->db->select('*')
            ->from('tb_usuario')
            ->join('tb_token', 'tb_token.id_usuario = tb_usuario.id')
            ->where('token',$token)
            ->where('now()< tb_token.data_expiracao');
        $result = $this->db->get()->row_array();

        if (!empty($result) && is_array($result))
            return $result['id_usuario'];
        else
            return null;
    }

    public function preparaDados($dados){
        $data['id_perfil'] = 2;
        $data['id_locador'] = $dados['id_locador'];
        $data['login'] = $dados["email"];
        $data['senha'] = md5($dados["senha"]);
        $data['ativo'] = 1;
        $data['aceitou'] = $dados['aceitou'];
        $data['chave'] =md5($dados["cpf"].date('Y-m-d H:i:s'));

        return $data;
    }

}