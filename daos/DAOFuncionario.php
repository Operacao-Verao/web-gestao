<?php
	class DAOFuncionario{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Funcionario" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(string $nome, string $email, string $senha, int $tipoUsuario): ?Funcionario{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("insert into Funcionario (nome, email, senha, tipo_usuario) values (:nome, :email, :senha, :tipo)");
			$insertion->bindValue(":nome", $nome);
			$insertion->bindValue(":email", $email);
			$insertion->bindValue(":senha", $senha);
			$insertion->bindValue(":tipo", $tipoUsuario);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$last_id = intval($this->pdo->lastInsertId());
				return new Funcionario($last_id, $nome, $email, $senha, $tipoUsuario);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Funcionario" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(Funcionario $funcionario): bool{
			$insertion = $this->pdo->prepare("delete from Funcionario where id = :id");
			$insertion->bindValue(":id", $funcionario->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Funcionario" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?Funcionario{
			$statement = $this->pdo->query("select * from Funcionario where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one
			if ($queries){
				$query = $queries[0];
				return new Funcionario($id, $query['nome'], $query['email'], $query['senha'], $query['tipo_usuario']);
			}
			return null;
		}
		
		// Find a single entry in the "Funcionario" table using login
		// Returns a model if found, returns null otherwise
		public function findWithLogin(string $email, string $senha): ?Funcionario{
			//$email = addslashes($email);
			//$senha = addslashes($senha);
			$statement = $this->pdo->query("select *, Gestor.id as id_gestor from Funcionario join Gestor on Funcionario.id = Gestor.id_funcionario where email = \"".$email."\"");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one
			if ($queries){
				$query_gestor = $queries[0];
				if($senha == $query_gestor['senha']) {
					return new Funcionario($query_gestor['id_gestor'], $query_gestor['nome'], $query_gestor['email'], $query_gestor['senha'], $query_gestor['tipo_usuario']);
				}
			}

			return null;
		}
		
		// Find a single entry in the "Funcionario" table through email (useful for checking account existency or password changing)
		// Returns a model if found, returns null otherwise
		public function findByEmail(string $email): ?Funcionario{
			//$email = addslashes($email);
			$statement = $this->pdo->query("select * from Funcionario where email = \"".$email."\"");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one
			if ($queries){
				$query = $queries[0];
				return new Funcionario($query['id'], $query['nome'], $query['email'], $query['senha'], $query['tipo_usuario']);
			}
			return null;
		}
		
		// Return all records of "Funcionario"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): ?array{
			$statement = $this->pdo->query("select * from Funcionario");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new Funcionario($query['id'], $query['nome'], $query['email'], $query['senha'], $query['tipo_usuario']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Update the "Funcionario" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(Funcionario $funcionario): bool{
			$insertion = $this->pdo->prepare("update Funcionario set nome = :nome, email = :email, senha = :senha, tipo_usuario = :tipo where id = :id");
			$insertion->bindValue(":id", $funcionario->getId());
			$insertion->bindValue(":nome", $funcionario->getNome());
			$insertion->bindValue(":email", $funcionario->getEmail());
			$insertion->bindValue(":senha", $funcionario->getSenha());
			$insertion->bindValue(":tipo", $funcionario->getTipoUsuario());
			return $insertion->execute();
		}
	}
?>