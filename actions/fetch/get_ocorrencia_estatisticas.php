<?php
	require '../conn.php';
	require '../session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '{"error": 403}');
	
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../../models/Ocorrencia.php';
	require '../../daos/DAOOcorrencia.php';
	require '../../models/Relatorio.php';
	require '../../daos/DAORelatorio.php';
	
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	try {
		$daoOcorrencia = new DAOOcorrencia($pdo);
		$daoRelatorio = new DAORelatorio($pdo);
		
		$ranges = array();
		for ($ri=0; $ri<6; $ri++){
			$date = getCurrentDate();
			$rank = $daoOcorrencia->statisticsGreaterByBairro($date, ($ri+1)*5-1, $ri*5, $input['rank'], true);
			$date = date_sub(date_create($date), date_interval_create_from_date_string((($ri+1)*5-1).' days'));
			$ranges[] = array("rank" => $rank, "data" => formatDate(date_format($date,"Y-m-d")));
		}
		
		$ocorrencias_abertas = $daoOcorrencia->statisticsAbertas();
		$relatorios = $daoRelatorio->statisticsRecent();
		
		$aprovados = $daoOcorrencia->statisticsTotal(true);
		$desaprovados = $daoOcorrencia->statisticsTotal(false);
		
		$interditados = $daoRelatorio->statisticsTotal(true);
		$nao_interditados = $daoRelatorio->statisticsTotal(false);
		
		echo json_encode(array('ranges' => $ranges, 'aprovados' => $aprovados, 'desaprovados' => $desaprovados, 'interditados' => $interditados, 'nao_interditados' => $nao_interditados, 'ocorrencias_abertas' => $ocorrencias_abertas, 'relatorios' => $relatorios), true);
	}
	catch (Throwable $error){
		echo '{"error": 500, "error_log": "'.addslashes($error).'"}';
		regError($error);
	}
?>