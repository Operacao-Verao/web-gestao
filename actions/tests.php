<?php
	include_once("../daos/Funcionario.php");
	
	$daofuncionario = new DAOFuncionario($pdo);
	
	// Exemplo de criação de Entrada na tabela Funcionário
	$fun = $daofuncionario->insert("Jorel", "jorel@gmail.com", "senha-facil", TIPO_USUARIO_GESTOR);
	var_dump($fun);
	
	// Se houver sido feito a inserção corretamente, o modelo fica disponível por meio da váriavel
	if ($fun){
		// Alterando o modelo e atualizando
		$fun->setSenha("senha-dificil");
		$daofuncionario->update($fun);
	}
	var_dump($fun);
	
	// Buscando por entrada de Jorel no banco de dados
	$fun = $daofuncionario->findSingleById(8);
	var_dump($fun);
	
	// Se for encontrado, o modelo fica disponível por meio da variável
	if($fun){
		// Removendo a entrada da tabela
		//$daofuncionario->remove($fun);
	}
?>