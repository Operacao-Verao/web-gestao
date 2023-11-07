<?php
	session_start();
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../conn.php';
	
	// A session as Arduino must be initialized
	if (!isset($_SESSION['arduino_id']) || !isset($_SESSION['arduino_device']) || !isset($_SESSION['arduino_token'])){
		echo '0';
		exit();
	}
	// Check if the token in the device matches the session token
	if ($input['token'] != $_SESSION['arduino_token']){
		echo '0';
		exit();
	}
	
	// Pluviômetro
	if ($_SESSION['arduino_device']==0){
		require '../../models/Pluviometro.php';
		require '../../daos/DAOPluviometro.php';
		require '../../models/NivelChuva.php';
		require '../../daos/DAONivelChuva.php';
		
		$daoPluviometro = new DAOPluviometro($pdo);
		$daoNivelChuva = new DAONivelChuva($pdo);
		
		$pluviometro = $daoPluviometro->findById($input['id']);
		$daoNivelChuva->insert($pluviometro, $input['medida'], getCurrentDatetime());
		echo '1';
	}
	// Fluviômetro
	else {
		require '../../models/Fluviometro.php';
		require '../../daos/DAOFluviometro.php';
		require '../../models/NivelRio.php';
		require '../../daos/DAONivelRio.php';
		
		$daoFluviometro = new DAOFluviometro($pdo);
		$daoNivelRio = new DAONivelRio($pdo);
		
		$fluviometro = $daoFluviometro->findById($input['id']);
		$daoNivelRio->insert($fluviometro, $input['medida'], getCurrentDatetime());
		echo '1';
	}
?>