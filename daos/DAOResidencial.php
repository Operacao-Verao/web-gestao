<?php
	
	class DAOResidencial{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Residencial" into the table
		// Returns a model if the insertion is successful, otherwise returns null
			public function insert(string $cep, string $numero): ?Residencial{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("insert into Residencial (cep, numero) values (:cep, :numero)");
			$insertion->bindValue(":cep", $cep);
			$insertion->bindValue(":numero", $numero);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$last_id = intval($this->pdo->lastInsertId());
				return new Residencial($last_id, $cep, $numero);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Residencial" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(Residencial $residencial): bool{
			$insertion = $this->pdo->prepare("delete from Residencial where id = :id");
			$insertion->bindValue(":id", $residencial->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Residencial" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?Residencial{
			$statement = $this->pdo->query("select * from Residencial where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one
			if ($queries){
				$query = $queries[0];
				return new Residencial($query['id'], $query['cep'], $query['numero']);
			}
			return null;
		}
		
		// Find a single entry in the "Residencial" table
		// Returns a model if found, returns null otherwise
		public function findByCepNumero(string $cep, string $numero): ?Residencial{
            $cep = addslashes($cep);
            $numero = addslashes($numero);
			$statement = $this->pdo->query("select * from Residencial where cep = '".$cep."' and numero = '".$numero."'");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one
			if ($queries){
				$query = $queries[0];
				return new Residencial($query['id'], $query['cep'], $query['numero']);
			}
			return null;
		}
		
		// Return all records of "Residencial"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): ?array{
			$statement = $this->pdo->query("select * from Residencial");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new Residencial($query['id'], $query['cep'], $query['numero']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Update the "Residencial" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(Residencial $residencial): bool{
			$insertion = $this->pdo->prepare("update Residencial set cep = :cep, numero = :numero where id = :id");
			$insertion->bindValue(":id", $residencial->getId());
			$insertion->bindValue(":cep", $residencial->getCep());
			$insertion->bindValue(":numero", $numero->getNumero());
			return $insertion->execute();
		}
	}
	
?>