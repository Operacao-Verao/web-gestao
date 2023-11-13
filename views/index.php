<?php
		require '../actions/session_auth.php';
		require '../actions/conn.php';
		session_start();
		if(!empty($_SESSION['usuario_id']) || $_SESSION["usuario_tipo"] != TIPO_USUARIO::GESTOR) {
			header("location: home/home.php");
		} else {
			header("location: niveis_chuva/niveis_chuva.php");
		}
?>