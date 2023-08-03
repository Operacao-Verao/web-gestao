<?php
	include_once("../actions/conn.php");
	include_once("../models/Tecnico.php");
	
	class DAOTecnico{
		private $pdo;
		
		public function __construct($pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Tecnico" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert($funcionario) {
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("insert into Tecnico (id_funcionario) values (:funcionario)");
			$insertion->bindValue(":funcionario", $funcionario->getId());

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$last_id = intval($this->pdo->lastInsertId());
				return new Tecnico($last_id, $funcionario->getId());
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Tecnico" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove($tecnico) {
			$insertion = $this->pdo->prepare("delete from Tecnico where id = :id");
			$insertion->bindValue(":id", $tecnico->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Tecnico" table
		// Returns a model if found, returns null otherwise
		public function findById($id) {
			$statement = $this->pdo->query("select * from Tecnico where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one
			if ($queries){
				$query = $queries[0];
				return new Tecnico($id, $query['id_funcionario']);
			}
			return null;
		}
		
		// Return all records of "Tecnico"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll() {
			$statement = $this->pdo->query("select * from Tecnico");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new Tecnico($query['id'], $query['id_funcionario']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Update the "Tecnico" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update($tecnico) {
			$insertion = $this->pdo->prepare("update Tecnico set id_funcionario = :funcionario where id = :id");
			$insertion->bindValue(":id", $tecnico->getId());
			$insertion->bindValue(":funcionario", $tecnico->getIdFuncionario());
			return $insertion->execute();
		}
	}
?>