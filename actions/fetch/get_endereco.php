<?php
	require '../conn.php';
	require '../session_auth.php';
	// Seems the internal server does not support session in Gets in local files
	//authenticateSession(TIPO_USUARIO::GESTOR, '{"error": 403}');
	
	require '../../models/Endereco.php';
	require '../../daos/DAOEndereco.php';
	
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	require '../../models/Registro.php';
	require '../../daos/DAORegistro.php';
	
	try {
		$extobj = null;
		
		// Try fetch from our database
		$daoEndereco = new DAOEndereco($pdo);
		$endereco = $daoEndereco->findByCep($_GET['cep']);
		if ($endereco){
			echo '{
				"cep": "'.addslashes($endereco->getCep()).'",
				"rua": "'.addslashes($endereco->getRua()).'",
				"bairro": "'.addslashes($endereco->getBairro()).'",
				"cidade": "'.addslashes($endereco->getCidade()).'",
				"estado": "SP"
			}';
		}
		
		// Try fetch from viacep
		else if (!($extobj = json_decode(file_get_contents('https://viacep.com.br/ws/'.$_GET['cep'].'/json/')))->erro){
			echo '{
				"cep": "'.addslashes($_GET['cep']).'",
				"rua": "'.addslashes($extobj->logradouro).'",
				"bairro": "'.addslashes($extobj->bairro).'",
				"cidade": "'.addslashes($extobj->localidade).'",
				"estado": "'.addslashes($extobj->uf).'"
			}';
		}
		
		// Give a wrong, tasty and hot error
		else {
			echo '{"error": 418}';
		}
	}
	catch (Throwable $error){
		echo '{"error": 500}';
		regError($error);
	}
?>