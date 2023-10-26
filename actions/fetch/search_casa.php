<?php
	require '../conn.php';
	require '../session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '{"error":403}');
	
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../../models/Residencial.php';
	require '../../daos/DAOResidencial.php';
	require '../../models/Casa.php';
	require '../../daos/DAOCasa.php';
	
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	try {
		$daoResidencial = new DAOResidencial($pdo);
		$daoCasa = new DAOCasa($pdo);
		
		$daoCasa->setListOffset($input['offset']);
		$daoCasa->setListLength($input['entries']);
		
		$casas = $daoCasa->searchByText($input['text']);
		$total = $daoCasa->countByText($input['text']);
		
		$first = true;
		
		echo '{"entries": [';
		foreach($casas as $casa) {
			$residencial = $daoResidencial->findById($casa->getIdResidencial());
			if ($first){
				$first = false;
			}
			else {
				echo ',';
			}
			echo '{
			"id": "'.$casa->getId().'",
			"cep": "'.$residencial->getCep().'",
			"numero": "'.$residencial->getNumero().'",
			"complemento": "'.$casa->getComplemento().'"
			}';
		}
		echo '], "limit": '.$total.'}';
	}
	catch (Throwable $error){
		echo '{"error": 500}';
		regError($error);
	}
?>