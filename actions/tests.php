<?php
	include_once("../daos/Funcionario.php");
	
	$daofuncionario = new DAOFuncionario($pdo);
	
	$funci = $daofuncionario->findSingleById(5);
	$funci->setEmail("mariabrega@gmail.com");
	$daofuncionario->update($funci);
	var_dump($funci);
	
?>