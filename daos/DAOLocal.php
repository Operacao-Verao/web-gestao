<?php
	
	class DAOLocal{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Local" into the table
		// Returns a model if the insertion is successful, otherwise returns null
			public function insert(string $cep, string $numero): ?Local{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("insert into Local (cep, numero) values (:cep, :numero)");
			$insertion->bindValue(":cep", $cep);
			$insertion->bindValue(":numero", $numero);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$last_id = intval($this->pdo->lastInsertId());
				return new Local($last_id, $cep, $numero);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Local" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(Local $local): bool{
			$insertion = $this->pdo->prepare("delete from Local where id = :id");
			$insertion->bindValue(":id", $local->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Local" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?Local{
			$statement = $this->pdo->query("select * from Local where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one
			if ($queries){
				$query = $queries[0];
				return new Local($query['id'], $query['cep'], $query['numero']);
			}
			return null;
		}
		
		// Find a single entry in the "Local" table
		// Returns a model if found, returns null otherwise
		public function findByCepNumero(string $cep, string $numero): ?Local{
			$statement = $this->pdo->query("select * from Local where cep = ".$cep." and numero = ".$numero);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one
			if ($queries){
				$query = $queries[0];
				return new Local($query['id'], $query['cep'], $query['numero']);
			}
			return null;
		}
		
		// Return all records of "Local"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): ?array{
			$statement = $this->pdo->query("select * from Local");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new Local($query['id'], $query['cep'], $query['numero']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Update the "Local" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(Local $local): bool{
			$insertion = $this->pdo->prepare("update Local set cep = :cep, numero = :numero where id = :id");
			$insertion->bindValue(":id", $local->getId());
			$insertion->bindValue(":cep", $local->getCep());
			$insertion->bindValue(":numero", $numero->getNumero());
			return $insertion->execute();
		}
	}
	
?>