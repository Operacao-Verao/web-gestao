<?php
	class DAOSecretaria{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Secretaria" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(string $nomeSecretaria): ?Secretaria{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("INSERT INTO Secretaria (nome_secretaria) VALUES (:nome_secretaria)");
			$insertion->bindValue(":nome_secretaria", $nomeSecretaria);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$lastId = intval($this->pdo->lastInsertId());
				return new Secretaria($lastId, $nomeSecretaria);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Secretaria" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(Secretaria $secretaria): bool{
			$insertion = $this->pdo->prepare("DELETE FROM Secretaria WHERE id = :id");
			$insertion->bindValue(":id", $secretaria->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Secretaria" table
		// Returns a model if found, returns null otherwise
		public function findById($id): ?Secretaria{
            $select = $this->pdo->prepare('SELECT * FROM Secretaria WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Secretaria($query['id'], $query['nome_secretaria']);
            }
            return null;
		}
		
		// Return all records of "Secretaria"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): array{
            $select = $this->pdo->prepare('SELECT * FROM Secretaria');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Secretaria($query['id'], $query['nome_secretaria']);
            }
            return $models;
		}
		
		// Update the "Secretaria" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(Secretaria $secretaria): bool{
			$insertion = $this->pdo->prepare("UPDATE Secretaria SET nome_secretaria = :nome_secretaria WHERE id = :id");
			$insertion->bindValue(":id", $secretaria->getId());
			$insertion->bindValue(":nome_secretaria", $secretaria->getNomeSecretaria());
			return $insertion->execute();
		}
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM Secretaria; ALTER TABLE Secretaria AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
	}
?>