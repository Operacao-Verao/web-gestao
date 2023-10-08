<?php
	class DAOCargo{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Cargo" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(string $nomeCargo): ?Cargo{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("INSERT INTO Cargo (nome_cargo) VALUES (:nome)");
			$insertion->bindValue(":nome", $nomeCargo);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$lastId = intval($this->pdo->lastInsertId());
				return new Cargo($lastId, $nomeCargo);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Cargo" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(Cargo $cargo): bool{
			$insertion = $this->pdo->prepare("DELETE FROM Cargo WHERE id = :id");
			$insertion->bindValue(":id", $cargo->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Cargo" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?Cargo{
            $select = $this->pdo->prepare('SELECT * FROM Cargo WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Cargo($query['id'], $query['nome_cargo']);
            }
            return null;
		}
		
		// Return all records of "Cargo"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): array{
            $select = $this->pdo->prepare('SELECT * FROM Cargo');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
				$modelos[] = new Cargo($query['id'], $query['nome_cargo']);
            }
            return $models;
		}
		
		// Update the "Cargo" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(Cargo $cargo): bool{
			$insertion = $this->pdo->prepare("UPDATE Cargo SET nome_cargo = :nome_cargo WHERE id = :id");
			$insertion->bindValue(":id", $cargo->getId());
			$insertion->bindValue(":nome_cargo", $cargo->getNomeCargo());
			return $insertion->execute();
		}
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM Cargo; ALTER TABLE Cargo AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
	}
?>