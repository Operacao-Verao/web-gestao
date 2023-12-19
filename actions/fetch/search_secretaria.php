<?php
	require '../conn.php';
	require '../session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '{"error": 403}');
	
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../../models/Secretaria.php';
	require '../../daos/DAOSecretaria.php';

	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	try {
		$daoSecretaria = new DAOSecretaria($pdo);
		
		$daoSecretaria->setListOffset($input['offset']);
		$daoSecretaria->setListLength($input['entries']);
		$secretarias = $daoSecretaria->listAll();
		$total = $daoSecretaria->countAll();
		
		$first = true;
		echo '{"entries": [';
		foreach ($secretarias as $secretaria){
			if ($first){
				$first = false;
			}
			else{
				echo ',';
			}
			echo '{
				"id": '.$secretaria->getId().',
				"nome": "'.addslashes($secretaria->getNomeSecretaria()).'"
			}';
		}
		echo '], "limit": '.$total.'}';
	} catch (Throwable $error) {
		echo '{"error": 500, "error_log": "'.addslashes($error).'"}';
		regError($error);
	}
?>