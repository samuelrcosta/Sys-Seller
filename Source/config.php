<?php
require 'environment.php';
$config = array();
if(ENVIRONMENT == 'development'){
    define("BASE_URL", 'http://localhost/php/Sys-Seller/Source');
    $config['dbname'] = 'sysseller';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['dbpass'] = 'joao123';
} else{
    define("BASE_URL", 'https://smrc.000webhostapp.com');
    $config['dbname'] = 'id2966524_sysseller';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'id2966524_admsysseller';
    $config['dbpass'] = 'root123';
}

global $db;
try {
    $db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'].";charset=utf8", $config['dbuser'], $config['dbpass']);
}catch (PDOExeption $e){
    echo "ERRO: ".$e->getMessage();
}