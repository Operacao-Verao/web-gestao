<?php
    // Conexão com o Banco de Dados
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
    
    // Configurações de Data e Hora
    date_default_timezone_set('America/Sao_Paulo');
    //date_default_timezone_set(date_default_timezone_get());
    function getDatetime() {
        return date('Y/d/m h:i:s', time());
    }
    function getDate() {
        return date('Y/d/m', time());
    }
?>
