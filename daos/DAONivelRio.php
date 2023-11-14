<?php
    include_once $SERVER_LOCATION.'/daos/DAO.php';
    
	class DAONivelRio extends DAO{
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "NivelRio" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(Fluviometro $fluviometro, float $nivelRio, string $dataDiario): ?NivelRio{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("INSERT INTO NivelRio (id_fluviometro, nivel_rio, data_diario) VALUES (:fluviometro, :nivel_rio, :data_diario)");
			$insertion->bindValue(":fluviometro", $fluviometro->getId());
			$insertion->bindValue(":nivel_rio", $nivelRio);
			$insertion->bindValue(":data_diario", $dataDiario);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$lastId = intval($this->pdo->lastInsertId());
				return new NivelRio($lastId, $fluviometro->getId(), $nivelRio, $dataDiario);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "NivelRio" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(NivelRio $nivelRio): bool{
			$insertion = $this->pdo->prepare("DELETE FROM NivelRio WHERE id = :id");
			$insertion->bindValue(":id", $nivelRio->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "NivelRio" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?NivelRio{
            $select = $this->pdo->prepare('SELECT * FROM NivelRio WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new NivelRio($query['id'], $query['id_fluviometro'], $query['nivel_rio'], $query['data_diario']);
            }
            return null;
		}
		// Return all records of "NivelRio"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAllByFluv($id_fluviometro): array{
			$select = $this->pdo->prepare('SELECT * FROM NivelRio WHERE id_fluviometro = :id_fluviometro'.$this->sql_length.$this->sql_offset);
$select->bindValue(':id_fluviometro', $id_fluviometro);
			$select->execute();
			
			// All entries will be traversed
			$models = [];
			while (($query = $select->fetch())) {
					$models[] = new NivelRio($query['id'], $query['id_fluviometro'], $query['nivel_rio'], $query['data_diario']);
			}
			return $models;
}

		public function searchByText(string $text): array{
            $select = $this->pdo->prepare('SELECT NivelRio.id AS id, NivelRio.id_fluviometro AS id_fluviometro, NivelRio.nivel_rio AS nivel_rio, NivelRio.data_diario AS data_diario FROM NivelRio INNER JOIN Fluviometro ON NivelRio.id_fluviometro = Fluviometro.id INNER JOIN Endereco ON Fluviometro.cep = Endereco.cep WHERE Endereco.cep LIKE :text OR Endereco.rua LIKE :text OR Endereco.cidade LIKE :text OR Endereco.bairro LIKE :text OR NivelRio.nivel_rio LIKE :text'.$this->sql_length.$this->sql_offset);
            $select->bindValue(':text', '%'.$text.'%');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new NivelRio($query['id'], $query['id_fluviometro'], $query['nivel_rio'], $query['data_diario']);
            }
            return $models;
		}
		
		// Update the "NivelRio" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(NivelRio $nivelRio): bool{
			$insertion = $this->pdo->prepare("UPDATE NivelRio SET id_fluviometro = :id_fluviometro, nivel_rio = :nivel_rio, data_diario = :data_diario WHERE id = :id");
			$insertion->bindValue(":id", $nivelRio->getId());
			$insertion->bindValue(":id_fluviometro", $nivelRio->getIdFluviometro());
			$insertion->bindValue(":nivel_rio", $nivelRio->getNivelRio());
			$insertion->bindValue(":data_diario", $nivelRio->getDataDiario());
			return $insertion->execute();
		}
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM NivelRio; ALTER TABLE NivelRio AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
	}
?>