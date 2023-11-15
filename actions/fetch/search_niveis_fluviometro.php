<?php
	require '../conn.php';
	require '../session_auth.php';
	
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../../models/Endereco.php';
	require '../../daos/DAOEndereco.php';
	require '../../models/Fluviometro.php';
	require '../../daos/DAOFluviometro.php';
	require '../../models/NivelRio.php';
	require '../../daos/DAONivelRio.php';
	
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	try {
		$daoEndereco = new DAOEndereco($pdo);
		$daoFluviometro = new DAOFluviometro($pdo);
		$daoNivelRio = new DAONivelRio($pdo);
		
		$niveis = null;

		$fluviometros = $daoFluviometro->listAll();

		echo '[';
			$first = true;
			foreach($fluviometros as $fluviometro) {
				if ($first) {
					$first = false;
				}
				else {
					echo ',';
				}
				
				$daoNivelRio->setListLength(20);
				$niveis = $daoNivelRio->listAllByFluv($fluviometro->getId());
			
				$endereco = $daoEndereco->findByCep($fluviometro->getCep());

				echo '{
					"id":'.$fluviometro->getId().',
					"cep": "'.addslashes($endereco->getCep()).'",
					"rua": "'.addslashes($endereco->getRua()).'",
					"bairro": "'.addslashes($endereco->getBairro()).'",
					"cidade": "'.addslashes($endereco->getCidade()).'",';
					echo '"registros": [';
						$first_nivel = true;
						foreach($niveis as $nivel) {
							if ($first_nivel) {
								$first_nivel = false;
							}
							else {
								echo ',';
							}

							echo '{
								"nivel":'.$nivel->getNivelRio().',
								"data":"'.addslashes(formatDate($nivel->getDataDiario(), false)).'",
								"hora":"'.addslashes(formatTime($nivel->getDataDiario())).'"
							}';
						}
					echo ']';
				echo '}';
			}
		echo ']';
	} catch (Throwable $error) {
		echo '{"error": 500, "error_log": "'.addslashes($error).'"}';
		echo $error;
	}
?>