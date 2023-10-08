<?php
	
	class DAOResidencial{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Residencial" into the table
		// Returns a model if the insertion is successful, otherwise returns null
			public function insert(string $cep, string $numero): ?Residencial{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("INSERT INTO Residencial (cep, numero) VALUES (:cep, :numero)");
			$insertion->bindValue(":cep", $cep);
			$insertion->bindValue(":numero", $numero);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$lastId = intval($this->pdo->lastInsertId());
				return new Residencial($lastId, $cep, $numero);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Residencial" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(Residencial $residencial): bool{
			$insertion = $this->pdo->prepare("DELETE FROM Residencial WHERE id = :id");
			$insertion->bindValue(":id", $residencial->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Residencial" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?Residencial{
            $select = $this->pdo->prepare('SELECT * FROM Residencial WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Residencial($query['id'], $query['cep'], $query['numero']);
            }
            return null;
		}
		
		// Find a single entry in the "Residencial" table
		// Returns a model if found, returns null otherwise
		public function findByCepNumero(string $cep, string $numero): ?Residencial{
            $select = $this->pdo->prepare('SELECT * FROM Residencial WHERE cep = :cep AND numero = :numero');
            $select->bindValue(':cep', $cep);
            $select->bindValue(':numero', $numero);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Residencial($query['id'], $query['cep'], $query['numero']);
            }
            return null;
		}
		
		// Return all records of "Residencial"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): array{
            $select = $this->pdo->prepare('SELECT * FROM Residencial');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Residencial($query['id'], $query['cep'], $query['numero']);
            }
            return $models;
		}
		
		// Update the "Residencial" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(Residencial $residencial): bool{
			$insertion = $this->pdo->prepare("UPDATE Residencial SET cep = :cep, numero = :numero WHERE id = :id");
			$insertion->bindValue(":id", $residencial->getId());
			$insertion->bindValue(":cep", $residencial->getCep());
			$insertion->bindValue(":numero", $residencial->getNumero());
			return $insertion->execute();
		}
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM Residencial; ALTER TABLE Residencial AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
	}
	
?>