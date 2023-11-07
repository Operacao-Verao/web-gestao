<?php
	session_start();
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../conn.php';
	
	//var_dump($input);
	//echo hash('SHA256', rand());
	
	unset($_SESSION['arduino_id']);
	unset($_SESSION['arduino_device']);
	unset($_SESSION['arduino_token']);
	
	if ($input==null || !isset($input['id']) || !isset($input['device'])){
		echo '0';
		exit();
	}
	
	// Just to ensure the device accessing the port is arduino with the correct key
	if ($input['key']=='71bff9bd7d44d5b48f201d6e0129035ebbb912127bc7d6361577c13f68147ad2'){
		// Pluviômetro
		if ($input['device']==0){
			require '../../models/Pluviometro.php';
			require '../../daos/DAOPluviometro.php';
			
			$daoPluviometro = new DAOPluviometro($pdo);
			$pluviometro = $daoPluviometro->findById($input['id']);
			if ($pluviometro){
				$_SESSION['arduino_id'] = $input['id'];
				$_SESSION['arduino_device'] = $input['device'];
				$_SESSION['arduino_token'] = hash('SHA256', rand());
				echo $_SESSION['arduino_token'];
				exit();
			}
		}
		// Fluviômetro
		else {
			require '../../models/Fluviometro.php';
			require '../../daos/DAOFluviometro.php';
			
			$daoFluviometro = new DAOFluviometro($pdo);
			$fluviometro = $daoFluviometro->findById($input['id']);
			if ($fluviometro){
				$_SESSION['arduino_id'] = $input['id'];
				$_SESSION['arduino_device'] = $input['device'];
				$_SESSION['arduino_token'] = hash('SHA256', rand());
				echo $_SESSION['arduino_token'];
				exit();
			}
		}
	}
	
	echo '0';
?>