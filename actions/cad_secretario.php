<?php
	require 'conn.php';
	require 'session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '', '../login/login.php');
	
	require '../models/Cargo.php';
	require '../daos/DAOCargo.php';
	require '../models/Secretaria.php';
	require '../daos/DAOSecretaria.php';
	require '../models/Secretario.php';
	require '../daos/DAOSecretario.php';
	
	require '../models/Funcionario.php';
	require '../daos/DAOFuncionario.php';
	require '../models/Registro.php';
	require '../daos/DAORegistro.php';
	
	try {
		$nome = $_POST['inputNome'];
		$cargo = $_POST['inputCargo'];
		$secretaria_id = $_POST['inputSecretaria'];
		
		$daoCargo = new DAOCargo($pdo);
		$daoSecretaria = new DAOSecretaria($pdo);
		$daoSecretario = new DAOSecretario($pdo);
		
		$cargo = $daoCargo->insert($cargo);
		$secretaria = $daoSecretaria->findById($secretaria_id);
		$secretario = $daoSecretario->insert($secretaria, $cargo, $nome);
		
		header("Location: ../views/secretarios/secretarios.php");
	}
	catch (Throwable $error){
		regError($error);
		header("Location: ../views/secretarios/secretarios.php?error=500");
	}
?>