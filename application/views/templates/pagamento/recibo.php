<p>RECIBO DE ALUGUEL</p>

<p>Data: <b><?php echo $dados['data_pagamento'] ?></b> Recibo de Aluguel nº: <b><?php echo $dados['recibo'] ?></b></p>

<p>Nome do Inquilino: <b><?php echo $dados['locatario'] ?></b></p>

<p>Endereço da Propriedade: <?php echo $dados['endereco_imovel'] ?>, Quitinete <b><?php echo $dados['numero_imovel'] ?></b>, <?php echo $dados['complemento_imovel']?>, CEP – <?php echo $dados['cep_imovel']?>.</p>

<p>Recebi do Sr./Sra. <b><?php echo $dados['locatario'] ?></b>, inscrito no CPF sob o <b><?php echo $dados['cpf']; ?></b> a soma de <b>R$ <?php echo number_format($dados['valor_total'], 2, ',', '.') ?></b>(<b><?php echo $dados['valor_total_extenso'] ?></b>) como forma de pagamento de aluguel Residencial do imóvel descrito acima, para o período de <?php echo $dados['periodo_inicial'] ?> a  <?php echo $dados['periodo_final'] ?></p>

<p>Recebido por: <b><?php echo $dados['locador'] ?></b> CPF nº: <b><?php echo $dados['cpf_cnpj_locador'] ?></b></p>

<p>Em sua capacidade como: <b>LOCATARIO</b></p>

<p>___________________________________</p>

<p>Assinatura do Proprietário, Locador ou Responsável</p>
