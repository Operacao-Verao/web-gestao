<?php
	require 'conn.php';
	
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
		$nome = $_POST['inputNome'];
		$cargo_nome = $_POST['inputCargo'];
		$secretaria_id = $_POST['inputSecretaria'];
		
		$daoCargo = new DAOCargo($pdo);
		$daoSecretaria = new DAOSecretaria($pdo);
		$daoSecretario = new DAOSecretario($pdo);
		
		// Retrieve the objects
		$secretario = $daoSecretario->findById($id);
		$cargo = $daoCargo->findById($secretario->getIdCargo());
		$secretaria = $daoSecretaria->findById($secretaria_id);
		
		// Update the secretario and cargo
		$cargo->setNomeCargo($cargo_nome);
		$daoCargo->update($cargo);
		$secretario->setNomeSecretario($nome);
		$secretario->setSecretaria($secretaria);
		$daoSecretario->update($secretario);
		
		header("Location: ../views/secretarios/secretarios.php");
	}
	catch (Throwable $error){
		regError($error);
		header("Location: ../views/secretarios/secretarios.php?error=500");
	}
?>