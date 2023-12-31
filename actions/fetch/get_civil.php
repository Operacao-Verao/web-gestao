<?php
	require '../conn.php';
	require '../session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '{"error": 403}');
	
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../../models/Civil.php';
	require '../../daos/DAOCivil.php';
	
	require '../../models/Ocorrencia.php';
	require '../../daos/DAOOcorrencia.php';
	require '../../models/Relatorio.php';
	require '../../daos/DAORelatorio.php';
	require '../../models/Residencial.php';
	require '../../daos/DAOResidencial.php';
	require '../../models/Casa.php';
	require '../../daos/DAOCasa.php';
	require '../../models/Endereco.php';
	require '../../daos/DAOEndereco.php';
	
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	try {
		$daoCivil = new DAOCivil($pdo);
		$daoOcorrencia = new DAOOcorrencia($pdo);
		$daoRelatorio = new DAORelatorio($pdo);
		$daoResidencial = new DAOResidencial($pdo);
		$daoCasa = new DAOCasa($pdo);
		$daoEndereco = new DAOEndereco($pdo);
		
		$civil = null;
		if (array_key_exists('id', $input)){
			$civil = $daoCivil->findById($input['id']);
		}
		else if (array_key_exists('cpf', $input)){
			$civil = $daoCivil->findByCpf($input['cpf']);
		}
		else{
			echo '{}';
			exit();
		}
		if ($civil == null){
			echo '{}';
			exit();
		}
		
		$residencial = $civil->getIdResidencial()!=null? $daoResidencial->findById($civil->getIdResidencial()): null;
		
		echo '{
			"id": '.$civil->getId().',
			"nome": "'.addslashes($civil->getNome()).'",
			"cep": "'.($residencial? addslashes($residencial->getCep()): '-Não Cadastrado-').'",
			"numero": "'.($residencial? addslashes($residencial->getNumero()): '').'",
			"celular": "'.addslashes($civil->getCelular()).'",
			"email": "'.addslashes($civil->getEmail()).'",
			"cpf": "'.addslashes($civil->getCpf()).'",
			"telefone": "'.addslashes($civil->getTelefone()).'",
			"ocorrencias": [
			';
		
		$ocorrencias = $daoOcorrencia->listAll();
		$first = true;
		foreach ($ocorrencias as $ocorrencia){
			$residencial = $daoResidencial->findById($ocorrencia->getIdResidencial());
			$endereco = $daoEndereco->findByCep($residencial->getCep());
			if ($ocorrencia->getIdCivil() == $civil->getId()){

			if ($first){
				$first = false;
			}
			else {
				echo ',';
			}
			echo '{
				"id": '.$ocorrencia->getId().',
				"data": "'.addslashes(formatDate($ocorrencia->getDataOcorrencia())).'",
				"hora": "'.addslashes(formatTime($ocorrencia->getDataOcorrencia())).'",
				"rua": "'.addslashes($endereco->getRua()).'",
				"numero": "'.addslashes($residencial->getNumero()).'",
				"bairro": "'.addslashes($endereco->getBairro()).'",
				"observacoes": "'.addslashes($ocorrencia->getRelatoCivil()).'"
				}';
			}
		}
		
		echo ']}';
	}
	catch (Throwable $error){
		echo '{"error": 500, "error_log": "'.addslashes($error).'"}';
		regError($error);
	}
?>