<?php
	require '../conn.php';
	require '../session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '{"error":403}');
	
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../../models/Civil.php';
	require '../../daos/DAOCivil.php';
	
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	try {
		$daoCivil = new DAOCivil($pdo);
		
		$daoCivil->setListOffset($input['offset']);
		$daoCivil->setListLength($input['entries']);
		
		$civis = $daoCivil->searchByText($input['text']);
		$total = $daoCivil->countByText($input['text']);
		
		$first = true;
		echo '{"entries": [';
		foreach ($civis as $civil){
			if ($first){
				$first = false;
			}
			else{
				echo ',';
			}
			echo '{
				"id": '.$civil->getId().',
				"nome": "'.addslashes($civil->getNome()).'",
				"email": "'.addslashes($civil->getEmail()).'",
				"cpf": "'.addslashes($civil->getCpf()).'"
				}';
		}
		echo '], "limit": '.$total.'}';
	}
	catch (Throwable $error){
		echo '{"error": 500}';
		regError($error);
	}
?>