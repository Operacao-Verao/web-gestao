<?php
	require '../conn.php';
	require '../session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, 'Error 403');
	
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
		
		$ocorrencia = $daoOcorrencia->findById($input['id']);
		
		if ($ocorrencia && !$ocorrencia->getEncerrado()){
			$ocorrencia->setIdTecnico($input['aprovado']? $input['idTecnico']: null);
			$ocorrencia->setAprovado($input['aprovado']);
			$ocorrencia->setEncerrado(true);
			$daoOcorrencia->update($ocorrencia);
		}
	}
	catch (Throwable $error){
		echo 'Error 500';
		regError($error);
	}
?>