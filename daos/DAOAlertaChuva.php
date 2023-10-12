<?php
	class DAOAlertaChuva{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "AlertaChuva" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(Pluviometro $pluviometro, string $statusChuva, string $dataChuva): ?AlertaChuva{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("INSERT INTO AlertaChuva (id_pluviometro, status_chuva, data_chuva) VALUES (:pluviometro, :status_chuva, :data_chuva)");
			$insertion->bindValue(":pluviometro", $pluviometro->getId());
			$insertion->bindValue(":status_chuva", $statusChuva);
			$insertion->bindValue(":data_chuva", $dataChuva);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$lastId = intval($this->pdo->lastInsertId());
				return new AlertaChuva($lastId, $pluviometro->getId(), $statusChuva, $dataChuva);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "AlertaChuva" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(AlertaChuva $alertaChuva): bool{
			$insertion = $this->pdo->prepare("DELETE FROM AlertaChuva WHERE id = :id");
			$insertion->bindValue(":id", $alertaChuva->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "AlertaChuva" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?AlertaChuva{
            $select = $this->pdo->prepare('SELECT * FROM AlertaChuva WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
				return new AlertaChuva($query['id'], $query['id_pluviometro'], $query['status_chuva'], $query['data_chuva']);
            }
            return null;
		}
		
		// Return all records of "AlertaChuva"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): array{
            $select = $this->pdo->prepare('SELECT * FROM AlertaChuva ORDER BY AlertaChuva.data_chuva DESC');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
				$models[] = new AlertaChuva($query['id'], $query['id_pluviometro'], $query['status_chuva'], $query['data_chuva']);
            }
            return $models;
		}
		
		// Update the "AlertaChuva" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(AlertaChuva $alertaChuva): bool{
			$insertion = $this->pdo->prepare("UPDATE AlertaChuva SET id_pluviometro = :id_pluviometro, status_chuva = :status_chuva, data_chuva = :data_chuva WHERE id = :id");
			$insertion->bindValue(":id", $alertaChuva->getId());
			$insertion->bindValue(":id_pluviometro", $alertaChuva->getIdPluviometro());
			$insertion->bindValue(":status_chuva", $alertaChuva->getStatusChuva());
			$insertion->bindValue(":data_chuva", $alertaChuva->getDataChuva());
			return $insertion->execute();
		}
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM AlertaChuva; ALTER TABLE AlertaChuva AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
	}
?>