<?php
	include_once("../actions/conn.php");
	include_once("../models/Civil.php");
	
	class DAOCivil{
		private $pdo;
		
		public function __construct($pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Civil" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert($cep, $nome, $email, $senha, $cpf, $celular, $telefone) {
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("insert into Civil (cep, nome, email, senha, cpf, celular, telefone) values (:cep, :nome, :email, :senha, :cpf, :celular, :telefone)");
			$insertion->bindValue(":cep", $cep);
			$insertion->bindValue(":nome", $nome);
			$insertion->bindValue(":email", $email);
			$insertion->bindValue(":senha", $senha);
			$insertion->bindValue(":cpf", $cpf);
			$insertion->bindValue(":celular", $celular);
			$insertion->bindValue(":telefone", $telefone);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$last_id = intval($this->pdo->lastInsertId());
				return new Civil($last_id, $cep, $nome, $email, $senha, $cpf, $celular, $telefone);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Civil" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove($civil) {
			$insertion = $this->pdo->prepare("delete from Civil where id = :id");
			$insertion->bindValue(":id", $civil->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Civil" table
		// Returns a model if found, returns null otherwise
		public function findById($id) {
			$statement = $this->pdo->query("select * from Civil where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one

			if ($queries){
				$query = $queries[0];
				return new Civil($id, $query['cep'], $query['nome'], $query['email'], $query['senha'], $query['cpf'], $query['celular'], $query['telefone']);
			}
			return null;
		}
		
		// Return all records of "Civil"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll() {
			$statement = $this->pdo->query("select * from Civil");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new Civil($query['id'], $query['cep'], $query['nome'], $query['email'], $query['senha'], $query['cpf'], $query['celular'], $query['telefone']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Update the "Civil" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update($civil) {
			$insertion = $this->pdo->prepare("update Civil set cep = :cep, nome = :nome, email = :email, senha = :senha, cpf = :cpf, celular = :celular, telefone = :telefone where id = :id");
			$insertion->bindValue(":id", $civil->getId());
			$insertion->bindValue(":cep", $civil->getCep());
			$insertion->bindValue(":nome", $civil->getNome());
			$insertion->bindValue(":email", $civil->getEmail());
			$insertion->bindValue(":senha", $civil->getSenha());
			$insertion->bindValue(":cpf", $civil->getCpf());
			$insertion->bindValue(":celular", $civil->getCelular());
			$insertion->bindValue(":telefone", $civil->getTelefone());
			return $insertion->execute();
		}
	}
?>