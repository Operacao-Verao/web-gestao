<?php
    $db_host = 'localhost';
    $db_name = 'BDDEFESACIVIL';
    $db_user = 'root';
    $db_pass = '';
    $pdo = null;
    
    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo 'Erro ao conectar com o banco de dados: ' . $e->getMessage();
    }
?>
