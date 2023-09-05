<?php
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../conn.php';
	require '../../models/Civil.php';
	require '../../daos/DAOCivil.php';
	
	require '../../models/Ocorrencia.php';
	require '../../daos/DAOOcorrencia.php';
	require '../../models/Casa.php';
	require '../../daos/DAOCasa.php';
	require '../../models/Endereco.php';
	require '../../daos/DAOEndereco.php';
	
	$daoCivil = new DAOCivil($pdo);
	$daoOcorrencia = new DAOOcorrencia($pdo);
	$daoCasa = new DAOCasa($pdo);
	$daoEndereco = new DAOEndereco($pdo);
	
	$civil = $daoCivil->findById($input['id']);
	if ($civil == null){
		echo '{}';
		exit();
	}
	
	$casa = $civil->getIdCasa()!=null? $daoCasa->findById($civil->getIdCasa()): null;
	
	echo '{
		"id": '.$civil->getId().',
		"nome": "'.addslashes($civil->getNome()).'",
		"cep": "'.($casa? addslashes($casa->getCep()): '-Não Cadastrado-').'",
		"celular": "'.addslashes($civil->getCelular()).'",
		"email": "'.addslashes($civil->getEmail()).'",
		"cpf": "'.addslashes($civil->getCpf()).'",
		"telefone": "'.addslashes($civil->getTelefone()).'",
		"ocorrencias": [
		';
	
	$ocorrencias = $daoOcorrencia->listAll();
	$first = true;
	foreach ($ocorrencias as $ocorrencia){
	  $casa = $daoCasa->findById($ocorrencia->getIdCasa());
	  $endereco = $daoEndereco->findByCep($casa->getCep());
	  if ($ocorrencia->getIdCivil() == $civil->getId()){
	    
	    if ($first){
	    	$first = false;
	    }
	    else {
	    	echo ',';
	    }
	    echo '{
			"data": "'.addslashes(formatDate($ocorrencia->getDataOcorrencia())).'",
			"hora": "'.addslashes(formatTime($ocorrencia->getDataOcorrencia())).'",
			"rua": "'.addslashes($endereco->getRua()).'",
			"numero": "'.addslashes($casa->getNumero()).'",
			"bairro": "'.addslashes($endereco->getBairro()).'",
			"observacoes": "'.addslashes($ocorrencia->getRelatoCivil()).'"
	  	}';
	  }
	}
	
	echo ']}';
?>