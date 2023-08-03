<?php
	include_once("../actions/conn.php");
	include_once("../models/Secretaria.php");
	
	class DAOSecretaria{
		private $pdo;
		
		public function __construct($pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Secretaria" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert($nomeSecretaria) {
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("insert into Secretaria (nome_secretaria) values (:nome)");
			$insertion->bindValue(":nome", $nomeSecretaria);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$last_id = intval($this->pdo->lastInsertId());
				return new Secretaria($last_id, $nomeSecretaria);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Secretaria" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove($secretaria) {
			$insertion = $this->pdo->prepare("delete from Secretaria where id = :id");
			$insertion->bindValue(":id", $secretaria->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Secretaria" table
		// Returns a model if found, returns null otherwise
		public function findById($id) {
			$statement = $this->pdo->query("select * from Secretaria where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one

			if ($queries){
				$query = $queries[0];
				return new Secretaria($id, $query['nome_secretaria']);
			}
			return null;
		}
		
		// Return all records of "Secretaria"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll() {
			$statement = $this->pdo->query("select * from Secretaria");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new Secretaria($query['id'], $query['nome_secretaria']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Update the "Secretaria" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update($secretaria) {
			$insertion = $this->pdo->prepare("update Secretaria set nome_secretaria = :nome_secretaria where id = :id");
			$insertion->bindValue(":id", $secretaria->getId());
			$insertion->bindValue(":nome_secretaria", $secretaria->getNomeSecretaria());
			return $insertion->execute();
		}
	}
?>