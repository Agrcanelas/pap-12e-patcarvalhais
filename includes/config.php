<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'gabarq';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    exit('Erro de conexão: '.$conn->connect_error);
} else {
    echo 'Conexão bem-sucedida!';
}
