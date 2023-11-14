<?php
    include_once("../actions/conn.php");
    
    include_once('../models/Registro.php');
    include_once('../daos/DAORegistro.php');
    
    try {
        session_start();
        
        $_SESSION["usuario_id"] = -1;
        $_SESSION["usuario_nome"] = 'guest';
        $_SESSION["usuario_tipo"] = TIPO_USUARIO::GUEST;
        
        header("Location: ../views/niveis_chuva/niveis_chuva.php");
        exit();
    }
    catch (Throwable $error){
        //header("Location: ../views/login/login.php?error=500");
        regError($error);
        echo '<h1>Deu ruim</h1>Consulte os registros do banco';
    }
?>
