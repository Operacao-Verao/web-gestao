<?php
	require '../conn.php';
	require '../session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, 'Error 403');
	
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
			echo $input['interdicao'];
			$casa->setInterdicao(intval($input['interdicao']));
			$daoCasa->update($casa);
		}
	}
	catch (Throwable $error){
		echo 'null';
		regError($error);
	}
?>