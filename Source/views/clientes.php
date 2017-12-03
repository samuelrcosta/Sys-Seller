<div class="Container">
    <form method="POST" action="<?php echo BASE_URL ?>/clientes">
        <input style="margin: 5px" placeholder="Busque um cliente..." type="text" class="form-control" id="busca" name="busca" value="<?=$termo;?>">
    </form>
    <a style="margin-top: 20px;margin-bottom: 20px; float: right;" class="btn btn-success" href='<?php echo BASE_URL ?>/clientes/cadastrar/'>Cadastrar Cliente</a>
    <table class="table table-bordered table-tripped">
        <thead>
            <tr>
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
                <td><?php echo $cliente['nome'] ?></td>
                <td><?php echo $cliente['cpf_cnpj'] ?></td>
                <td><?php echo $cliente['email'] ?></td>
                <td><?php echo $cliente['telefone'] ?></td>
                <td><?php echo $cliente['celular'] ?></td>
                <td><a class="btn btn-info" href='<?php echo BASE_URL ?>/clientes/editar/<?php echo base64_encode(base64_encode($cliente['id'])) ?>'>Editar</a> <button class="btn btn-danger" onclick="exCliente('<?php echo base64_encode(base64_encode($cliente['id'])) ?>')">Excluir</button></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<div id="fundo-escuro" style="display: none"></div>
<div id="confirmacao-exclusao" style="display: none">
    <p>Tem certeza que deseja excluir o cliente?</p>
    <button class="btn btn-danger" onclick="sexcluir()">Sim</button>
    <button class="btn btn-success" onclick="nexcluir()">Não</button>
</div>
<script>
    var idUsu;
    function exCliente(id){
        $("#fundo-escuro").show();
        $("#confirmacao-exclusao").show('fast');
        idUsu = id;
    }
    function nexcluir() {
        $("#confirmacao-exclusao").hide('fast');
        $("#fundo-escuro").hide();
    }

    function sexcluir(){
        window.location.href = '<?php echo BASE_URL ?>/clientes/excluir/' + idUsu;
    }
</script>
