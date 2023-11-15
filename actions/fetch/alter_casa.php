<?php
	require '../conn.php';
	require '../session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '{"error": 403}');
	
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../../models/Casa.php';
	require '../../daos/DAOCasa.php';
	require '../../models/Relatorio.php';
	require '../../daos/DAORelatorio.php';
	
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	try {
		$daoCasa = new DAOCasa($pdo);

		$casa = $daoCasa->findById($input['idCasa']); 

		if ($casa){
			$casa->setInterdicao(intval($input['interdicao']));
			$daoCasa->update($casa);
		}
		echo '{"status": "success"}';
	}
	catch (Throwable $error){
		echo '{"error": 500, "error_log": "'.addslashes($error).'"}';
		regError($error);
	}
?>