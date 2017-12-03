<?php

    $ip = $_SERVER['REMOTE_ADDR'];
    $offset = -3 * 60 * 60;
    $time = time() + $offset;
    $day = date("Y-m-d", $time);
    $month = date("Y-m", $time);
    $uniq = 1; $uniqm = 1;

    $db->prepare("INSERT INTO log_link VALUES (DEFAULT, '".$day."', '".$ip."', '".@$_SERVER['HTTP_REFERER']."', '".@$_SERVER['QUERY_STRING']."', DEFAULT)")->execute();

    $q0 = $db->prepare("SELECT * FROM log_unico_dia WHERE data='".$day."' AND ip='".$ip."'");
    $q0->execute();
    $linhas = $q0->fetchAll();
    if (count($linhas) == 0)
        $db->prepare("INSERT INTO log_unico_dia VALUES(DEFAULT, '".$ip."', '".$day."', 1)")->execute();
    else {
        $uniq = 0;
        $db->prepare("UPDATE log_unico_dia SET contador=".($linhas[0]['contador']+1)." WHERE id=".$linhas[0]['id'])->execute();
    }

    $q1 = $db->prepare("SELECT * FROM log_unico_mes WHERE data='".$month."' AND ip='".$ip."'");
    $q1->execute();
    $linhas = $q1->fetchAll();
    if (count($linhas) == 0)
        $db->prepare("INSERT INTO log_unico_mes VALUES(DEFAULT, '".$ip."', '".$month."', 1)")->execute();
    else {
        $uniqm = 0;
        $db->prepare("UPDATE log_unico_mes SET contador=".($linhas[0]['contador']+1)." WHERE id=".$linhas[0]['id'])->execute();
    }

    $q2 = $db->prepare("SELECT * FROM log_dia WHERE data='".$day."'");
    $q2->execute();
    $linhas = $q2->fetchAll();
    if (count($linhas) == 0)
        $db->prepare("INSERT INTO log_dia VALUES(DEFAULT, '".$day."', 1, 1)")->execute();
    else {
        $db->prepare("UPDATE log_dia SET acesso=".($linhas[0]['acesso']+1).", unico=".($linhas[0]['unico']+$uniq)." WHERE id=".$linhas[0]['id'])->execute();
    }

    $q3 = $db->prepare("SELECT * FROM log_mes WHERE data='".$month."'");
    $q3->execute();
    $linhas = $q3->fetchAll();
    if (count($linhas) == 0)
        $db->prepare("INSERT INTO log_mes VALUES(DEFAULT, '".$month."', 1, 1)")->execute();
    else {
        $db->prepare("UPDATE log_mes SET acesso=".($linhas[0]['acesso']+1).", unico=".($linhas[0]['unico']+$uniq)." WHERE id=".$linhas[0]['id'])->execute();
    }

?>
