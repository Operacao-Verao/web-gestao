<?php
	include_once $SERVER_LOCATION.'/daos/DAO.php';
	
	class DAOSecretario extends DAO{
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Secretario" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(Secretaria $secretaria, Cargo $cargo, string $nomeSecretario): ?Secretario{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("INSERT INTO Secretario (id_secretaria, id_cargo, nome_secretario) VALUES (:secretaria, :cargo, :nome)");
			$insertion->bindValue(":secretaria", $secretaria->getId());
			$insertion->bindValue(":cargo", $cargo->getId());
			$insertion->bindValue(":nome", $nomeSecretario);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$lastId = intval($this->pdo->lastInsertId());
				return new Secretario($lastId, $secretaria->getId(), $cargo->getId(), $nomeSecretario);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Secretario" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(Secretario $secretario): bool{
			$insertion = $this->pdo->prepare("DELETE FROM Secretario WHERE id = :id");
			$insertion->bindValue(":id", $secretario->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Secretario" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?Secretario{
            $select = $this->pdo->prepare('SELECT * FROM Secretario WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Secretario($query['id'], $query['id_secretaria'], $query['id_cargo'], $query['nome_secretario']);
            }
            return null;
		}
		
		// Return all records of "Secretario"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): array{
            $select = $this->pdo->prepare('SELECT * FROM Secretario'.$this->sql_length.$this->sql_offset);
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Secretario($query['id'], $query['id_secretaria'], $query['id_cargo'], $query['nome_secretario']);
            }
            return $models;
		}
		
		// Count all records of "Secretario"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function countAll(): int{
            $select = $this->pdo->prepare('SELECT COUNT(*) FROM Secretario');
            $select->execute();
            
            return $select->fetch()[0];
		}
		
		// Update the "Secretario" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(Secretario $secretario): bool{
			$insertion = $this->pdo->prepare("UPDATE Secretario SET id_secretaria = :id_secretaria, id_cargo = :id_cargo, nome_secretario = :nome_secretario WHERE id = :id");
			$insertion->bindValue(":id", $secretario->getId());
			$insertion->bindValue(":id_secretaria", $secretario->getIdSecretaria());
			$insertion->bindValue(":id_cargo", $secretario->getIdCargo());
			$insertion->bindValue(":nome_secretario", $secretario->getNomeSecretario());
			return $insertion->execute();
		}
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM Secretario; ALTER TABLE Secretario AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
	}
?>