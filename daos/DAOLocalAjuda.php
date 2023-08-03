<?php
	include_once("../actions/conn.php");
	include_once("../models/LocalAjuda.php");
	
	class DAOLocalAjuda{
		private $pdo;
		
		public function __construct($pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "LocalAjuda" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert($cep, $tipo, $conteudo) {
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("insert into LocalAjuda (cep, tipo, conteudo) values (:cep, :tipo, :conteudo)");
			$insertion->bindValue(":cep", $cep);
			$insertion->bindValue(":tipo", $tipo);
			$insertion->bindValue(":conteudo", $conteudo);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$last_id = intval($this->pdo->lastInsertId());
				return new LocalAjuda($last_id, $cep, $tipo, $conteudo);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "LocalAjuda" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove($localAjuda) {
			$insertion = $this->pdo->prepare("delete from LocalAjuda where id = :id");
			$insertion->bindValue(":id", $localAjuda->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "LocalAjuda" table
		// Returns a model if found, returns null otherwise
		public function findById($id) {
			$statement = $this->pdo->query("select * from LocalAjuda where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one

			if ($queries){
				$query = $queries[0];
				return new LocalAjuda($id, $query['cep'], $query['tipo'], $query['conteudo']);
			}
			return null;
		}
		
		// Return all records of "LocalAjuda"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll() {
			$statement = $this->pdo->query("select * from LocalAjuda");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new LocalAjuda($query['id'], $query['cep'], $query['tipo'], $query['conteudo']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Update the "LocalAjuda" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update($localAjuda) {
			$insertion = $this->pdo->prepare("update LocalAjuda set cep = :cep, tipo = :tipo, conteudo = :conteudo where id = :id");
			$insertion->bindValue(":id", $localAjuda->getId());
			$insertion->bindValue(":cep", $localAjuda->getCep());
			$insertion->bindValue(":tipo", $localAjuda->getTipo());
			$insertion->bindValue(":conteudo", $localAjuda->getConteudo());
			return $insertion->execute();
		}
	}
?>