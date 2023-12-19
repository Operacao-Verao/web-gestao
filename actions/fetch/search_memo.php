<?php
	require '../conn.php';
	require '../session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '{"error": 403}');
	
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../../models/Memo.php';
	require '../../daos/DAOMemo.php';
	require '../../models/Relatorio.php';
	require '../../daos/DAORelatorio.php';
	require '../../models/Residencial.php';
	require '../../daos/DAOResidencial.php';
	require '../../models/Casa.php';
	require '../../daos/DAOCasa.php';
	require '../../models/Endereco.php';
	require '../../daos/DAOEndereco.php';
	
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	try {
		$daoMemo = new DAOMemo($pdo);
		$daoRelatorio = new DAORelatorio($pdo);
		$daoResidencial = new DAOResidencial($pdo);
		$daoCasa = new DAOCasa($pdo);
		$daoEndereco = new DAOEndereco($pdo);
		
		$daoMemo->setListOffset($input['offset']);
		$daoMemo->setListLength($input['entries']);
		
		$memos = $daoMemo->searchByText($input['text']);
		$total = $daoMemo->countByText($input['text']);
		
		$first = true;
		echo '{"entries": [';
		foreach ($memos as $memo){
			$relatorio = $daoRelatorio->findById($memo->getIdRelatorio());
			$casa = $daoCasa->findById($relatorio->getIdCasa());
			$residencial = $daoResidencial->findById($casa->getIdResidencial());
			$endereco = $daoEndereco->findByCep($residencial->getCep());
			
			if ($first){
				$first = false;
			}
			else{
				echo ',';
			}
			echo '{
				"id": '.$relatorio->getId().',
				"data": "'.addslashes(formatDate($memo->getDataMemo())).'",
				"hora": "'.addslashes(formatTime($memo->getDataMemo())).'",
				"rua": "'.addslashes($endereco->getRua()).'",
				"numero": "'.addslashes($residencial->getNumero()).'",
				"bairro": "'.addslashes($endereco->getBairro()).'",
				"memorando": "'.addslashes($memo->getMemorando()).'"
			}';
		}
		echo '], "limit": '.$total.'}';
	} catch (Throwable $error) {
		echo '{"error": 500, "error_log": "'.addslashes($error).'"}';
		regError($error);
	}
?>