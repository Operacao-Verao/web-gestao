<?php
	session_start();
	$_SESSION["usuario_id"] = -1;
    $_SESSION["usuario_nome"] = 'admin';
    $_SESSION["usuario_tipo"] = 0;

    header("Location: ../views/home/home.php");
?>