<?php
	include_once("../actions/conn.php");
	include_once("../models/Cargo.php");
	
	class DAOCargo{
		private $pdo;
		
		public function __construct($pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Cargo" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert($nomeCargo) {
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("insert into Cargo (nome_cargo) values (:nome)");
			$insertion->bindValue(":nome", $nomeCargo);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$last_id = intval($this->pdo->lastInsertId());
				return new Cargo($last_id, $nomeCargo);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Cargo" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove($cargo) {
			$insertion = $this->pdo->prepare("delete from Cargo where id = :id");
			$insertion->bindValue(":id", $cargo->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Cargo" table
		// Returns a model if found, returns null otherwise
		public function findById($id) {
			$statement = $this->pdo->query("select * from Cargo where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one

			if ($queries){
				$query = $queries[0];
				return new Cargo($id, $query['nome_cargo']);
			}
			return null;
		}
		
		// Return all records of "Cargo"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll() {
			$statement = $this->pdo->query("select * from Cargo");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new Cargo($query['id'], $query['nome_cargo']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Update the "Afetados" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update($cargo) {
			$insertion = $this->pdo->prepare("update Cargo set nome_cargo = :nome_cargo where id = :id");
			$insertion->bindValue(":id", $cargo->getId());
			$insertion->bindValue(":nome_cargo", $cargo->getNomeCargo());
			return $insertion->execute();
		}
	}
?>