<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data',  'Únicos', 'Total']
          <?php foreach ($log_dia as $log):?>
          ,['<?=$log['data'];?>', <?=$log['unico'];?>, <?=$log['acesso'];?>]
          <?php endforeach;?>
        ]);

        var options = {
          title: 'Acessos diários',
          isStacked: false
        };

        var chart = new google.visualization.SteppedAreaChart(document.getElementById('chart_div_dia'));
        chart.draw(data, options);

        var data2 = google.visualization.arrayToDataTable([
            ['Data',  'Únicos', 'Total']
            <?php foreach ($log_mes as $log):?>
            ,['<?=$log['data'];?>', <?=$log['unico'];?>, <?=$log['acesso'];?>]
            <?php endforeach;?>
        ]);

        var options2 = {
            title: 'Acessos mensais',
            isStacked: false
        };

        var chart2 = new google.visualization.SteppedAreaChart(document.getElementById('chart_div_mes'));
        chart2.draw(data2, options2);
      }
    </script>

<div class="Container">
    <h1 style="margin-top: 20px; margin-bottom: 20px"><?=$titulo;?></h1>
    <a style="margin-top: -40px;margin-bottom: 20px; float: right;" class="btn btn-success" href='<?php echo BASE_URL ?>/logs'>Logs do Sistema</a><br />
    <div style="width: 48%; display: inline-block;">
        <div id="chart_div_dia" style="height: 350px;"></div>
    </div>
    <div style="width: 48%; display: inline-block;">
        <div id="chart_div_mes" style="height: 350px;"></div>
    </div>
    <table class="table table-bordered table-tripped table-sm" width="100%">
        <thead>
        <tr>
            <th>ID do Registro</th>
            <th>Data</th>
            <th>IP</th>
            <th>Referência</th>
            <th>Requisição</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($logs as $log):?>
            <tr>
                <td><?php echo $log['id'] ?></td>
                <td><?php echo date_format(date_create($log['hora']), 'd/m/Y \à\s H:i:s');?></td>
                <td><?php echo $log['ip'] ?></td>
                <td><?php echo $log['link'] ?></td>
                <td><?php echo $log['req'] ?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
