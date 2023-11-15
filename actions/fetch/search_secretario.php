<?php
	require '../conn.php';
	require '../session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '{"error": 403}');
	
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../../models/Cargo.php';
	require '../../daos/DAOCargo.php';
	require '../../models/Secretaria.php';
	require '../../daos/DAOSecretaria.php';
	require '../../models/Secretario.php';
	require '../../daos/DAOSecretario.php';

	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	try {
		$daoSecretario = new DAOSecretario($pdo);
		$daoSecretaria = new DAOSecretaria($pdo);
		$daoCargo = new DAOCargo($pdo);
		
		$daoSecretario->setListOffset($input['offset']);
		$daoSecretario->setListLength($input['entries']);
		$secretarios = $daoSecretario->listAll();
		$total = $daoSecretario->countAll();
		
		$first = true;
		echo '{"entries": [';
		foreach ($secretarios as $secretario){
			$secretaria = $daoSecretaria->findById($secretario->getIdSecretaria());
			$cargo = $daoCargo->findById($secretario->getIdCargo());
			
			if ($first){
				$first = false;
			}
			else{
				echo ',';
			}
			echo '{
				"id": '.$secretario->getId().',
				"nome": "'.addslashes($secretario->getNomeSecretario()).'",
				"id_secretaria": '.$secretaria->getId().',
				"secretaria": "'.addslashes($secretaria->getNomeSecretaria()).'",
				"id_cargo": '.$cargo->getId().',
				"cargo": "'.addslashes($cargo->getNomeCargo()).'"
			}';
		}
		echo '], "limit": '.$total.'}';
	} catch (Throwable $error) {
		echo '{"error": 500, "error_log": "'.addslashes($error).'"}';
		regError($error);
	}
?>