<?php
    // Database Connection Properties
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
    
    // User Properties
    enum TIPO_USUARIO{
        const GESTOR = 0;
        const FUNCIONARIO = 1;
    };
    
    // Errors regs
    function regError(Throwable $error) {
        global $pdo;
        $daoRegistro = new DAORegistro($pdo);
        $daoFuncionario = new DAOFuncionario($pdo);
        $owner = $daoFuncionario->findByEmail("admin");
        if (!$owner){
            $owner = $daoFuncionario->findById($_SESSION['usuario_id']);
        }
        $daoRegistro->insert($owner, REG_ACAO::ERRO, $error->__toString(), getCurrentDatetime());
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
?>
