<?php
	include_once("../actions/conn.php");
	include_once("../models/AlertaRio.php");
	
	class DAOAlertaRio{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "AlertaRio" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(Fluviometro $fluviometro, string $statusRio, string $dataAlertaRio): ?AlertaRio{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("insert into AlertaRio (id_fluviometro, status_rio, data_alerta_rio) values (:fluviometro, :status_rio, :data_alerta_rio)");
			$insertion->bindValue(":fluviometro", $fluviometro->getId());
			$insertion->bindValue(":status_rio", $statusRio);
			$insertion->bindValue(":data_alerta_rio", $dataAlertaRio);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$last_id = intval($this->pdo->lastInsertId());
				return new AlertaRio($last_id, $fluviometro->getId(), $statusRio, $dataAlertaRio);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "AlertaRio" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(AlertaRio $alertaRio): bool{
			$insertion = $this->pdo->prepare("delete from AlertaRio where id = :id");
			$insertion->bindValue(":id", $alertaRio->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "AlertaRio" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?AlertaRio{
			$statement = $this->pdo->query("select * from AlertaRio where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one

			if ($queries){
				$query = $queries[0];
				return new AlertaRio($id, $query['id_fluviometro'], $query['status_rio'], $query['data_alerta_rio']);
			}
			return null;
		}
		
		// Return all records of "AlertaRio"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): ?array{
			$statement = $this->pdo->query("select * from AlertaRio");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new AlertaRio($query['id'], $query['id_fluviometro'], $query['status_rio'], $query['data_alerta_rio']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Update the "AlertaRio" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(AlertaRio $alertaRio): bool{
			$insertion = $this->pdo->prepare("update AlertaRio set id_fluviometro = :id_fluviometro, status_rio = :status_rio, data_alerta_rio = :data_alerta_rio where id = :id");
			$insertion->bindValue(":id", $alertaRio->getId());
			$insertion->bindValue(":id_fluviometro", $alertaRio->getIdFluviometro());
			$insertion->bindValue(":status_rio", $alertaRio->getStatusRio());
			$insertion->bindValue(":data_alerta_rio", $alertaRio->getDataAlertaRio());
			return $insertion->execute();
		}
	}
?>