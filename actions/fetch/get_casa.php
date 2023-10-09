<?php
	$input = json_decode(file_get_contents('php://input'), true);

	require '../conn.php';
	require '../../models/Residencial.php';
	require '../../daos/DAOResidencial.php';
	require '../../models/Casa.php';
	require '../../daos/DAOCasa.php';
	require '../../models/Endereco.php';
	require '../../daos/DAOEndereco.php';
	require '../../models/Relatorio.php';
	require '../../daos/DAORelatorio.php';
	require '../../models/Ocorrencia.php';
	require '../../daos/DAOOcorrencia.php';
	
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	try {
		$daoResidencial = new DAOResidencial($pdo);
		$daoCasa = new DAOCasa($pdo);
		$daoEndereco = new DAOEndereco($pdo);
		$daoRelatorio = new DAORelatorio($pdo);
		$daoOcorrencia = new DAOOcorrencia($pdo);

		$casa = $daoCasa->findById($input['id']);

		if ($casa == null){
			echo '{}';
			exit();
		}

		$residencial = $daoResidencial->findById($casa->getIdResidencial());
		$endereco = $daoEndereco->findByCep($residencial->getCep());

		echo '{
		"cep": "'.$residencial->getCep().'",
		"rua": "'.$endereco->getRua().'",
		"bairro": "'.$endereco->getBairro().'",
		"cidade": "'.$endereco->getCidade().'",
		"numero": "'.$residencial->getNumero().'",
		"complemento": "'.$casa->getComplemento().'",
		"interdicao": "'.addslashes($casa->getInterdicao()).'",
		"ocorrencias": [
		';

		$relatorios = $daoRelatorio->searchByCasa($casa);
		$first = true;
		foreach ($relatorios as $relatorio){
			$ocorrencia = $daoOcorrencia->findById($relatorio->getIdOcorrencia());
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
			"relato": "'.addslashes($ocorrencia->getRelatoCivil()).'"
			}';
		}
		echo ']}';
	}
	catch (Throwable $error){
		regError($error);
	}
?>