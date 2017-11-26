<style>
    .table-bordered thead td, .table-bordered thead th {
        text-align: center;
    }
</style>
<div class="Container">
    <h1 style="margin-top: 20px; margin-bottom: 20px">Logs do Sistema</h1>
    <table class="table table-bordered table-tripped table-responsive table-sm">
        <thead>
        <tr>
            <th>Data</th>
            <th>ID do Registro</th>
            <th>Severidade</th>
            <th>Usuário</th>
            <th>Resultado</th>
            <th>Descrição</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($logs as $log):?>
            <tr <?php if($log['severidade'] == 1) echo ""; elseif ($log['severidade'] == 2) echo "class='table-warning'"; elseif ($log['severidade'] == 3) echo "class='table-danger'" ?>>
                <td><?php echo date_format(date_create($log['data_ocorrencia']), 'd/m/Y \à\s H:i:s');?></td>
                <td style="text-align: center"><?php echo $log['id_registro'] ?></td>
                <td><?php if($log['severidade'] == 1) echo "Baixa"; elseif ($log['severidade'] == 2) echo "Média"; elseif ($log['severidade'] == 3) echo "Alta" ?></td>
                <td><?php echo $log['nomeUsuario'] ?></td>
                <td><?php echo $log['resultado'] ?></td>
                <td><?php echo $log['descricao'] ?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
