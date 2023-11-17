<?php
	require '../conn.php';
	require '../session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '{"error": 403}');
	
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../../models/Casa.php';
	require '../../daos/DAOCasa.php';
	require '../../models/Residencial.php';
	require '../../daos/DAOResidencial.php';
	require '../../models/Relatorio.php';
	require '../../daos/DAORelatorio.php';
	
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	try {
		$daoCasa = new DAOCasa($pdo);
		$daoResidencial = new DAOResidencial($pdo);
		
		$casa = $daoCasa->findById($input['idCasa']); 

		if ($casa){
			$residencial = $daoResidencial->findById($casa->getIdResidencial());
			$casa->setInterdicao(intval($input['interdicao']));
			$daoCasa->update($casa);
			
	        regLog(REG_ACAO::ALT_CASA, 'Cep: '.$residencial->getCep().'; Numero: '.$residencial->getNumero().'; Interdicao: '.($casa->getInterdicao()==INTERDICAO::NAO? 'Não': ($casa->getInterdicao()==INTERDICAO::PARCIAL? 'Parcial': ($casa->getInterdicao()==INTERDICAO::TOTAL? 'Total': '-Invalid-'))).'; Complemento: '.$casa->getComplemento().'; Id: '.$casa->getId());
		}
		echo '{"status": "success"}';
	}
	catch (Throwable $error){
		echo '{"error": 500, "error_log": "'.addslashes($error).'"}';
		regError($error);
	}
?>