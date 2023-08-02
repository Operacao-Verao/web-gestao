<?php
	include_once("../actions/conn.php");
	include_once("../models/Fluviometro.php");
	
	class DAOFluviometro{
		private $pdo;
		
		public function __construct($pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Fluviometro" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert($cep, $latitude, $longitude) {
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("insert into Fluviometro (cep, latitude, longitude) values (:cep, :latitude, :longitude)");
			$insertion->bindValue(":cep", $cep);
			$insertion->bindValue(":latitude", $latitude);
			$insertion->bindValue(":longitude", $longitude);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$last_id = intval($this->pdo->lastInsertId());
				return new Fluviometro($last_id, $cep, $latitude, $longitude);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Fluviometro" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove($fluviometro) {
			$insertion = $this->pdo->prepare("delete from Fluviometro where id = :id");
			$insertion->bindValue(":id", $fluviometro->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Fluviometro" table
		// Returns a model if found, returns null otherwise
		public function findById($id) {
			$statement = $this->pdo->query("select * from Fluviometro where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one

			if ($queries){
				$query = $queries[0];
				return new Fluviometro($id, $query['cep'], $query['latitude'], $query['longitude']);
			}
			return null;
		}
		
		// Return all records of "Fluviometro"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll() {
			$statement = $this->pdo->query("select * from Fluviometro");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new Fluviometro($query['id'], $query['cep'], $query['latitude'], $query['longitude']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Update the "Fluviometro" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update($fluviometro) {
			$insertion = $this->pdo->prepare("update Fluviometro set cep = :cep, latitude = :latitude, longitude = :longitude where id = :id");
			$insertion->bindValue(":id", $fluviometro->getId());
			$insertion->bindValue(":cep", $fluviometro->getCep());
			$insertion->bindValue(":latitude", $fluviometro->getLatitude());
			$insertion->bindValue(":longitude", $fluviometro->getLongitude());
			return $insertion->execute();
		}
	}
?>