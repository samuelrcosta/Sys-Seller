<div class="Container">
    <form method="POST" action="<?php echo BASE_URL ?>/pedidos">
        <input style="margin: 5px" placeholder="Busque um pedido..." type="text" class="form-control" id="busca" name="busca" value="<?=$termo;?>">
    </form>
    <a style="margin-top: 20px;margin-bottom: 20px; float: right;" class="btn btn-success" href='<?php echo BASE_URL ?>/pedidos/novo/'>Novo Pedido</a>
    <table class="table table-bordered table-tripped">
        <thead>
            <tr>
                <th>Número</th>
                <th>Cliente</th>
                <th>Pagamento</th>
                <th>Itens</th>
                <th>Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedidos as $pedido):?>
            <tr>
                <td><?php echo $pedido['id'] ?></td>
                <td><?php echo $pedido['cliente'] ?></td>
                <td><?php if($pedido['tipo_pagamento'] == 1) echo "Dinheiro"; elseif ($pedido['tipo_pagamento'] == 2) echo "Cartão de Crédito"; elseif ($pedido['tipo_pagamento'] == 3) echo "Cartão de Débito"; else echo "Cheque" ?></td>
                <td><?php echo $pedido['produtos'] ?></td>
                <td>R$ <?php echo str_replace("/", ",", str_replace(",", ".", str_replace(".","/", number_format($pedido['total'], 2)))) ?></td>
                <td><a class="btn btn-info" href='<?php echo BASE_URL ?>/pedidos/editar/<?php echo base64_encode(base64_encode($pedido['id'])) ?>'>Editar</a> <button class="btn btn-danger" onclick="exPedido('<?php echo base64_encode(base64_encode($pedido['id'])) ?>')">Excluir</button></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<div id="fundo-escuro" style="display: none"></div>
<div id="confirmacao-exclusao" style="display: none">
    <p>Tem certeza que deseja excluir o pedido?</p>
    <button class="btn btn-danger" onclick="sexcluir()">Sim</button>
    <button class="btn btn-success" onclick="nexcluir()">Não</button>
</div>
<script>
    var idUsu;
    function exPedido(id){
        $("#fundo-escuro").show();
        $("#confirmacao-exclusao").show('fast');
        idUsu = id;
    }
    function nexcluir() {
        $("#confirmacao-exclusao").hide('fast');
        $("#fundo-escuro").hide();
    }

    function sexcluir(){
        window.location.href = '<?php echo BASE_URL ?>/pedidos/excluir/' + idUsu;
    }
</script>
