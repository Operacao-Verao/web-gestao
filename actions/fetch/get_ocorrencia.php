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
	
	
	$daoOcorrencia = new DAOOcorrencia($pdo);
	$daoRelatorio = new DAORelatorio($pdo);
	$daoCasa = new DAOCasa($pdo);
	$daoEndereco = new DAOEndereco($pdo);
	$daoCivil = new DAOCivil($pdo);
	
	$relatorios = $daoRelatorio->listAll();
	
	$data = '{}';
	foreach ($relatorios as $relatorio) {
		if ($input['id'] == $relatorio->getIdOcorrencia()){
			$ocorrencia = $daoOcorrencia->findById($relatorio->getIdOcorrencia());
			$casa = $daoCasa->findById($relatorio->getIdCasa());
			$endereco = $daoEndereco->findByCep($casa->getCep());
			$civil = $daoCivil->findById($ocorrencia->getIdCivil());
			$data = '{
				"data": "'.addslashes($ocorrencia->getDataOcorrencia()).'",
				"rua": "'.addslashes($endereco->getRua()).'",
				"numero": "'.addslashes($casa->getNumero()).'",
				"bairro": "'.addslashes($endereco->getBairro()).'",
				"numCasas": '.$ocorrencia->getNumCasas().',
				"acionamento": "'.addslashes($ocorrencia->getAcionamento()).'",
				"civil": "'.addslashes($civil->getNome()).'",
				"relato": "'.addslashes($ocorrencia->getRelatoCivil()).'",
				"tecnicoId": '.($ocorrencia->getIdTecnico()? $ocorrencia->getIdTecnico(): 'null').',
				"aprovado": '.($ocorrencia->getAprovado()? 1: 0).'
			}';
		}
	}
	
	echo $data;
?>