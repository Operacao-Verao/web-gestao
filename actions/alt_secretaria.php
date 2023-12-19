<?php
	require 'conn.php';
	require 'session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '', '../views/login/login.php');
	
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
		$id = $_POST['inputId'];
		$nome = $_POST['inputSecretaria'];
		
		$daoSecretaria = new DAOSecretaria($pdo);
		
		// Retrieve the objects
		$secretaria = $daoSecretaria->findById($id);
		
		// Update the secretario and cargo
		$secretaria->setNomeSecretaria($nome);
		$daoSecretaria->update($secretaria);
		
		regLog(REG_ACAO::ALT_SECRETARIA, 'Secretaria: '.$secretaria->getNomeSecretaria().'; Id: '.$secretaria->getId());
		
		header("Location: ../views/secretarias/secretarias.php");
	}
	catch (Throwable $error){
		regError($error);
		header("Location: ../views/secretarias/secretarias.php?error=500");
	}
?>