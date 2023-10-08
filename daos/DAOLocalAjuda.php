<?php
	class DAOLocalAjuda{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "LocalAjuda" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(string $cep, string $tipo, string $conteudo): ?LocalAjuda{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("INSERT INTO LocalAjuda (cep, tipo, conteudo) VALUES (:cep, :tipo, :conteudo)");
			$insertion->bindValue(":cep", $cep);
			$insertion->bindValue(":tipo", $tipo);
			$insertion->bindValue(":conteudo", $conteudo);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$lastId = intval($this->pdo->lastInsertId());
				return new LocalAjuda($lastId, $cep, $tipo, $conteudo);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "LocalAjuda" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(LocalAjuda $localAjuda): bool{
			$insertion = $this->pdo->prepare("DELETE FROM LocalAjuda WHERE id = :id");
			$insertion->bindValue(":id", $localAjuda->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "LocalAjuda" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?LocalAjuda{
            $select = $this->pdo->prepare('SELECT * FROM LocalAjuda WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new LocalAjuda($query['id'], $query['cep'], $query['tipo'], $query['conteudo']);
            }
            return null;
		}
		
		// Return all records of "LocalAjuda"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): array{
            $select = $this->pdo->prepare('SELECT * FROM LocalAjuda');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new LocalAjuda($query['id'], $query['cep'], $query['tipo'], $query['conteudo']);
            }
            return $models;
		}
		
		// Update the "LocalAjuda" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(LocalAjuda $localAjuda): bool{
			$insertion = $this->pdo->prepare("UPDATE LocalAjuda SET cep = :cep, tipo = :tipo, conteudo = :conteudo WHERE id = :id");
			$insertion->bindValue(":id", $localAjuda->getId());
			$insertion->bindValue(":cep", $localAjuda->getCep());
			$insertion->bindValue(":tipo", $localAjuda->getTipo());
			$insertion->bindValue(":conteudo", $localAjuda->getConteudo());
			return $insertion->execute();
		}
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM LocalAjuda; ALTER TABLE LocalAjuda AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
	}
?>