<?php
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../conn.php';
	
	require '../../models/Ocorrencia.php';
	require '../../daos/DAOOcorrencia.php';
	require '../../models/Casa.php';
	require '../../daos/DAOCasa.php';
	require '../../models/Endereco.php';
	require '../../daos/DAOEndereco.php';
	require '../../models/Tecnico.php';
	require '../../daos/DAOTecnico.php';
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	
	$daoOcorrencia = new DAOOcorrencia($pdo);
	$daoCasa = new DAOCasa($pdo);
	$daoEndereco = new DAOEndereco($pdo);
	$daoTecnico = new DAOTecnico($pdo);
	$daoFuncionario = new DAOFuncionario($pdo);
	
	$ocorrencias = $daoOcorrencia->searchByText($input['text'], $input['aprovado']?true:false);
	
	$first = true;
	echo '[';
	foreach ($ocorrencias as $ocorrencia){
		$casa = $daoCasa->findById($ocorrencia->getIdCasa());
		$endereco = $daoEndereco->findByCep($casa->getCep());
		$tecnico = $ocorrencia->getIdTecnico()==null? null: $daoTecnico->findById($ocorrencia->getIdTecnico());
		$funcionario = $tecnico? $daoFuncionario->findById($tecnico->getIdFuncionario()): null;
		
		if ($first){
			$first = false;
		}
		else{
			echo ',';
		}
		echo '{
			"id": '.$ocorrencia->getId().',
			"data": "'.addslashes(formatDate($ocorrencia->getDataOcorrencia())).'",
			"hora": "'.addslashes(formatTime($ocorrencia->getDataOcorrencia())).'",
			"tecnico": '.($funcionario!=null?('"'.addslashes($funcionario->getNome()).'"'):'null').',
			"rua": "'.addslashes($endereco->getRua()).'",
			"numero": "'.addslashes($casa->getNumero()).'",
			"bairro": "'.addslashes($endereco->getBairro()).'",
			"relato": "'.addslashes($ocorrencia->getRelatoCivil()).'"
		}';
	}
	echo ']';
	
?>