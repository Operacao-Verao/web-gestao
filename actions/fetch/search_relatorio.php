<?php
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../conn.php';
	
	require '../../models/Relatorio.php';
	require '../../daos/DAORelatorio.php';
	require '../../models/Ocorrencia.php';
	require '../../daos/DAOOcorrencia.php';
	require '../../models/Residencial.php';
	require '../../daos/DAOResidencial.php';
	require '../../models/Casa.php';
	require '../../daos/DAOCasa.php';
	require '../../models/Endereco.php';
	require '../../daos/DAOEndereco.php';
	require '../../models/Tecnico.php';
	require '../../daos/DAOTecnico.php';
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	try {
		$daoRelatorio = new DAORelatorio($pdo);
		$daoOcorrencia = new DAOOcorrencia($pdo);
		$daoResidencial = new DAOResidencial($pdo);
		$daoCasa = new DAOCasa($pdo);
		$daoEndereco = new DAOEndereco($pdo);
		$daoTecnico = new DAOTecnico($pdo);
		$daoFuncionario = new DAOFuncionario($pdo);
		
		$relatorios = $daoRelatorio->searchByText($input['text']);
		
		$first = true;
		echo '[';
		foreach ($relatorios as $relatorio){
			$casa = $daoCasa->findById($relatorio->getIdCasa());
			$residencial = $daoResidencial->findById($casa->getIdResidencial());
			$endereco = $daoEndereco->findByCep($residencial->getCep());
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
				"numero": "'.addslashes($residencial->getNumero()).'",
				"bairro": "'.addslashes($endereco->getBairro()).'",
				"relato": "'.addslashes($ocorrencia->getRelatoCivil()).'"
			}';
		}
		echo ']';
	} catch (Throwable $error) {
		echo '[]';
		regError($error);
	}
?>