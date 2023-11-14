<?php
	session_start();
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../conn.php';
	
	// A session as Arduino must be initialized
	if (!isset($input['id']) || !isset($input['device']) || !isset($input['token']) || !isset($input['medida'])){
		echo '0';
		exit();
	}
	
	// Just to ensure the device accessing the port is arduino with the correct key
	// Pluviômetro
	if ($input['device']==0){
		require '../../models/Pluviometro.php';
		require '../../daos/DAOPluviometro.php';
		require '../../models/NivelChuva.php';
		require '../../daos/DAONivelChuva.php';
		
		$daoPluviometro = new DAOPluviometro($pdo);
		$daoNivelChuva = new DAONivelChuva($pdo);
		$pluviometro = $daoPluviometro->findById($input['id']);
		if ($pluviometro && $pluviometro->getAuthToken()==$input['token']){
			$daoNivelChuva->insert($pluviometro, $input['medida'], getCurrentDatetime());
			echo '1';
			exit();
		}
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
		if ($fluviometro && $fluviometro->getAuthToken()==$input['token']){
			$daoNivelRio->insert($fluviometro, $input['medida'], getCurrentDatetime());
			echo '1';
			exit();
		}
	}
	
	echo '0';
	exit();
?>