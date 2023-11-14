<?php
	require '../conn.php';
	require '../session_auth.php';
	
	authenticateSession(TIPO_USUARIO::GESTOR, '', '../login_guest.php');
	header("location: ../../views/home/home.php");
?>