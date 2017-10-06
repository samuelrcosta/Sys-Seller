<div class="Container">
    <button class="btn btn-success" onclick="window.href='<?php echo BASE_URL ?>/produtos/cadastrar/'">Cadastrar Produto</button>
    <table class="table table-responsive table-tripped">
        <thead>
            <tr>
              <th>Código</th>
              <th>Nome</th>
              <th>Categoria</th>
              <th>Descrição</th>
              <th>Preço</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto):?>
            <tr>
                <th><?php echo $produto['codigo'] ?></th>
                <th><?php echo $produto['nome'] ?></th>
                <th><?php echo $produto['categoria'] ?></th>
                <th><?php echo $produto['descricao'] ?></th>
                <th><?php echo $produto['preco'] ?></th>
                <th><button class="btn btn-info" onclick="window.href='<?php echo BASE_URL ?>/produtos/editar/<?php echo base64encode(base64encode($produto['id'])) ?>'">Editar</button><button class="btn btn-danger" onclick="window.href='<?php echo BASE_URL ?>/produtos/excluir/<?php echo base64encode(base64encode($produto['id'])) ?>'">Excluir</button></th>
            </tr>
            <?php endforeach;?>>
        </tbody>
    </table>
</div>