<?php
	class DAOGestor{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Gestor" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(Funcionario $funcionario): ?Gestor{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("INSERT INTO Gestor (id_funcionario) VALUES (:id_funcionario)");
			$insertion->bindValue(":id_funcionario", $funcionario->getId());

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$lastId = intval($this->pdo->lastInsertId());
				return new Gestor($lastId, $funcionario->getId());
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Gestor" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(Gestor $gestor): bool{
			$insertion = $this->pdo->prepare("DELETE FROM Gestor WHERE id = :id");
			$insertion->bindValue(":id", $gestor->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Gestor" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?Gestor{
            $select = $this->pdo->prepare('SELECT * FROM Gestor WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Gestor($query['id'], $query['id_funcionario']);
            }
            return null;
		}
		
		// Find a single entry in the "Gestor" table by its 'Funcionario' attribute
		// Returns a model if found, returns null otherwise
		public function findByFuncionario(Funcionario $funcionario): ?Gestor{
            $select = $this->pdo->prepare('SELECT * FROM Gestor WHERE id_funcionario = :id_funcionario');
            $select->bindValue(':id_funcionario', $funcionario->getId());
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Gestor($query['id'], $query['id_funcionario']);
            }
            return null;
		}
		
		// Return all records of "Gestor"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): ?array{
            $select = $this->pdo->prepare('SELECT * FROM Gestor');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Gestor($query['id'], $query['id_funcionario']);
            }
            return $models;
		}
		
		// Update the "Gestor" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(Gestor $gestor): bool{
			$insertion = $this->pdo->prepare("UPDATE Gestor SET id_funcionario = :id_funcionario WHERE id = :id");
			$insertion->bindValue(":id", $gestor->getId());
			$insertion->bindValue(":id_funcionario", $gestor->getIdFuncionario());
			return $insertion->execute();
		}
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM Gestor; ALTER TABLE Gestor AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
	}
?>