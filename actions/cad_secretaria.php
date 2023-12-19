<?php
	require 'conn.php';
	require 'session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '', '../views/login/login.php');
	
	require '../models/Secretaria.php';
	require '../daos/DAOSecretaria.php';
	
	require '../models/Funcionario.php';
	require '../daos/DAOFuncionario.php';
	require '../models/Registro.php';
	require '../daos/DAORegistro.php';
	
	try {
		$secretaria = $_POST['inputSecretaria'];
		$daoSecretaria = new DAOSecretaria($pdo);
		$secretaria = $daoSecretaria->insert($secretaria);
		
		regLog(REG_ACAO::CAD_SECRETARIA, 'Secretaria: '.$secretaria->getNomeSecretaria().'; Id: '.$secretaria->getId());
		
		header("Location: ../views/secretarias/secretarias.php");
	}
	catch (Throwable $error){
		regError($error);
		header("Location: ../views/secretarias/secretarias.php?error=500");
	}
?>