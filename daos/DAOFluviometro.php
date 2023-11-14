<?php
	class DAOFluviometro{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Fluviometro" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(string $cep, string $authKey, string $authToken, float $latitude, float $longitude): ?Fluviometro{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("INSERT INTO Fluviometro (cep, auth_key, auth_token, latitude, longitude) VALUES (:cep, :auth_key, :auth_token, :latitude, :longitude)");
			$insertion->bindValue(":cep", $cep);
			$insertion->bindValue(":auth_key", $authKey);
			$insertion->bindValue(":auth_token", $authToken);
			$insertion->bindValue(":latitude", $latitude);
			$insertion->bindValue(":longitude", $longitude);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$lastId = intval($this->pdo->lastInsertId());
				return new Fluviometro($lastId, $cep, $authKey, $authToken, $latitude, $longitude);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Fluviometro" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(Fluviometro $fluviometro): bool{
			$insertion = $this->pdo->prepare("DELETE FROM Fluviometro WHERE id = :id");
			$insertion->bindValue(":id", $fluviometro->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Fluviometro" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?Fluviometro{
            $select = $this->pdo->prepare('SELECT * FROM Fluviometro WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Fluviometro($query['id'], $query['cep'], $query['auth_key'], $query['auth_token'], $query['latitude'], $query['longitude']);
            }
            return null;
		}
		
		// Return all records of "Fluviometro"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): array{
            $select = $this->pdo->prepare('SELECT * FROM Fluviometro');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Fluviometro($query['id'], $query['cep'], $query['auth_key'], $query['auth_token'], $query['latitude'], $query['longitude']);
            }
            return $models;
		}
		
		// Update the "Fluviometro" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(Fluviometro $fluviometro): bool{
			$insertion = $this->pdo->prepare("UPDATE Fluviometro SET cep = :cep, auth_key = :auth_key, auth_token = :auth_token, latitude = :latitude, longitude = :longitude WHERE id = :id");
			$insertion->bindValue(":id", $fluviometro->getId());
			$insertion->bindValue(":cep", $fluviometro->getCep());
			$insertion->bindValue(":auth_key", $fluviometro->getAuthKey());
			$insertion->bindValue(":auth_token", $fluviometro->getAuthToken());
			$insertion->bindValue(":latitude", $fluviometro->getLatitude());
			$insertion->bindValue(":longitude", $fluviometro->getLongitude());
			return $insertion->execute();
		}
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM Fluviometro; ALTER TABLE Fluviometro AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
	}
?>