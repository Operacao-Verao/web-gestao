<?php
    include_once('conn.php');
    
    // Only allowed in DEV version
    if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
        header("Location: ../views/login/login.php");
    }
    
	session_start();
	$_SESSION["usuario_id"] = -1;
    $_SESSION["usuario_nome"] = 'admin';
    $_SESSION["usuario_tipo"] = 0;

    header("Location: ../views/home/home.php");
?>