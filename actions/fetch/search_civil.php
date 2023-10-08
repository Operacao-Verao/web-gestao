<?php
	$input = json_decode(file_get_contents('php://input'), true);
	
	require '../conn.php';
	require '../../models/Civil.php';
	require '../../daos/DAOCivil.php';
	
	$daoCivil = new DAOCivil($pdo);
	
	$civis = $daoCivil->searchByText($input['text']);
	
	$first = true;
	echo '[';
	foreach ($civis as $civil){
		if ($first){
			$first = false;
		}
		else{
			echo ',';
		}
		echo '{
			"id": '.$civil->getId().',
			"nome": "'.addslashes($civil->getNome()).'",
			"email": "'.addslashes($civil->getEmail()).'",
			"cpf": "'.addslashes($civil->getCpf()).'"
			}';
	}
	echo ']';
?>