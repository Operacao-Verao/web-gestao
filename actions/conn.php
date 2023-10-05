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
    function getCurrentDatetime() {
        return date('Y/m/d h:i:s', time());
    }
    function getCurrentDate() {
        return date('Y/m/d', time());
    }
    function getCurrentTime() {
        return date('h:i:s', time());
    }
    function formatDate($datetime) {
        $date = date_create($datetime);
        return date_format($date, 'd/m/Y');
    }
    function formatWeekDay($datetime, $full_name = true) {
        $format = date_format(date_create($datetime), 'w');
        $days = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado');
        return $days[$format].($format>=1 && $format<=5 && $full_name? '-Feira': '');
    }
    function formatTime($datetime, $include_seconds = false) {
        $date = date_create($datetime);
        return date_format($date, 'H:i'.($include_seconds? ':s': ''));
    }
?>
