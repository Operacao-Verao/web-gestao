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
			$insertion = $this->pdo->prepare("INSERT INTO Funcionario (nome, email, senha, tipo_usuario) VALUES (:nome, :email, :senha, :tipo)");
			$insertion->bindValue(":nome", $nome);
			$insertion->bindValue(":email", $email);
			$insertion->bindValue(":senha", $senha);
			$insertion->bindValue(":tipo", $tipoUsuario);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$lastId = intval($this->pdo->lastInsertId());
				return new Funcionario($lastId, $nome, $email, $senha, $tipoUsuario);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Funcionario" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(Funcionario $funcionario): bool{
			$insertion = $this->pdo->prepare("DELETE FROM Funcionario WHERE id = :id");
			$insertion->bindValue(":id", $funcionario->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Funcionario" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?Funcionario{
            $select = $this->pdo->prepare('SELECT * FROM Funcionario WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Funcionario($query['id'], $query['nome'], $query['email'], $query['senha'], $query['tipo_usuario']);
            }
            return null;
		}
		
		// Find a single entry in the "Funcionario" table using login
		// Returns a model if found, returns null otherwise
		public function findWithLogin(string $email, string $senha): ?Funcionario{
            $select = $this->pdo->prepare('SELECT * FROM Funcionario WHERE email = :email AND senha = :senha');
            $select->bindValue(':email', $email);
            $select->bindValue(':senha', $senha);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Funcionario($query['id'], $query['nome'], $query['email'], $query['senha'], $query['tipo_usuario']);
            }
            return null;
		}
		
		// Find a single entry in the "Funcionario" table through email (useful for checking account existency or password changing)
		// Returns a model if found, returns null otherwise
		public function findByEmail(string $email): ?Funcionario{
            $select = $this->pdo->prepare('SELECT * FROM Funcionario WHERE email = :email');
            $select->bindValue(':email', $email);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Funcionario($query['id'], $query['nome'], $query['email'], $query['senha'], $query['tipo_usuario']);
            }
            return null;
		}
		
		// Return all records of "Funcionario"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): array{
            $select = $this->pdo->prepare('SELECT * FROM Funcionario');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Funcionario($query['id'], $query['nome'], $query['email'], $query['senha'], $query['tipo_usuario']);
            }
            return $models;
		}
		
		// Update the "Funcionario" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(Funcionario $funcionario): bool{
			$insertion = $this->pdo->prepare("UPDATE Funcionario SET nome = :nome, email = :email, senha = :senha, tipo_usuario = :tipo WHERE id = :id");
			$insertion->bindValue(":id", $funcionario->getId());
			$insertion->bindValue(":nome", $funcionario->getNome());
			$insertion->bindValue(":email", $funcionario->getEmail());
			$insertion->bindValue(":senha", $funcionario->getSenha());
			$insertion->bindValue(":tipo", $funcionario->getTipoUsuario());
			return $insertion->execute();
		}
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM Funcionario; ALTER TABLE Funcionario AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
	}
?>