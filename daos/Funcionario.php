<?php
	include_once("../actions/conn.php");
	include_once("../models/Funcionario.php");
	
	class DAOFuncionario{
		private $pdo;
		
		public function __construct($pdo) {
			$this->pdo = $pdo;
		}
		
		// Insere dados de funcionário na tabela
		// Retorna um modelo se for realizado com sucesso, retona nulo do contrário
		public function insert($nome, $email, $senha, $tipoUsuario) {
			// Tenta inserir os dados fornecidos no banco de dados
			$insertion = $this->pdo->prepare("insert into Funcionario (nome, email, senha, tipo_usuario) values (:nome, :email, :senha, :tipo)");
            $insertion->bindValue(":nome", $nome);
            $insertion->bindValue(":email", $email);
            $insertion->bindValue(":senha", $senha);
            $insertion->bindValue(":tipo", $tipoUsuario);
            
            // Tenta inserir, se for um sucesso, retorna o modelo correspondente
            if ($insertion->execute()){
            	// Resgata a id da última instância inserida, e retorna um modelo correspondente á ela
            	$last_id = intval($this->pdo->lastInsertId());
	            return new Funcionario($last_id, $nome, $email, $senha, $tipoUsuario);
            }
            
            // Do contrário retorna nulo
			return null;
		}
		
		// Remove a entrada de modelo Funcionario da tabela
		// Retorna true se for realizado com sucesso, do contrário retorna false
		public function remove($funcionario) {
			$insertion = $this->pdo->prepare("delete from Funcionario where id = :id");
            $insertion->bindValue(":id", $funcionario->getId());
            return $insertion->execute();
		}
		
		// Procura uma única entrada na tabela Funcionario
		// Retorna um modelo se for encontrado, retorna nulo do contrário
		public function findSingleById($id) {
            $statement = $this->pdo->query("select * from Funcionario where id = ".$id);
            $queries = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            // Apenas uma entrada será necessária, no caso, a primeira
            if ($queries){
            	$query = $queries[0];
            	return new Funcionario($id, $query['nome'], $query['email'], $query['senha'], $query['tipo_usuario']);
            }
			return null;
		}
		
		// Atualiza a entrada de Funcionario na tabela
		// Retorna true se for realizado com sucesso, do contrário retorna false
		public function update($funcionario) {
			$insertion = $this->pdo->prepare("update Funcionario set nome = :nome, email = :email, senha = :senha, tipo_usuario = :tipo where id = :id");
            $insertion->bindValue(":id", $funcionario->getId());
            $insertion->bindValue(":nome", $funcionario->getNome());
            $insertion->bindValue(":email", $funcionario->getEmail());
            $insertion->bindValue(":senha", $funcionario->getSenha());
            $insertion->bindValue(":tipo", $funcionario->getTipoUsuario());
            return $insertion->execute();
		}
	}
?>