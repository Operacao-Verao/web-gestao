<?php
	
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../conn.php';
	
	require '../../models/Relatorio.php';
	require '../../daos/DAORelatorio.php';
	require '../../models/Ocorrencia.php';
	require '../../daos/DAOOcorrencia.php';
	require '../../models/Local.php';
	require '../../daos/DAOLocal.php';
	require '../../models/Casa.php';
	require '../../daos/DAOCasa.php';
	require '../../models/Endereco.php';
	require '../../daos/DAOEndereco.php';
	require '../../models/Tecnico.php';
	require '../../daos/DAOTecnico.php';
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	
	$daoRelatorio = new DAORelatorio($pdo);
	$daoOcorrencia = new DAOOcorrencia($pdo);
	$daoLocal = new DAOLocal($pdo);
	$daoCasa = new DAOCasa($pdo);
	$daoEndereco = new DAOEndereco($pdo);
	$daoTecnico = new DAOTecnico($pdo);
	$daoFuncionario = new DAOFuncionario($pdo);
	
	
	try {
		$relatorios = $daoRelatorio->searchByText($input['text']);
	
	$first = true;
	echo '[';
	foreach ($relatorios as $relatorio){
		$casa = $daoCasa->findById($relatorio->getIdCasa());
		$local = $daoLocal->findById($casa->getIdLocal());
		$endereco = $daoEndereco->findByCep($local->getCep());
		$ocorrencia = $daoOcorrencia->findById($relatorio->getIdOcorrencia());
		$tecnico = $ocorrencia->getIdTecnico()==null? null: $daoTecnico->findById($ocorrencia->getIdTecnico());
		$funcionario = $tecnico? $daoFuncionario->findById($tecnico->getIdFuncionario()): null;
		
		if ($first){
			$first = false;
		}
		else{
			echo ',';
		}
		echo '{
			"id": '.$relatorio->getId().',
			"id_ocorrencia": '.$ocorrencia->getId().',
			"data": "'.addslashes(formatDate($relatorio->getDataGeracao())).'",
			"hora": "'.addslashes(formatTime($relatorio->getDataGeracao())).'",
			"tecnico": '.($funcionario!=null?('"'.addslashes($funcionario->getNome()).'"'):'null').',
			"rua": "'.addslashes($endereco->getRua()).'",
			"numero": "'.addslashes($local->getNumero()).'",
			"bairro": "'.addslashes($endereco->getBairro()).'",
			"relato": "'.addslashes($ocorrencia->getRelatoCivil()).'"
		}';
	}
	echo ']';
	} catch (\Throwable $th) {
		echo $th;
	}
	
	
?>