<?php
	require '../conn.php';
	require '../session_auth.php';
	// Seems the internal server does not support session in Gets in local files
	//authenticateSession(TIPO_USUARIO::GESTOR, '{"error": 403}');
	
	require '../../models/Endereco.php';
	require '../../daos/DAOEndereco.php';
	
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	$in_get_endereco_cep = $_GET['cep'];
	try {
		require '../core/get_endereco.php';
		echo $get_endereco_out;
	}
	catch (Throwable $error){
		echo '{"error": 500}';
		regError($error);
	}
?>