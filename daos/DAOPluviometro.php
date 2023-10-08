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
			$insertion = $this->pdo->prepare("INSERT INTO Pluviometro (cep, latitude, longitude) VALUES (:cep, :latitude, :longitude)");
			$insertion->bindValue(":cep", $cep);
			$insertion->bindValue(":latitude", $latitude);
			$insertion->bindValue(":longitude", $longitude);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$lastId = intval($this->pdo->lastInsertId());
				return new Pluviometro($lastId, $cep, $latitude, $longitude);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Pluviometro" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(Pluviometro $pluviometro): bool{
			$insertion = $this->pdo->prepare("DELETE FROM Pluviometro WHERE id = :id");
			$insertion->bindValue(":id", $pluviometro->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Pluviometro" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?Pluviometro{
            $select = $this->pdo->prepare('SELECT * FROM Pluviometro WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Pluviometro($query['id'], $query['cep'], $query['latitude'], $query['longitude']);
            }
            return null;
		}
		
		// Return all records of "Pluviometro"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): array{
            $select = $this->pdo->prepare('SELECT * FROM Pluviometro');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Pluviometro($query['id'], $query['cep'], $query['latitude'], $query['longitude']);
            }
            return $models;
		}
		
		// Update the "Pluviometro" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(Pluviometro $pluviometro): bool{
			$insertion = $this->pdo->prepare("UPDATE Pluviometro SET cep = :cep, latitude = :latitude, longitude = :longitude WHERE id = :id");
			$insertion->bindValue(":id", $pluviometro->getId());
			$insertion->bindValue(":cep", $pluviometro->getCep());
			$insertion->bindValue(":latitude", $pluviometro->getLatitude());
			$insertion->bindValue(":longitude", $pluviometro->getLongitude());
			return $insertion->execute();
		}
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM Pluviometro; ALTER TABLE Pluviometro AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
	}
?>