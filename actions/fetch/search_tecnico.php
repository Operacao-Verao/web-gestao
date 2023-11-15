<?php
	require '../conn.php';
	require '../session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '{"error": 403}');
	
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../../models/Tecnico.php';
	require '../../daos/DAOTecnico.php';
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	try {
		$daoTecnico = new DAOTecnico($pdo);
		$daoFuncionario = new DAOFuncionario($pdo);
		
		$daoTecnico->setListOffset($input['offset']);
		$daoTecnico->setListLength($input['entries']);
		$tecnicos = $daoTecnico->listAll();
		$total = $daoTecnico->countAll();
		
		$first = true;
		echo '{"entries": [';
		foreach ($tecnicos as $tecnico){
			$funcionario = $daoFuncionario->findById($tecnico->getIdFuncionario());
			
			if ($first){
				$first = false;
			}
			else{
				echo ',';
			}
			echo '{
				"id": '.$tecnico->getId().',
				"id_funcionario": '.$tecnico->getIdFuncionario().',
				"nome": "'.addslashes($funcionario->getNome()).'",
				"email": "'.addslashes($funcionario->getEmail()).'",
				"status": '.($tecnico->getAtivo()? 'true': 'false').'
			}';
		}
		echo '], "limit": '.$total.'}';
	} catch (Throwable $error) {
		echo '{"error": 500, "error_log": "'.addslashes($error).'"}';
		regError($error);
	}
?>