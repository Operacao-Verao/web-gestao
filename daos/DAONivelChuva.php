<?php
	include_once("../actions/conn.php");
	include_once("../models/NivelChuva.php");
	
	class DAONivelChuva{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "NivelChuva" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(Pluviometro $pluviometro, float $chuvaEmMm, string $dataChuva): ?NivelChuva{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("insert into NivelChuva (id_pluviometro, chuva_em_mm, data_chuva) values (:pluviometro, :chuva_em_mm, :data_chuva)");
			$insertion->bindValue(":pluviometro", $pluviometro->getId());
			$insertion->bindValue(":chuva_em_mm", $chuvaEmMm);
			$insertion->bindValue(":data_chuva", $dataChuva);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$last_id = intval($this->pdo->lastInsertId());
				return new NivelChuva($last_id, $pluviometro->getId(), $chuvaEmMm, $dataChuva);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "NivelChuva" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(NivelChuva $nivelChuva): bool{
			$insertion = $this->pdo->prepare("delete from NivelChuva where id = :id");
			$insertion->bindValue(":id", $nivelChuva->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "NivelChuva" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?NivelChuva{
			$statement = $this->pdo->query("select * from NivelChuva where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one
			if ($queries){
				$query = $queries[0];
				return new NivelChuva($id, $query['id_pluviometro'], $query['chuva_em_mm'], $query['data_chuva']);
			}
			return null;
		}
		
		// Return all records of "NivelChuva"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): ?array{
			$statement = $this->pdo->query("select * from NivelChuva");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new NivelChuva($query['id'], $query['id_pluviometro'], $query['chuva_em_mm'], $query['data_chuva']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Update the "NivelChuva" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(NivelChuva $nivelChuva): bool{
			$insertion = $this->pdo->prepare("update NivelChuva set id_pluviometro = :id_pluviometro, chuva_em_mm = :chuva_em_mm, data_chuva = :data_chuva where id = :id");
			$insertion->bindValue(":id", $nivelChuva->getId());
			$insertion->bindValue(":id_pluviometro", $nivelChuva->getIdPluviometro());
			$insertion->bindValue(":chuva_em_mm", $nivelChuva->getChuvaEmMm());
			$insertion->bindValue(":data_chuva", $nivelChuva->getDataChuva());
			return $insertion->execute();
		}
	}
?>