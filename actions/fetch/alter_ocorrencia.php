<?php
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../conn.php';
	require '../../models/Ocorrencia.php';
	require '../../daos/DAOOcorrencia.php';
	
	require '../../models/Tecnico.php';
	require '../../daos/DAOTecnico.php';
	
	
	$daoOcorrencia = new DAOOcorrencia($pdo);
	
	$ocorrencia = $daoOcorrencia->findById($input['id']);
	
	if ($ocorrencia){
		$ocorrencia->setIdTecnico($input['idTecnico']);
		$ocorrencia->setAprovado($input['aprovado']);
		$daoOcorrencia->update($ocorrencia);
	}
?>