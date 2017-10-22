<div class="container">
    <h1 style="margin-top: 20px">Editando Cliente</h1>
    <a class="btn btn-primary" style="margin-top: 10px;margin-bottom: 20px" href="<?php echo BASE_URL ?>/clientes">Voltar</a>
    <form id="form-cliente" method="POST" onsubmit="return validar(this)">
        <div class="form-group">
            <label><span class="obrigatorio">*</span>Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" data-alt="Nome" data-ob="0" value="<?php echo  $cliente['nome'] ?>">
        </div>
        <div class="form-group">
            <label><span class="obrigatorio">*</span>CPF/CNPJ:</label>
            <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" data-alt="CPF" data-ob="0"  value="<?php echo $cliente['cpf_cnpj'] ?>">
        </div>
        <div class="form-group">
            <label>Endereço:</label>
            <input type="text" class="form-control" id="endereco" name="endereco" data-alt="Endereço" data-ob="0"  value="<?php echo $cliente['endereco'] ?>">
        </div>
        <div class="form-group">
            <label>Bairro:</label>
            <input type="text" class="form-control" id="bairro" name="bairro" data-alt="Bairro" data-ob="0"  value="<?php echo $cliente['bairro'] ?>">
        </div>
        <div class="form-group">
            <label>CEP:</label>
            <input type="text" class="form-control" id="cep" name="cep" data-alt="CEP" data-ob="0"  value="<?php echo $cliente['cep'] ?>">
        </div>
        <div class="form-group">
            <label>Cidade:</label>
            <input type="text" class="form-control" id="cidade" name="cidade" data-alt="Cidade" data-ob="0"  value="<?php echo $cliente['cidade'] ?>">
        </div>
        <div class="form-group">
            <label>Estado:</label>
            <input type="text" class="form-control" id="estado" name="estado" data-alt="Estado" data-ob="0"  value="<?php echo $cliente['estado'] ?>">
        </div>
        <div class="form-group">
            <label>Tipo Pessoa:</label>
            <input type="text" class="form-control" id="tipo_pessoa" name="tipo_pessoa" data-alt="TipoPessoa" data-ob="0"  value="<?php echo $cliente['tipo_pessoa'] ?>">
        </div>
        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" class="form-control" id="telefone" name="telefone" data-alt="Telefone" data-ob="0"  value="<?php echo $cliente['telefone'] ?>">
        </div>
        <div class="form-group">
            <label><span class="obrigatorio">*</span>Celular:</label>
            <input type="text" class="form-control" id="celular" name="celular" data-alt="Celular" data-ob="0"  value="<?php echo $cliente['celular'] ?>">
        </div>
        <div class="form-group">
            <label><span class="obrigatorio">*</span>E-mail:</label>
            <input type="text" class="form-control" id="email" name="email" data-alt="E-mail" data-ob="0"  value="<?php echo $cliente['email'] ?>">
        </div>
        <p id="infocampos">Obs.: Campos com <label><span class="obrigatorio">*</span></label> são de preenchimento obrigatório.</p>
        <div id='retorno' style='margin-bottom: 15px;margin-top: 5px;display: none' class='alert alert-danger'>
            <ul class="list-group">
                <li class="list-group-item">
                </li>
            </ul>
        </div>
        <input type="submit" class="btn-lg btn-success" style="cursor: pointer" value="Salvar">
    </form>
</div>
<script src="<?php echo BASE_URL?>/assets/js/jquery.mask.js"></script>
