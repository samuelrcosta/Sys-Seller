<div class="Container">
    <a style="margin-top: 20px;margin-bottom: 20px" class="btn btn-success" href='<?php echo BASE_URL ?>/produtos/cadastrar/'>+ Cadastrar Produto</a>
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
                <th><?php echo $produto['codigo'] ?></th>
                <th><?php echo $produto['nome'] ?></th>
                <th><?php echo $produto['categoria'] ?></th>
                <th><pre style="margin-bottom: 0"><?php echo $produto['descricao'] ?></pre></th>
                <th>R$ <?php echo str_replace(".", ",", $produto['preco'])?></th>
                <th><a class="btn btn-info" href='<?php echo BASE_URL ?>/produtos/editar/<?php echo base64_encode(base64_encode($produto['id'])) ?>'>Editar</a> <button class="btn btn-danger" onclick="exProduto()">Excluir</button></th>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<div id="fundo-escuro" style="display: none"></div>
<div id="confirmacao-exclusao" style="display: none">
    <p>Tem certeza que deseja excluir o produto?</p>
    <a class="btn btn-danger" href='<?php echo BASE_URL ?>/produtos/excluir/<?php echo base64_encode(base64_encode($produto['id'])) ?>'>Sim</a>
    <button class="btn btn-success" onclick="nexcluir()">Não</button>
</div>

<script>
    function exProduto(){
        $("#fundo-escuro").show();
        $("#confirmacao-exclusao").show('fast');
    }
    function nexcluir() {
        $("#confirmacao-exclusao").hide('fast');
        $("#fundo-escuro").hide();
    }
</script>