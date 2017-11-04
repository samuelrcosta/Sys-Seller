<div class="container">
    <h1 style="margin-top: 20px">Novo Pedido</h1>
    <a class="btn btn-primary" style="margin-top: -40px;margin-bottom: 0px; float: right;" href="<?php echo BASE_URL ?>/clientes">Voltar</a>
    <form id="form-produto" method="POST" onsubmit="return validar(this)">
        <div class="form-group">
            <label><span class="obrigatorio">*</span>Cliente:</label>
            <select class="form-control" id="nome" name="nome">
            <?php foreach ($clientes as $cliente):?>
                <option value="<?=$cliente['id'];?>"><?=$cliente['nome'];?></option>
            <?php endforeach;?>
           </select>
        </div>
        <div class="form-group">
            <label>Produtos:</label>

            <table width="100%" cellpadding="10">
                <tr>
                    <td width="50%">
                        <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" data-alt="CPF" data-ob="0">
                    </td>
                    <td>
                        <label>Total: R$ <span id="total">0.00</span></label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="listaProduto busca">
                            <?php foreach ($produtos as $produto):?>
                                <div class="lProduto">
                                    <span id="nome"><?php echo $produto['nome'] ?></span>
                                    <span id="preco">R$ <?php echo str_replace(".", ",", $produto['preco'])?></span>
                                    <a class="btn btn-primary add" href="">+</a>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </td>
                    <td>
                        <div class="listaProduto carrinho">
                            <div class="lProduto">
                                <span id="nome">Produto</span>
                                <span id="preco">R$ 1.00</span>
                                <input type="text" id="quant" value="1" />
                                <a class="btn btn-primary add" href="">-</a>
                            </div>
                                <div class="lProduto">
                                    <span id="nome">Produto</span>
                                    <span id="preco">R$ 1.00</span>
                                    <input type="text" id="quant" value="1" />
                                    <a class="btn btn-primary add" href="">-</a>
                                </div>
                        </div>
                    </td>
                </tr>
            </table>


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
    document.getElementById("pf").checked = true;
    $("#cpf_cnpj").mask("000.000.000-00");
    $("#cep").mask("00000-000");
    $("#celular").mask("(00) 0000-#0000");
    $("#telefone").mask("(00) 0000-0000");

    $(function () {
        $("#pj").on("click", function () {
            $("#cpf_cnpj").mask("00.000.000/0000-00");
            $("#cpf_cnpj").parent().find('label').html("CNPJ");
            $("#cpf_cnpj").attr('data-alt', 'CNPJ');
        });

        $("#pf").on("click", function () {
            $("#cpf_cnpj").mask("000.000.000-00");
            $("#cpf_cnpj").attr('data-alt', 'CPF');
            $("#cpf_cnpj").parent().find('label').html("CPF");
        });

    })
</script>
