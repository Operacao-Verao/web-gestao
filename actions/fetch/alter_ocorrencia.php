<?php
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../conn.php';
	require '../../models/Ocorrencia.php';
	require '../../daos/DAOOcorrencia.php';
	
	require '../../models/Relatorio.php';
	require '../../daos/DAORelatorio.php';
	require '../../models/Casa.php';
	require '../../daos/DAOCasa.php';
	require '../../models/Endereco.php';
	require '../../daos/DAOEndereco.php';
	require '../../models/Civil.php';
	require '../../daos/DAOCivil.php';
	require '../../models/Tecnico.php';
	require '../../daos/DAOTecnico.php';
	
	
	$daoOcorrencia = new DAOOcorrencia($pdo);
	$daoRelatorio = new DAORelatorio($pdo);
	$daoCasa = new DAOCasa($pdo);
	$daoEndereco = new DAOEndereco($pdo);
	$daoCivil = new DAOCivil($pdo);
	
	$relatorios = $daoRelatorio->listAll();
	$ocorrencia = $daoOcorrencia->findById($input['id']);
	
	if ($ocorrencia){
		echo $input['idTecnico'];
		$ocorrencia->setIdTecnico($input['idTecnico']);
		$ocorrencia->setAprovado($input['aprovado']);
		$daoOcorrencia->update($ocorrencia);
	}
?>