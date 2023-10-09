<?php
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../conn.php';
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
		echo 'Error';
		regError($error);
	}
?>