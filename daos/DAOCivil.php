<?php
	class DAOCivil{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Civil" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(Casa|null $casa, string $nome, string $email, string $senha, string $cpf, string $celular, string $telefone): ?Civil{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("insert into Civil (id_casa, nome, email, senha, cpf, celular, telefone) values (:id_casa, :nome, :email, :senha, :cpf, :celular, :telefone)");
			$insertion->bindValue(":id_casa", $casa? $casa->getId(): null);
			$insertion->bindValue(":nome", $nome);
			$insertion->bindValue(":email", $email);
			$insertion->bindValue(":senha", $senha);
			$insertion->bindValue(":cpf", $cpf);
			$insertion->bindValue(":celular", $celular);
			$insertion->bindValue(":telefone", $telefone);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$last_id = intval($this->pdo->lastInsertId());
				return new Civil($last_id, $casa? $casa->getId(): null, $nome, $email, $senha, $cpf, $celular, $telefone);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Civil" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(Civil $civil): bool{
			$insertion = $this->pdo->prepare("delete from Civil where id = :id");
			$insertion->bindValue(":id", $civil->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Civil" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?Civil{
			$statement = $this->pdo->query("select * from Civil where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one
			if ($queries){
				$query = $queries[0];
				return new Civil($id, $query['id_casa'], $query['nome'], $query['email'], $query['senha'], $query['cpf'], $query['celular'], $query['telefone']);
			}
			return null;
		}
		
		// Find a single entry in the "Civil" table by her CPF
		// Returns a model if found, returns null otherwise
		public function findByCpf(string $cpf): ?Civil{
			$statement = $this->pdo->query("select * from Civil where cpf = \'".addslashes($cpf)."\'");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// Only one entry is needed, in this case, the first one
			if ($queries){
				$query = $queries[0];
				return new Civil($query['id'], $query['id_casa'], $query['nome'], $query['email'], $query['senha'], $query['cpf'], $query['celular'], $query['telefone']);
			}
			return null;
		}
		
		// Find a single entry in the "Civil" table by her Email
		// Returns a model if found, returns null otherwise
		public function findByEmail(string $email): ?Civil{
			$statement = $this->pdo->query("select * from Civil where email = '".addslashes($email)."'");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// Only one entry is needed, in this case, the first one
			if ($queries){
				$query = $queries[0];
				return new Civil($query['id'], $query['id_casa'], $query['nome'], $query['email'], $query['senha'], $query['cpf'], $query['celular'], $query['telefone']);
			}
			return null;
		}
		
		// Return all records of "Civil"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): ?array{
			$statement = $this->pdo->query("select * from Civil");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new Civil($query['id'], $query['id_casa'], $query['nome'], $query['email'], $query['senha'], $query['cpf'], $query['celular'], $query['telefone']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Update the "Civil" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(Civil $civil): bool{
			$insertion = $this->pdo->prepare("update Civil set id_casa = :id_casa, nome = :nome, email = :email, senha = :senha, cpf = :cpf, celular = :celular, telefone = :telefone where id = :id");
			$insertion->bindValue(":id", $civil->getId());
			$insertion->bindValue(":id_casa", $civil->getIdCasa());
			$insertion->bindValue(":nome", $civil->getNome());
			$insertion->bindValue(":email", $civil->getEmail());
			$insertion->bindValue(":senha", $civil->getSenha());
			$insertion->bindValue(":cpf", $civil->getCpf());
			$insertion->bindValue(":celular", $civil->getCelular());
			$insertion->bindValue(":telefone", $civil->getTelefone());
			return $insertion->execute();
		}
	}
?>