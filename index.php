<?php
	require './actions/conn.php';
	require './actions/session_auth.php';
	
	authenticateSession(TIPO_USUARIO::GESTOR, '', 'actions/login_guest.php');
	header("location: views/home/home.php");
?>