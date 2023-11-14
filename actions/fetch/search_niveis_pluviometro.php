<?php
	require '../conn.php';
	require '../session_auth.php';
	
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../../models/Endereco.php';
	require '../../daos/DAOEndereco.php';
  require '../../models/Pluviometro.php';
	require '../../daos/DAOPluviometro.php';
	require '../../models/NivelChuva.php';
	require '../../daos/DAONivelChuva.php';
	
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	try {
		$daoEndereco = new DAOEndereco($pdo);
		$daoPluviometro = new DAOPluviometro($pdo);
		$daoNivelChuva = new DAONivelChuva($pdo);
		
		$niveis = null;

		$pluviometros = $daoPluviometro->listAll();

		echo '[';
			$first = true;
			foreach($pluviometros as $pluviometro) {
				if ($first) {
					$first = false;
				}
				else {
					echo ',';
				}
				
				$daoNivelChuva->setListLength(20);
				$niveis = $daoNivelChuva->listAllByPluv($pluviometro->getId());
			
				$endereco = $daoEndereco->findByCep($pluviometro->getCep());

				echo '{
					"id":'.$pluviometro->getId().',
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
								"nivel":'.$nivel->getChuvaEmMm().',
								"data":"'.addslashes(formatdate($nivel->getDataChuva())).'",
								"hora":"'.addslashes(formattime($nivel->getDataChuva())).'"
							}';
						}
					echo ']';
				echo '}';
			}
		echo ']';
	} catch (Throwable $error) {
		echo $error;
	}
?>