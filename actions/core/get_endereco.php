<?php
	$get_endereco_out = '';
	
	$extobj = null;
	
	// Try fetch from our database
	$daoEndereco = new DAOEndereco($pdo);
	$endereco = $daoEndereco->findByCep($in_get_endereco_cep);
	if ($endereco){
		$get_endereco_out = '{
			"cep": "'.addslashes($endereco->getCep()).'",
			"rua": "'.addslashes($endereco->getRua()).'",
			"bairro": "'.addslashes($endereco->getBairro()).'",
			"cidade": "'.addslashes($endereco->getCidade()).'",
			"estado": "SP"
		}';
	}
	
	// Try fetch from viacep
	else if (!isset(($extobj = json_decode(file_get_contents('https://viacep.com.br/ws/'.$in_get_endereco_cep.'/json/')))->erro) && $extobj!=null){
		$get_endereco_out = '{
			"cep": "'.addslashes($in_get_endereco_cep).'",
			"rua": "'.addslashes($extobj->logradouro).'",
			"bairro": "'.addslashes($extobj->bairro).'",
			"cidade": "'.addslashes($extobj->localidade).'",
			"estado": "'.addslashes($extobj->uf).'"
		}';
	}
	
	// Give a wrong, tasty and hot error
	else {
		$get_endereco_out = '{"error": 418}';
	}
?>