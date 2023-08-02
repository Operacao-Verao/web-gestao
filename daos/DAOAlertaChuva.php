<?php
	include_once("../actions/conn.php");
	include_once("../models/AlertaChuva.php");
	
	class DAOAlertaChuva{
		private $pdo;
		
		public function __construct($pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "AlertaChuva" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert($pluviometro, $statusChuva, $dataChuva) {
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("insert into AlertaChuva (id_pluviometro, status_chuva, data_chuva) values (:pluviometro, :status_chuva, :data_chuva)");
			$insertion->bindValue(":pluviometro", $pluviometro->getId());
			$insertion->bindValue(":status_chuva", $statusChuva);
			$insertion->bindValue(":dataChuva", $dataChuva);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$last_id = intval($this->pdo->lastInsertId());
				return new AlertaChuva($last_id, $pluviometro->getId(), $statusChuva, $dataChuva);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "AlertaChuva" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove($alertaChuva) {
			$insertion = $this->pdo->prepare("delete from AlertaChuva where id = :id");
			$insertion->bindValue(":id", $alertaChuva->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "AlertaChuva" table
		// Returns a model if found, returns null otherwise
		public function findById($id) {
			$statement = $this->pdo->query("select * from AlertaChuva where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one

			if ($queries){
				$query = $queries[0];
				return new AlertaChuva($id, $query['id_pluviometro'], $query['status_chuva'], $query['data_chuva']);
			}
			return null;
		}
		
		// Return all records of "Afetados"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll() {
			$statement = $this->pdo->query("select * from AlertaChuva");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new AlertaChuva($query['id'], $query['id_pluviometro'], $query['status_chuva'], $query['data_chuva']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Update the "Afetados" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update($alertaChuva) {
			$insertion = $this->pdo->prepare("update AlertaChuva set id_pluviometro = :id_pluviometro, status_chuva = :status_chuva, data_chuva = :data_chuva where id = :id");
			$insertion->bindValue(":id", $alertaChuva->getId());
			$insertion->bindValue(":id_pluviometro", $alertaChuva->getIdPluviometro());
			$insertion->bindValue(":status_chuva", $alertaChuva->getStatusChuva());
			$insertion->bindValue(":data_chuva", $alertaChuva->getDataChuva());
			return $insertion->execute();
		}
	}
?>