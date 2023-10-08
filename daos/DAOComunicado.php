<?php
	class DAOComunicado{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Comunicado" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(Gestor $gestor, string $conteudo): ?Comunicado{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("INSERT INTO Comunicado (id_gestor, conteudo) VALUES (:gestor, :conteudo)");
			$insertion->bindValue(":gestor", $gestor->getId());
			$insertion->bindValue(":conteudo", $conteudo);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$lastId = intval($this->pdo->lastInsertId());
				return new Comunicado($lastId, $gestor->getId(), $conteudo);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Comunicado" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(Comunicado $comunicado): bool{
			$insertion = $this->pdo->prepare("DELETE FROM Comunicado WHERE id = :id");
			$insertion->bindValue(":id", $comunicado->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Comunicado" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?Comunicado{
            $select = $this->pdo->prepare('SELECT * FROM Comunicado WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Comunicado($query['id'], $query['id_gestor'], $query['conteudo']);
            }
            return null;
		}
		
		// Return all records of "Comunicado"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): array{
            $select = $this->pdo->prepare('SELECT * FROM Comunicado');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $modelos[] = new Comunicado($query['id'], $query['id_gestor'], $query['conteudo']);
            }
            return $models;
		}
		
		// Update the "Comunicado" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(Comunicado $comunicado): bool{
			$insertion = $this->pdo->prepare("UPDATE Comunicado SET id_gestor = :gestor, conteudo = :conteudo WHERE id = :id");
			$insertion->bindValue(":id", $comunicado->getId());
			$insertion->bindValue(":gestor", $comunicado->getIdGestor());
			$insertion->bindValue(":conteudo", $comunicado->getConteudo());
			return $insertion->execute();
		}
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM Comunicado; ALTER TABLE Comunicado AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
	}
?>