<?php
	class DAOServiceWorker{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Service Worker Data" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(string $sw_endpoint, string $auth, string $p256dh, int $id_gestor): ?ServiceWorker{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("insert into ServiceWorkerData (sw_endpoint, auth, p256dh, id_gestor) values (:sw_endpoint, :auth, :p256dh, :id_gestor)");
			$insertion->bindValue(":sw_endpoint", $sw_endpoint);
			$insertion->bindValue(":auth", $auth);
			$insertion->bindValue(":p256dh", $p256dh);
      $insertion->bindValue(":id_gestor", $id_gestor);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$last_id = intval($this->pdo->lastInsertId());
				return new ServiceWorker($last_id, $sw_endpoint, $auth, $p256dh, $id_gestor);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Service Worker Data" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(ServiceWorker $sw): bool{
			$insertion = $this->pdo->prepare("delete from ServiceWorkerData where id = :id");
			$insertion->bindValue(":id", $sw->getId());
			return $insertion->execute();
		}
		
		// Return all records of "Service Worker Data"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): ?array{
			$statement = $this->pdo->query("select * from ServiceWorkerData");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new ServiceWorker($query['id'], $query['sw_endpoint'], $query['auth'], $query['p256dh'], $query['id_gestor']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Update the "Service Worker Data" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(ServiceWorker $sw): bool{
			$insertion = $this->pdo->prepare("update ServiceWorkerData set sw_endpoint = :sw_endpoint, auth = :auth, p256dh = :p256dh where id = :id");
			$insertion->bindValue(":id", $sw->getId());
			$insertion->bindValue(":sw_endpoint", $sw->getSwEndpoint());
			$insertion->bindValue(":auth", $sw->getAuth());
			$insertion->bindValue(":p256dh", $sw->getP256dh());
			return $insertion->execute();
		}
	}
?>