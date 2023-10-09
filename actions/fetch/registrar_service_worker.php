<?php
	session_start();

	require '../conn.php';
	require '../../models/ServiceWorker.php';
	require '../../daos/DAOServiceWorker.php';
	
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	try {
		$daoServiceWorker = new DAOServiceWorker($pdo);

		$input = json_decode(file_get_contents('php://input'), true);

		$swEndpoint = $input['endpoint'];
		$auth = $input['keys']['auth'];
		$p256dh = $input['keys']['p256dh'];
		$idGestor = $_SESSION["usuario_id"];
		
		$daoServiceWorker->insert($swEndpoint, $auth, $p256dh, $idGestor);  
		echo json_encode("Service Worker Succesfully created!");
	}
	catch (Throwable $error){
		echo json_encode("Error!");
		regError($error);
	}
?>