<?php
	require '../conn.php';
	require '../session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '{"error": 403}');
	
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../../models/Ocorrencia.php';
	require '../../daos/DAOOcorrencia.php';
	require '../../models/Relatorio.php';
	require '../../daos/DAORelatorio.php';
	
	require '../../models/Residencial.php';
	require '../../daos/DAOResidencial.php';
	require '../../models/Endereco.php';
	require '../../daos/DAOEndereco.php';
	require '../../models/Civil.php';
	require '../../daos/DAOCivil.php';
	
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	try {
		$daoOcorrencia = new DAOOcorrencia($pdo);
		$daoRelatorio = new DAORelatorio($pdo);
		$daoResidencial = new DAOResidencial($pdo);
		$daoEndereco = new DAOEndereco($pdo);
		$daoCivil = new DAOCivil($pdo);
		
		$ocorrencia = $daoOcorrencia->findById($input['id']);
		$relatorio = $daoRelatorio->findByOcorrencia($ocorrencia);
		
		if ($ocorrencia){
			$residencial = $daoResidencial->findById($ocorrencia->getIdResidencial());
			$endereco = $daoEndereco->findByCep($residencial->getCep());
			$civil = $daoCivil->findById($ocorrencia->getIdCivil());
			echo '{
				"data": "'.addslashes($ocorrencia->getDataOcorrencia()).'",
				"rua": "'.addslashes($endereco->getRua()).'",
				"numero": "'.addslashes($residencial->getNumero()).'",
				"bairro": "'.addslashes($endereco->getBairro()).'",
				"numCasas": '.$ocorrencia->getNumCasas().',
				"acionamento": "'.addslashes($ocorrencia->getAcionamento()).'",
				"civil": "'.addslashes($civil->getNome()).'",
				"relato": "'.addslashes($ocorrencia->getRelatoCivil()).'",
				"tecnicoId": '.($ocorrencia->getIdTecnico()? $ocorrencia->getIdTecnico(): 'null').',
				"aprovado": '.($ocorrencia->getAprovado()? 1: 0).',
				"encerrado": '.($ocorrencia->getEncerrado()? 1: 0).'
			}';
		}
		else {
			echo '{}';
		}
	}
	catch (Throwable $error){
		echo '{"error": 500, "error_log": "'.addslashes($error).'"}';
		regError($error);
	}
?>