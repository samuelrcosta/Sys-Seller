<div class="Container">
    <a style="margin-top: 20px;margin-bottom: 20px; float: right;" class="btn btn-success" href='<?php echo BASE_URL ?>/clientes/cadastrar/'>Cadastrar Cliente</a>
    <table class="table table-bordered table-tripped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF/CNPJ</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Celular</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente):?>
            <tr>
                <td><?php echo $cliente['id'] ?></td>
                <td><?php echo $cliente['nome'] ?></td>
                <td><?php echo $cliente['cpf_cnpj'] ?></td>
                <td><?php echo $cliente['email'] ?></td>
                <td><?php echo $cliente['telefone'] ?></td>
                <td><?php echo $cliente['celular'] ?></td>
                <td><a class="btn btn-info" href='<?php echo BASE_URL ?>/clientes/editar/<?php echo base64_encode(base64_encode($cliente['id'])) ?>'>Editar</a> <button class="btn btn-danger" onclick="exCliente()">Excluir</button></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<div id="fundo-escuro" style="display: none"></div>
<div id="confirmacao-exclusao" style="display: none">
    <p>Tem certeza que deseja excluir o registro do cliente?</p>
    <a class="btn btn-danger" href='<?php echo BASE_URL ?>/clientes/excluir/<?php echo base64_encode(base64_encode($cliente['id'])) ?>'>Sim</a>
    <button class="btn btn-success" onclick="nexcluir()">Não</button>
</div>

<script>
    function exCliente(){
        $("#fundo-escuro").show();
        $("#confirmacao-exclusao").show('fast');
    }
    function nexcluir() {
        $("#confirmacao-exclusao").hide('fast');
        $("#fundo-escuro").hide();
    }
</script>
