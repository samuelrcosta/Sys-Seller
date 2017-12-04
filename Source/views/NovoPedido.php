<div class="container">
    <h1 style="margin-top: 20px">Novo Pedido</h1>
    <a class="btn btn-primary" style="margin-top: -40px;margin-bottom: 0px; float: right;" href="<?php echo BASE_URL ?>/pedidos">Voltar</a>
    <form id="form-pedido" method="POST" onsubmit="return validar(this)">
        <div class="form-group">
            <label><span class="obrigatorio">*</span>Cliente:</label>
            <select class="form-control" id="nome" name="nome" data-alt="Cliente" data-ob="1">
            <?php foreach ($clientes as $cliente):?>
                <option value="<?=$cliente['id'];?>"><?=$cliente['nome'];?></option>
            <?php endforeach;?>
           </select>
        </div>
        <div class="form-group">
            <table width="100%" cellpadding="10">
                <tr>
                    <td width="50%">
                        <label>Tipo de Pagamento</label>
                        <select class="form-control" id="tipo_pagamento" name="tipo_pagamento" data-alt="Tipo de Pagamento" data-ob="1">
                            <option value="1">Dinheiro</option>
                            <option value="2">Cartão de Crédito</option>
                            <option value="3">Cartão de Débito</option>
                            <option value="4">Cheque</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Produtos:</label>
                        <input style="margin-bottom: 15px" placeholder="Busque um produto..." type="text" class="form-control" id="pesquisa" onkeyup="pesquisar()">
                        <div class="listaProduto busca">

                        </div>
                    </td>
                    <td>
                        <label><strong>Total: R$ <span id="total">0.00</span></strong></label>
                        <div class="listaProduto carrinho" style="height: 350px;">

                        </div>
                    </td>
                </tr>
            </table>

            <input id="lista" name="lista" type="hidden" value="" />
        </div>
        <p id="infocampos">Obs.: Campos com <label><span class="obrigatorio">*</span></label> são de preenchimento obrigatório.</p>
        <div id="retorno" style="margin-bottom: 15px">
            <div id='retorno' style='margin-bottom: 15px;margin-top: 5px;display: none' class='alert alert-danger'>
                <ul class="list-group">
                    <li class="list-group-item">
                    </li>
                </ul>
            </div>
        </div>
        <input type="submit" class="btn-lg btn-success" style="cursor: pointer" value="Cadastrar">
    </form>
</div>
<script>
window.onload = function () {
    inserirProdutos();
}

var ListaDeProdutos = <?php echo json_encode($produtos) ?>;

function inserirProdutos(){
    for(i = 0; i < ListaDeProdutos.length; i++){
        $(".busca").append("<div class='lProduto' pid='"+ ListaDeProdutos[i].id + "'> " +
            "<span id='nome'>" + ListaDeProdutos[i].nome + "</span>" +
            "<span id='preco'>R$ " + Number(ListaDeProdutos[i].preco).toFixed(2) + "</span>" +
            "<a class='btn btn-success add'>+</a>" +
            "</div>");
    }
}

function pesquisar(){
    if($("#pesquisa").val() == ''){
        $(".busca").html('');
        inserirProdutos();
    }else{
        $(".busca").html('');
        var termoBuscado = $("#pesquisa").val().toLowerCase();
        for(i = 0; i < ListaDeProdutos.length; i++){
            if(ListaDeProdutos[i].nome.toLowerCase().search(termoBuscado) != -1){
                $(".busca").append("<div class='lProduto' pid='"+ ListaDeProdutos[i].id + "'> " +
                    "<span id='nome'>" + ListaDeProdutos[i].nome + "</span>" +
                    "<span id='preco'>R$ " + Number(ListaDeProdutos[i].preco).toFixed(2) + "</span>" +
                    "<a class='btn btn-success add'>+</a>" +
                    "</div>");
            }
        }
    }
}

var options =  {
    onChange: function(cep){
      update();
    }
};

    function update() {
        var total = 0;
        var lista = [];
        var produtos = $(".carrinho .lProduto");

        produtos.each(function( index ) {
            var id = $(this).attr("pid");
            var pre = parseFloat($(this).find("#preco").html().replace("R$ ", "").replace(",","."));
            var qua = $(this).find("#quant").val();
            total += qua * pre;
            lista.push({id, qua});
        });

        $("#lista").val(JSON.stringify(lista));
        $("span#total").html(total.toFixed(2));
    }

    $(function () {
        $(".busca").on("click", ".add", function () {
            var parent = $(this).parent(".lProduto");
            var id = parent.attr("pid");
            if( $(".carrinho .lProduto[pid='"+id+"']").length < 1 ) {
                var name = parent.find("#nome").html();
                var price = parent.find("#preco").html();
                $(".carrinho").prepend('<div class="lProduto" pid="'+id+'"><span id="nome">'+name+'</span><span id="preco">'+price+'</span><input type="text" id="quant" value="1" /><a class="btn btn-danger rem">-</a></div>');
                $(".carrinho .lProduto[pid='"+id+"'] #quant").mask("0#", options);
            } else {
                // TODO
            }
            update();
        });


        $(".carrinho").on("click", ".rem", function () {
            var parent = $(this).parent(".lProduto");
            parent.find("#quant").unmask();
            parent.remove();
            update();
        });

        $(".carrinho").on("change","#quant", function() {
            update();
        });
    })
</script>
