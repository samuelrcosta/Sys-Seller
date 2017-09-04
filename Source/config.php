<?php
require 'environment.php';
$config = array();
if(ENVIRONMENT == 'development'){
    define("BASE_URL", 'http://localhost/sysseller');
    $config['dbname'] = 'sysseller';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = 'root';
} else{
    define("BASE_URL", 'http://sysseller.com/');
    $config['dbname'] = 'sysseller';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = 'root';
}

global $db;
try {
    $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'].";charset=utf8", $config['dbuser'], $config['dbpass']);
}catch (PDOExeption $e){
    echo "ERRO: ".$e->getMessage();
}