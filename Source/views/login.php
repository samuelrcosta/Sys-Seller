<div class="container col-sm-3" style="margin-top: 30px;margin-bottom: 30px;">
    <h1>Fazer Login</h1>
    <form method="POST" style="margin-top: 20px" onsubmit="return validar(this)">
        <div class="form-group">
            <label for="nome">E-mail</label>
            <input type="text" name="email" id="email" class="form-control" data-ob="1" data-alt="E-mail">
        </div>
        <div class="form-group">
            <label for="nome">Senha</label>
            <input type="password" name="senha" id="senha" class="form-control" data-ob="1" data-alt="Senha">
        </div>
        <div id="retorno" style="margin-bottom: 15px">
            <div id='retorno' style='margin-bottom: 15px;margin-top: 5px;display: none' class='alert alert-danger'>
                <ul class="list-group">
                    <li class="list-group-item">
                    </li>
                </ul>
            </div>
        </div>
        <?php
        if(!empty($aviso)){
            echo "<div class='alert alert-danger'>".$aviso."</div>";
        }
        ?>
        <input type="submit" value="Entrar" class="btn btn-default btn-block" style="cursor: pointer">
    </form>
