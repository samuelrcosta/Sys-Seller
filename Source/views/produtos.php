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
                <th><?php echo $produto['descricao'] ?></th>
                <th>R$ <?php echo str_replace(".", ",", $produto['preco'])?></th>
                <th><a class="btn btn-info" href='<?php echo BASE_URL ?>/produtos/editar/<?php echo base64_encode(base64_encode($produto['id'])) ?>'>Editar</a> <a class="btn btn-danger" href='<?php echo BASE_URL ?>/produtos/excluir/<?php echo base64_encode(base64_encode($produto['id'])) ?>'>Excluir</a></th>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>