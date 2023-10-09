<?php
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../conn.php';
	require '../../models/Endereco.php';
	require '../../daos/DAOEndereco.php';
  	require '../../models/Pluviometro.php';
	require '../../daos/DAOPluviometro.php';
  	require '../../models/Fluviometro.php';
	require '../../daos/DAOFluviometro.php';
  	require '../../models/NivelRio.php';
	require '../../daos/DAONivelRio.php';
	require '../../models/NivelChuva.php';
	require '../../daos/DAONivelChuva.php';
	
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	try {
		$daoEndereco = new DAOEndereco($pdo);
		$daoFluviometro = new DAOFluviometro($pdo);
		$daoPluviometro = new DAOPluviometro($pdo);
		$daoNivelRio = new DAONivelRio($pdo);
		$daoNivelChuva = new DAONivelChuva($pdo);

		$niveis = null;

		$text = $input['text'];
		
		if($input['nivel']) {
			$niveis = $daoNivelRio->searchByText($text);
	
			echo '[';
					$first = true;
					foreach($niveis as $nivel) {
						$fluviometro = $daoFluviometro->findById($nivel->getIdFluviometro());
	
						$endereco = $daoEndereco->findByCep($fluviometro->getCep());
						
						if ($first) {
							$first = false;
						}
						else {
							echo ',';
						}
	
						echo '{
							"id":'.$nivel->getId().',
							"id_fluviometro":'.$nivel->getIdFluviometro().',
							"nivel":'.$nivel->getNivelRio().',
							"data":"'.addslashes(formatdate($nivel->getDataDiario())).'",
							"hora":"'.addslashes(formattime($nivel->getDataDiario())).'",
							"cep": '.addslashes($endereco->getCep()).',
							"rua": "'.addslashes($endereco->getRua()).'",
							"bairro": "'.addslashes($endereco->getBairro()).'",
							"cidade": "'.addslashes($endereco->getCidade()).'"
						}';
					}			
			echo ']';
	
		} else {
			$niveis = $daoNivelChuva->searchByText($text);
	
			echo '[';
					$first = true;
					foreach($niveis as $nivel) {
						$pluviometro = $daoPluviometro->findById($nivel->getIdPluviometro());
	
						$endereco = $daoEndereco->findByCep($pluviometro->getCep());
	
						if ($first) {
							$first = false;
						}
						else {
							echo ',';
						}
	
						echo '{
							"id":'.$nivel->getId().',
							"id_pluviometro":'.$nivel->getIdPluviometro().',
							"nivel":'.$nivel->getChuvaEmMm().',
							"data":"'.addslashes(formatdate($nivel->getDataChuva())).'",
							"hora":"'.addslashes(formattime($nivel->getDataChuva())).'",
							"cep": '.addslashes($endereco->getCep()).',
							"rua": "'.addslashes($endereco->getRua()).'",
							"bairro": "'.addslashes($endereco->getBairro()).'",
							"cidade": "'.addslashes($endereco->getCidade()).'"
						}';
					}			
			echo ']';
		}
	} catch (Throwable $error) {
		echo '[]';
		regError($error);
	}
?>