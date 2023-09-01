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
	
	$daoOcorrencia = new DAOOcorrencia($pdo);
	$daoRelatorio = new DAORelatorio($pdo);
	$daoCasa = new DAOCasa($pdo);
	$daoEndereco = new DAOEndereco($pdo);
	
	$ocorrencias = $daoOcorrencia->searchByText($input['text'], $input['aprovado']?true:false);
	
	$first = true;
	echo '[';
	foreach ($ocorrencias as $ocorrencia){
		$relatorio = $daoRelatorio->findByOcorrencia($ocorrencia);
		$casa = $daoCasa->findById($relatorio->getIdCasa());
		$endereco = $daoEndereco->findByCep($casa->getCep());
		
		if ($first){
			$first = false;
		}
		else{
			echo ',';
		}
		echo '{
			"id": '.$ocorrencia->getId().',
			"data": "'.addslashes($ocorrencia->getDataOcorrencia()).'",
			"rua": "'.addslashes($endereco->getRua()).'",
			"numero": "'.addslashes($casa->getNumero()).'",
			"bairro": "'.addslashes($endereco->getBairro()).'",
			"relato": "'.addslashes($ocorrencia->getRelatoCivil()).'"
		}';
	}
	echo ']';
	
?>