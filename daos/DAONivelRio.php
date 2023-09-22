<?php
	class DAONivelRio{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "NivelRio" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(Fluviometro $fluviometro, float $nivelRio, string $dataDiario): ?NivelRio{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("insert into NivelRio (id_fluviometro, nivel_rio, data_diario) values (:fluviometro, :nivel_rio, :data_diario)");
			$insertion->bindValue(":fluviometro", $fluviometro->getId());
			$insertion->bindValue(":nivel_rio", $nivelRio);
			$insertion->bindValue(":data_diario", $dataDiario);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$last_id = intval($this->pdo->lastInsertId());
				return new NivelRio($last_id, $fluviometro->getId(), $nivelRio, $dataDiario);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "NivelRio" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(NivelRio $nivelRio): bool{
			$insertion = $this->pdo->prepare("delete from NivelRio where id = :id");
			$insertion->bindValue(":id", $nivelRio->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "NivelRio" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?NivelRio{
			$statement = $this->pdo->query("select * from NivelRio where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one
			if ($queries){
				$query = $queries[0];
				return new NivelRio($id, $query['id_fluviometro'], $query['nivel_rio'], $query['data_diario']);
			}
			return null;
		}
		// Return all records of "NivelRio"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): ?array{
			$statement = $this->pdo->query("select * from NivelRio");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new NivelRio($query['id'], $query['id_fluviometro'], $query['nivel_rio'], $query['data_diario']);
				}
				return $modelos;
			}
			return [];
		}

		public function searchByText(string $text): ?array{
			$statement = $this->pdo->query('select * from NivelRio join Fluviometro on NivelRio.id_fluviometro = Fluviometro.id join Endereco on Fluviometro.cep = Endereco.cep where Endereco.cep like "%'.$text.'%" or Endereco.rua like "%'.$text.'%" or Endereco.cidade like "%'.$text.'%" or Endereco.bairro like "%'.$text.'%" or nivel_rio like "%'.$text.'%"');
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new NivelRio($query['id'], $query['id_fluviometro'], $query['nivel_rio'], $query['data_diario']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Update the "NivelRio" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(NivelRio $nivelRio): bool{
			$insertion = $this->pdo->prepare("update NivelRio set id_fluviometro = :id_fluviometro, nivel_rio = :nivel_rio, data_diario = :data_diario where id = :id");
			$insertion->bindValue(":id", $nivelRio->getId());
			$insertion->bindValue(":id_fluviometro", $nivelRio->getIdFluviometro());
			$insertion->bindValue(":nivel_rio", $nivelRio->getNivelRio());
			$insertion->bindValue(":data_diario", $nivelRio->getDataDiario());
			return $insertion->execute();
		}
	}
?>