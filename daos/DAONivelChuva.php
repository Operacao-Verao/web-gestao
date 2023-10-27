<?php
	class DAONivelChuva{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "NivelChuva" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(Pluviometro $pluviometro, float $chuvaEmMm, string $dataChuva): ?NivelChuva{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("INSERT INTO NivelChuva (id_pluviometro, chuva_em_mm, data_chuva) values (:pluviometro, :chuva_em_mm, :data_chuva)");
			$insertion->bindValue(":pluviometro", $pluviometro->getId());
			$insertion->bindValue(":chuva_em_mm", $chuvaEmMm);
			$insertion->bindValue(":data_chuva", $dataChuva);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$lastId = intval($this->pdo->lastInsertId());
				return new NivelChuva($lastId, $pluviometro->getId(), $chuvaEmMm, $dataChuva);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "NivelChuva" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(NivelChuva $nivelChuva): bool{
			$insertion = $this->pdo->prepare("DELETE FROM NivelChuva WHERE id = :id");
			$insertion->bindValue(":id", $nivelChuva->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "NivelChuva" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?NivelChuva{
            $select = $this->pdo->prepare('SELECT * FROM NivelChuva WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new NivelChuva($query['id'], $query['id_pluviometro'], $query['chuva_em_mm'], $query['data_chuva']);
            }
            return null;
		}
		
		// Return all records of "NivelChuva"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAllByPluv($id_pluviometro): array{
			$select = $this->pdo->prepare('SELECT * FROM NivelChuva WHERE id_pluviometro = :id_pluviometro');
$select->bindValue(':id_pluviometro', $id_pluviometro);
			$select->execute();
			
			// All entries will be traversed
			$models = [];
			while (($query = $select->fetch())) {
					$models[] = new NivelChuva($query['id'], $query['id_pluviometro'], $query['chuva_em_mm'], $query['data_chuva']);
			}
			return $models;
}

		// Search for all entries in "NivelChuva" by text
		// Returns an array with all the found models, returns an empty array in case of an error
		public function searchByText(string $text): array{
            $select = $this->pdo->prepare('SELECT NivelChuva.id AS id, NivelChuva.id_pluviometro AS id_pluviometro, NivelChuva.chuva_em_mm AS chuva_em_mm, NivelChuva.data_chuva AS data_chuva FROM NivelChuva INNER JOIN Pluviometro ON NivelChuva.id_pluviometro = Pluviometro.id INNER JOIN Endereco ON Pluviometro.cep = Endereco.cep WHERE Endereco.cep LIKE :text OR Endereco.rua LIKE :text OR Endereco.cidade LIKE :text OR Endereco.bairro LIKE :text OR NivelChuva.chuva_em_mm LIKE :text');
            $select->bindValue(':text', '%'.$text.'%');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new NivelChuva($query['id'], $query['id_pluviometro'], $query['chuva_em_mm'], $query['data_chuva']);
            }
            return $models;
		}
		
		// Update the "NivelChuva" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(NivelChuva $nivelChuva): bool{
			$insertion = $this->pdo->prepare("UPDATE NivelChuva SET id_pluviometro = :id_pluviometro, chuva_em_mm = :chuva_em_mm, data_chuva = :data_chuva WHERE id = :id");
			$insertion->bindValue(":id", $nivelChuva->getId());
			$insertion->bindValue(":id_pluviometro", $nivelChuva->getIdPluviometro());
			$insertion->bindValue(":chuva_em_mm", $nivelChuva->getChuvaEmMm());
			$insertion->bindValue(":data_chuva", $nivelChuva->getDataChuva());
			return $insertion->execute();
		}
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM NivelChuva; ALTER TABLE NivelChuva AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
	}
?>