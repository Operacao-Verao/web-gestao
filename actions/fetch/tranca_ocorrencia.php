<?php
	require '../conn.php';
	require '../session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '{"error": 403}');
	
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../../models/Ocorrencia.php';
	require '../../daos/DAOOcorrencia.php';
	
	require '../../models/Tecnico.php';
	require '../../daos/DAOTecnico.php';
	
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	try {
		$daoOcorrencia = new DAOOcorrencia($pdo);
		$daoTecnico = new DAOTecnico($pdo);
		$daoFuncionario = new DAOFuncionario($pdo);
		
		$ocorrencia = $daoOcorrencia->findById($input['id']);
		
		if ($ocorrencia && !$ocorrencia->getEncerrado()){
			$ocorrencia->setIdTecnico($input['aprovado']? $input['idTecnico']: null);
			$ocorrencia->setAprovado($input['aprovado']);
			$ocorrencia->setEncerrado(true);
			$daoOcorrencia->update($ocorrencia);
		}
		
		if($ocorrencia->getIdTecnico() != null){
			$tecnico = $daoTecnico->findById($ocorrencia->getIdTecnico());
			$funcionario = $daoFuncionario->findById($tecnico->getIdFuncionario());

			echo '{
				"id": '.$tecnico->getId().',
				"id_funcionario": '.$funcionario->getId().',
				"nome": "'.addslashes($funcionario->getNome()).'",
				"email": "'.addslashes($funcionario->getEmail()).'",
				"token": "'.addslashes($tecnico->getToken()).'",
				"status": '.($tecnico->getAtivo()? 'true': 'false').'
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