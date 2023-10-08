<?php
	class DAOAlertaRio{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "AlertaRio" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(Fluviometro $fluviometro, string $statusRio, string $dataAlertaRio): ?AlertaRio{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("INSERT INTO AlertaRio (id_fluviometro, status_rio, data_alerta_rio) VALUES (:fluviometro, :status_rio, :data_alerta_rio)");
			$insertion->bindValue(":fluviometro", $fluviometro->getId());
			$insertion->bindValue(":status_rio", $statusRio);
			$insertion->bindValue(":data_alerta_rio", $dataAlertaRio);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$lastId = intval($this->pdo->lastInsertId());
				return new AlertaRio($lastId, $fluviometro->getId(), $statusRio, $dataAlertaRio);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "AlertaRio" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(AlertaRio $alertaRio): bool{
			$insertion = $this->pdo->prepare("DELETE FROM AlertaRio WHERE id = :id");
			$insertion->bindValue(":id", $alertaRio->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "AlertaRio" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?AlertaRio{
            $select = $this->pdo->prepare('SELECT * FROM AlertaRio WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new AlertaRio($query['id'], $query['id_fluviometro'], $query['status_rio'], $query['data_alerta_rio']);
            }
            return null;
		}
		
		// Return all records of "AlertaRio"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): array{
            $select = $this->pdo->prepare('SELECT * FROM AlertaRio ORDER BY AlertaRio.data_alerta_rio DESC');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new AlertaRio($query['id'], $query['id_fluviometro'], $query['status_rio'], $query['data_alerta_rio']);
            }
            return $models;
		}
		
		// Update the "AlertaRio" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(AlertaRio $alertaRio): bool{
			$insertion = $this->pdo->prepare("UPDATE AlertaRio SET id_fluviometro = :id_fluviometro, status_rio = :status_rio, data_alerta_rio = :data_alerta_rio WHERE id = :id");
			$insertion->bindValue(":id", $alertaRio->getId());
			$insertion->bindValue(":id_fluviometro", $alertaRio->getIdFluviometro());
			$insertion->bindValue(":status_rio", $alertaRio->getStatusRio());
			$insertion->bindValue(":data_alerta_rio", $alertaRio->getDataAlertaRio());
			return $insertion->execute();
		}
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM AlertaRio; ALTER TABLE AlertaRio AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
	}
?>