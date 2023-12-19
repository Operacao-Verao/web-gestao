<?php
    // Database Connection Properties
    //$SERVER_LOCATION = $_SERVER['DOCUMENT_ROOT'].'/web-gestao';
    //$SERVER_LOCATION = $_SERVER['DOCUMENT_ROOT'].'/web-gestao-main';
    $SERVER_LOCATION = preg_replace('/(web-gestao{1}(-main)?).*/', '$1', __DIR__); // Only for debug purposes, I don't know exacly in wich machine and path the project will be keeped
    $db_host = 'localhost';
    $db_name = 'BDDEFESACIVIL';
    $db_user = 'root';
    $db_pass = '';
    global $pdo;
    
    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo 'Erro ao conectar com o banco de dados: ' . $e->getMessage();
        die();
    }
    
    // Datetime Settings
    date_default_timezone_set('America/Sao_Paulo');
    //date_default_timezone_set(date_default_timezone_get());
    function getCurrentDatetime() {
        return date('Y-m-d h:i:s', time());
    }
    function getCurrentDate() {
        return date('Y-m-d', time());
    }
    function getCurrentTime() {
        return date('h:i:s', time());
    }
    function formatDate($datetime, $with_year=true) {
        $date = date_create($datetime);
        return date_format($date, $with_year? 'd/m/Y': 'd/m');
    }
    function formatYear($datetime) {
        $date = date_create($datetime);
        return date_format($date, 'Y');
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
    
    // Server utilities
    
    // Password encyption and verification
    function encryptPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT, [
            'cost' => 12
        ]);
    }
    function verifyPassword($encrypted, $password){
        return password_verify($password, $encrypted);
    }
    
    // Pagining Settings
    const ALL_REMAIN_ENTRIES = -1;
    
    // User Properties
    enum TIPO_USUARIO{
        const GESTOR = 0;
        const FUNCIONARIO = 1;
        const CIVIL = 10;
        const GUEST = -1;
    };
    
    // Database Register
    function regLog(int $acao, string $descricao) {
        global $pdo;
        $daoRegistro = new DAORegistro($pdo);
        $daoFuncionario = new DAOFuncionario($pdo);
        $owner = $daoFuncionario->findById($_SESSION['usuario_id']);
        $daoRegistro->insert($owner, $acao, $descricao, getCurrentDatetime());
    }
    
    function regError(Throwable $error) {
        global $pdo;
        $daoRegistro = new DAORegistro($pdo);
        $daoFuncionario = new DAOFuncionario($pdo);
        $owner = $daoFuncionario->findByEmail("admin");
        if ($owner==null){
            $owner = $daoFuncionario->findById($_SESSION['usuario_id']);
        }
        $daoRegistro->insert($owner, REG_ACAO::ERRO, substr($error->__toString(), 0, 355), getCurrentDatetime());
    }
    
    // Devlopment Properties
    enum DATABASE_VERSION {
        const EARLY_1 = 0;
        const FINAL_1 = 1;
    }
    const DB_VERSION = DATABASE_VERSION::EARLY_1;
    enum DEV_LEVEL {
        const DEV_MODE = 0;
        const STABLE = 1;
    }
    const DEV_LEVEL = DEV_LEVEL::DEV_MODE;
    const SYSTEM_NAME = 'GODNCH';
    const VERSION_NAME = 'Versão 1.0/2023';
    
    function systemVersionName($append_msg=false){
        return ($append_msg? 'Gerado por Sistema ': '').' '.SYSTEM_NAME.' - '.VERSION_NAME.' '.(DEV_LEVEL==DEV_LEVEL::DEV_MODE? '(DEV MODE)': (DEV_LEVEL==DEV_LEVEL::STABLE? '': '(NIGHTLY)'));
    }
?>
