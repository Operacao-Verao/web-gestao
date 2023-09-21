<?php
	require 'conn.php';
	
	require '../models/Cargo.php';
	require '../daos/DAOCargo.php';
	require '../models/Secretaria.php';
	require '../daos/DAOSecretaria.php';
	require '../models/Secretario.php';
	require '../daos/DAOSecretario.php';
	
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
?>