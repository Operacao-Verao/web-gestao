<?php
	include_once("../daos/DAOFuncionario.php");
	include_once("../daos/DAORegistro.php");
	
	$daofuncionario = new DAOFuncionario($pdo);
	$daoregistro = new DAORegistro($pdo);
	
	// Exemplo de criação de Entrada na tabela Funcionário
	//$fun = $daofuncionario->insert("Andressa", "andressa@gmail.com", "12345678", TIPO_USUARIO::GESTOR);
	//var_dump($fun);
	
	// Se houver sido feito a inserção corretamente, o modelo fica disponível por meio da váriavel
	//if ($fun){
		// Alterando o modelo e atualizando
		//$fun->setSenha("senha-dificil");
		//$daofuncionario->update($fun);
	//}
	//var_dump($fun);
	
	// Buscando por entrada de Jorel no banco de dados
	//$fun = $daofuncionario->findById(8);
	//var_dump($fun);
	
	// Se for encontrado, o modelo fica disponível por meio da variável
	//if($fun){
		// Removendo a entrada da tabela
		//$daofuncionario->remove($fun);
	//}
	/*
	// Lista todos os funcionarios
	$regs = $daoregistro->listAll();
	foreach ($regs as $reg){
		var_dump($reg);
		echo '<br/>';
		//$daofuncionario->remove($fun);
	}*/
?>