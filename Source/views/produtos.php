<div class="Container">
    <a style="margin-top: 20px;margin-bottom: 20px; float: right;" class="btn btn-success" href='<?php echo BASE_URL ?>/produtos/cadastrar/'>Cadastrar Produto</a>
    <table class="table table-bordered table-tripped">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto):?>
            <tr>
                <td><?php echo $produto['codigo'] ?></td>
                <td><?php echo $produto['nome'] ?></td>
                <td><?php echo $produto['categoria'] ?></td>
                <td><pre style="margin-bottom: 0"><?php echo $produto['descricao'] ?></pre></td>
                <td>R$ <?php echo str_replace(".", ",", $produto['preco'])?></td>
                <td><a class="btn btn-info" href='<?php echo BASE_URL ?>/produtos/editar/<?php echo base64_encode(base64_encode($produto['id'])) ?>'>Editar</a> <button class="btn btn-danger" onclick="exProduto('<?php echo base64_encode(base64_encode($produto['id'])) ?>')">Excluir</button></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<div id="fundo-escuro" style="display: none"></div>
<div id="confirmacao-exclusao" style="display: none">
    <p>Tem certeza que deseja excluir o produto?</p>
    <button class="btn btn-danger" onclick="sexcluir()">Sim</button>
    <button class="btn btn-success" onclick="nexcluir()">Não</button>
</div>
<script>
    var idUsu;
    function exProduto(id){
        $("#fundo-escuro").show();
        $("#confirmacao-exclusao").show('fast');
        idUsu = id;
    }
    function nexcluir() {
        $("#confirmacao-exclusao").hide('fast');
        $("#fundo-escuro").hide();
    }

    function sexcluir(){
        window.location.href = '<?php echo BASE_URL ?>/produtos/excluir/' + idUsu;
    }
</script>
