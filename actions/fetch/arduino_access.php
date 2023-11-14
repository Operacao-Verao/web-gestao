<?php
	session_start();
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../conn.php';
	
	//var_dump($input);
	//echo hash('SHA256', rand());
	
	if ($input==null || !isset($input['id']) || !isset($input['device'])){
		echo '0';
		exit();
	}
	
	// Just to ensure the device accessing the port is arduino with the correct key
	// Pluviômetro
	if ($input['device']==0){
		require '../../models/Pluviometro.php';
		require '../../daos/DAOPluviometro.php';
		
		$daoPluviometro = new DAOPluviometro($pdo);
		$pluviometro = $daoPluviometro->findById($input['id']);
		if ($pluviometro && $pluviometro->getAuthKey()==$input['key']){
			$pluviometro->setAuthToken(hash('SHA256', rand()));
			$daoPluviometro->update($pluviometro);
			echo $pluviometro->getAuthToken();
			exit();
		}
	}
	// Fluviômetro
	else {
		require '../../models/Fluviometro.php';
		require '../../daos/DAOFluviometro.php';
		
		$daoFluviometro = new DAOFluviometro($pdo);
		$fluviometro = $daoFluviometro->findById($input['id']);
		if ($fluviometro && $fluviometro->getAuthKey()==$input['key']){
			$fluviometro->setAuthToken(hash('SHA256', rand()));
			$daoFluviometro->update($fluviometro);
			echo $fluviometro->getAuthToken();
			exit();
		}
	}
	
	echo '0';
?>