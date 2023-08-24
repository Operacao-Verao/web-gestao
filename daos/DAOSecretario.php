<?php
	class DAOSecretario{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Secretario" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(Secretaria $secretaria, Cargo $cargo, string $nomeSecretario): ?Secretario{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("insert into Secretario (id_secretaria, id_cargo, nome_secretario) values (:secretaria, :cargo, :nome)");
			$insertion->bindValue(":secretaria", $secretaria->getId());
			$insertion->bindValue(":cargo", $cargo->getId());
			$insertion->bindValue(":nome", $nomeSecretario);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$last_id = intval($this->pdo->lastInsertId());
				return new Secretario($last_id, $secretaria, $cargo, $nomeSecretario);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Secretario" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(Secretario $secretario): bool{
			$insertion = $this->pdo->prepare("delete from Secretario where id = :id");
			$insertion->bindValue(":id", $secretario->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Secretario" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?Secretario{
			$statement = $this->pdo->query("select * from Secretario where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one

			if ($queries){
				$query = $queries[0];
				return new Secretario($id, $query['id_secretaria'], $query['id_cargo'], $query['nome_secretario']);
			}
			return null;
		}
		
		// Return all records of "Secretario"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): ?array{
			$statement = $this->pdo->query("select * from Secretario");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new Secretario($query['id'], $query['id_secretaria'], $query['id_cargo'], $query['nome_secretario']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Update the "Secretario" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(Secretario $secretario): bool{
			$insertion = $this->pdo->prepare("update Secretario set id_secretaria = :id_secretaria, id_cargo = :id_cargo, nome_secretario = :nome where id = :id");
			$insertion->bindValue(":id", $secretario->getId());
			$insertion->bindValue(":id_secretaria", $secretario->getIdSecretaria());
			$insertion->bindValue(":id_cargo", $secretario->getIdCargo());
			$insertion->bindValue(":nome", $secretario->getNomeSecretario());
			return $insertion->execute();
		}
	}
?>