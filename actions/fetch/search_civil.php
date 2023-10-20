<?php
	require '../conn.php';
	require '../session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '["error:403"]');
	
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../../models/Civil.php';
	require '../../daos/DAOCivil.php';
	
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	try {
		$daoCivil = new DAOCivil($pdo);
		
		$civis = $daoCivil->searchByText($input['text']);
		
		$first = true;
		echo '[';
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
		echo ']';
	}
	catch (Throwable $error){
		echo '[]';
		regError($error);
	}
?>