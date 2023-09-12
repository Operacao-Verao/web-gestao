<?php
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../conn.php';
	require '../../models/Ocorrencia.php';
	require '../../daos/DAOOcorrencia.php';
	require '../../models/Relatorio.php';
	require '../../daos/DAORelatorio.php';
	
	require '../../models/Local.php';
	require '../../daos/DAOLocal.php';
	require '../../models/Endereco.php';
	require '../../daos/DAOEndereco.php';
	require '../../models/Civil.php';
	require '../../daos/DAOCivil.php';
	
	
	$daoOcorrencia = new DAOOcorrencia($pdo);
	$daoRelatorio = new DAORelatorio($pdo);
	$daoLocal = new DAOLocal($pdo);
	$daoEndereco = new DAOEndereco($pdo);
	$daoCivil = new DAOCivil($pdo);
	
	$ocorrencia = $daoOcorrencia->findById($input['id']);
	$relatorio = $daoRelatorio->findByOcorrencia($ocorrencia);
	
	if ($ocorrencia){
		$local = $daoLocal->findById($ocorrencia->getIdLocal());
		$endereco = $daoEndereco->findByCep($local->getCep());
		$civil = $daoCivil->findById($ocorrencia->getIdCivil());
		echo '{
			"data": "'.addslashes($ocorrencia->getDataOcorrencia()).'",
			"rua": "'.addslashes($endereco->getRua()).'",
			"numero": "'.addslashes($local->getNumero()).'",
			"bairro": "'.addslashes($endereco->getBairro()).'",
			"numCasas": '.$ocorrencia->getNumCasas().',
			"acionamento": "'.addslashes($ocorrencia->getAcionamento()).'",
			"civil": "'.addslashes($civil->getNome()).'",
			"relato": "'.addslashes($ocorrencia->getRelatoCivil()).'",
			"tecnicoId": '.($ocorrencia->getIdTecnico()? $ocorrencia->getIdTecnico(): 'null').',
			"aprovado": '.($ocorrencia->getAprovado()? 1: 0).'
		}';
	}
	else {
		echo '{}';
	}
?>