<div class="container">
    <h1 style="margin-top: 20px">Cadastrando Produto</h1>
    <a class="btn btn-primary" style="margin-top: 10px;margin-bottom: 20px" href="<?php echo BASE_URL ?>/produtos">Voltar</a>
    <form id="form-produto" method="POST" onsubmit="return validar(this)">
        <div class="form-group">
            <label>Código:</label>
            <input type="text" class="form-control" id="codigo" name="codigo" data-alt="Código" data-ob="0">
        </div>
        <div class="form-group">
            <label><span class="obrigatorio">*</span>Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" data-alt="Nome" data-ob="1">
        </div>
        <div class="form-group">
            <label>Categoria:</label>
            <input type="text" class="form-control" id="categoria" name="categoria" data-alt="Categoria" data-ob="0">
        </div>
        <div class="form-group">
            <label>Descrição:</label>
            <textarea class="form-control" id="descricao" name="descricao" data-alt="Descrição" data-ob="0" rows="4"></textarea>
        </div>
        <div class="form-group">
            <label><span class="obrigatorio">*</span>Preço:</label>
            <input type="text" class="form-control" id="preco" name="preco" data-alt="Preço" data-ob="1">
        </div>
        <p id="infocampos">Obs.: Campos com <label><span>*</span></label> são de preenchimento obrigatório.</p>
        <div id='retorno' style='margin-bottom: 15px;margin-top: 5px;display: none' class='alert alert-danger'>
            <ul class="list-group">
                <li class="list-group-item">
                </li>
            </ul>
        </div>
        <input type="submit" class="btn-lg btn-success" style="cursor: pointer" value="Cadastrar">
    </form>
</div>
<script src="<?php echo BASE_URL?>/assets/js/jquery.mask.js"></script>
<script>
    window.onload = function () {
        $("#preco").mask("#.##0,00", {reverse: true});
    }
</script>