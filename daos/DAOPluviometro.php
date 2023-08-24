<?php
	class DAOPluviometro{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Pluviometro" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(string $cep, float $latitude, float $longitude): ?Pluviometro{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("insert into Pluviometro (cep, latitude, longitude) values (:cep, :latitude, :longitude)");
			$insertion->bindValue(":cep", $cep);
			$insertion->bindValue(":latitude", $latitude);
			$insertion->bindValue(":longitude", $longitude);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$last_id = intval($this->pdo->lastInsertId());
				return new Pluviometro($last_id, $cep, $latitude, $longitude);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Pluviometro" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(Pluviometro $pluviometro): bool{
			$insertion = $this->pdo->prepare("delete from Pluviometro where id = :id");
			$insertion->bindValue(":id", $pluviometro->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Pluviometro" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?Pluviometro{
			$statement = $this->pdo->query("select * from Pluviometro where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one

			if ($queries){
				$query = $queries[0];
				return new Pluviometro($id, $query['cep'], $query['latitude'], $query['longitude']);
			}
			return null;
		}
		
		// Return all records of "Pluviometro"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): ?array{
			$statement = $this->pdo->query("select * from Pluviometro");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new Pluviometro($query['id'], $query['cep'], $query['latitude'], $query['longitude']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Update the "Pluviometro" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(Pluviometro $pluviometro): bool{
			$insertion = $this->pdo->prepare("update Pluviometro set cep = :cep, latitude = :latitude, longitude = :longitude where id = :id");
			$insertion->bindValue(":id", $pluviometro->getId());
			$insertion->bindValue(":cep", $pluviometro->getCep());
			$insertion->bindValue(":latitude", $pluviometro->getLatitude());
			$insertion->bindValue(":longitude", $pluviometro->getLongitude());
			return $insertion->execute();
		}
	}
?>