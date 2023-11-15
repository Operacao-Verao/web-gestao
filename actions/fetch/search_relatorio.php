<?php
	require '../conn.php';
	require '../session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '{"error": 403}');
	
	$input = json_decode(file_get_contents('php://input'), true);
	
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
		
		$daoRelatorio->setListOffset($input['offset']);
		$daoRelatorio->setListLength($input['entries']);
		
		$relatorios = $daoRelatorio->searchByText($input['text']);
		$total = $daoRelatorio->countByText($input['text']);
		
		$first = true;
		echo '{"entries": [';
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
		echo '], "limit": '.$total.'}';
	} catch (Throwable $error) {
		echo '{"error": 500, "error_log": "'.addslashes($error).'"}';
		regError($error);
	}
?>