<?php
	require '../conn.php';
	require '../session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '{"error": 403}');
	
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../../models/Ocorrencia.php';
	require '../../daos/DAOOcorrencia.php';
	require '../../models/Relatorio.php';
	require '../../daos/DAORelatorio.php';
	require '../../models/Endereco.php';
	require '../../daos/DAOEndereco.php';
	require '../../models/Residencial.php';
	require '../../daos/DAOResidencial.php';
	require '../../models/Tecnico.php';
	require '../../daos/DAOTecnico.php';
	require '../../models/Civil.php';
	require '../../daos/DAOCivil.php';
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	try {
		$daoOcorrencia = new DAOOcorrencia($pdo);
		$daoRelatorio = new DAORelatorio($pdo);
		$daoCivil = new DAOCivil($pdo);
		$daoResidencial = new DAOResidencial($pdo);
		$daoEndereco = new DAOEndereco($pdo);
		$daoTecnico = new DAOTecnico($pdo);
		$daoFuncionario = new DAOFuncionario($pdo);
		
		$total = 0;
		
		if (isset($input['offset'])){
			$daoOcorrencia->setListOffset($input['offset']);
		}
		if (isset($input['entries'])){
			$daoOcorrencia->setListLength($input['entries']);
		}
		
		$ocorrencias = null;
		if (isset($input['recente'])){
			$date = getCurrentDate();
			$ocorrencias = $daoOcorrencia->listRecents($date, $input['recente']);
			$total = $daoOcorrencia->countAll($date, $input['recente']);
		}
		else {
			$ocorrencias = $daoOcorrencia->searchByText($input['text'], $input['aprovado']=='true'? true: false, $input['aprovado']=='null');
			$total = $daoOcorrencia->countByText($input['text'], $input['aprovado']=='true'? true: false, $input['aprovado']=='null');
		}
		
		
		$first = true;
		echo '{"entries": [';
		foreach ($ocorrencias as $ocorrencia){
			$relatorio = $daoRelatorio->findByOcorrencia($ocorrencia);
			$civil = $daoCivil->findById($ocorrencia->getIdCivil());
			$residencial = $daoResidencial->findById($ocorrencia->getIdResidencial());
			$endereco = $daoEndereco->findByCep($residencial->getCep());
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
				"numero": "'.addslashes($residencial->getNumero()).'",
				"bairro": "'.addslashes($endereco->getBairro()).'",
				"relato": "'.addslashes($ocorrencia->getRelatoCivil()).'",
				"relatorio_id": '.($relatorio==null?'null':$relatorio->getId()).',
				"encerrado": '.($ocorrencia->getEncerrado()? 'true': 'false').',
				"aprovado": '.($ocorrencia->getAprovado()? 'true': 'false').'
			}';
		}
		echo '], "limit": '.$total.'}';
	}
	catch (Throwable $error){
		echo '{"error": 500, "error_log": "'.addslashes($error).'"}';
		regError($error);
	}
?>