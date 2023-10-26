<?php
    include_once $SERVER_LOCATION.'/daos/DAO.php';
    
	class DAOCivil extends DAO{
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Civil" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(?Residencial $residencial, string $nome, string $email, string $senha, string $cpf, string $celular, string $telefone): ?Civil{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("INSERT INTO Civil (id_residencial, nome, email, senha, cpf, celular, telefone) VALUES (:id_residencial, :nome, :email, :senha, :cpf, :celular, :telefone)");
			$insertion->bindValue(":id_residencial", $residencial? $residencial->getId(): null);
			$insertion->bindValue(":nome", $nome);
			$insertion->bindValue(":email", $email);
			$insertion->bindValue(":senha", $senha);
			$insertion->bindValue(":cpf", $cpf);
			$insertion->bindValue(":celular", $celular);
			$insertion->bindValue(":telefone", $telefone);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$lastId = intval($this->pdo->lastInsertId());
				return new Civil($lastId, $residencial? $residencial->getId(): null, $nome, $email, $senha, $cpf, $celular, $telefone);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Civil" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(Civil $civil): bool{
			$insertion = $this->pdo->prepare("DELETE FROM Civil WHERE id = :id");
			$insertion->bindValue(":id", $civil->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Civil" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?Civil{
            $select = $this->pdo->prepare('SELECT * FROM Civil WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Civil($query['id'], $query['id_residencial'], $query['nome'], $query['email'], $query['senha'], $query['cpf'], $query['celular'], $query['telefone']);
            }
            return null;
		}
		
		// Find a single entry in the "Civil" table by her CPF
		// Returns a model if found, returns null otherwise
		public function findByCpf(string $cpf): ?Civil{
            $select = $this->pdo->prepare('SELECT * FROM Civil WHERE cpf = :cpf');
            $select->bindValue(':cpf', $cpf);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Civil($query['id'], $query['id_residencial'], $query['nome'], $query['email'], $query['senha'], $query['cpf'], $query['celular'], $query['telefone']);
            }
            return null;
		}
		
		// Find a single entry in the "Civil" table by her Email
		// Returns a model if found, returns null otherwise
		public function findByEmail(string $email): ?Civil{
            $select = $this->pdo->prepare('SELECT * FROM Civil WHERE email = :email');
            $select->bindValue(':email', $email);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Civil($query['id'], $query['id_residencial'], $query['nome'], $query['email'], $query['senha'], $query['cpf'], $query['celular'], $query['telefone']);
            }
            return null;
		}
		
		// Return all records of "Civil"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): array{
            $select = $this->pdo->prepare('SELECT * FROM Civil'.$this->sql_length.$this->sql_offset);
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Civil($query['id'], $query['id_residencial'], $query['nome'], $query['email'], $query['senha'], $query['cpf'], $query['celular'], $query['telefone']);
            }
            return $models;
		}
		
		// Count all records of "Civil"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function countAll(): int{
            $select = $this->pdo->prepare('SELECT COUNT(*) FROM Civil');
            $select->execute();
            
            return $select->fetch()[0];
		}
		
		// Search for all records of "Civil" corresponding to text searched
		// Returns an array with all the found models, returns an empty array in case of an error
		public function searchByText(string $text): array{
            $select = $this->pdo->prepare('SELECT * FROM Civil WHERE nome LIKE :text OR email LIKE :text OR cpf LIKE :text ORDER BY nome'.$this->sql_length.$this->sql_offset);
            $select->bindValue(':text', $text."%");
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Civil($query['id'], $query['id_residencial'], $query['nome'], $query['email'], $query['senha'], $query['cpf'], $query['celular'], $query['telefone']);
            }
            return $models;
		}
		
		// Search for all records of "Civil" corresponding to text and count
		// Returns an array with all the found models, returns an empty array in case of an error
		public function countByText(string $text): int{
            $select = $this->pdo->prepare('SELECT COUNT(*) FROM Civil WHERE nome LIKE :text OR email LIKE :text OR cpf LIKE :text ORDER BY nome');
            $select->bindValue(':text', $text."%");
            $select->execute();
            
            return $select->fetch()[0];
		}
		
		// Update the "Civil" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(Civil $civil): bool{
			$insertion = $this->pdo->prepare("UPDATE Civil SET id_residencial = :id_residencial, nome = :nome, email = :email, senha = :senha, cpf = :cpf, celular = :celular, telefone = :telefone WHERE id = :id");
			$insertion->bindValue(":id", $civil->getId());
			$insertion->bindValue(":id_residencial", $civil->getIdResidencial());
			$insertion->bindValue(":nome", $civil->getNome());
			$insertion->bindValue(":email", $civil->getEmail());
			$insertion->bindValue(":senha", $civil->getSenha());
			$insertion->bindValue(":cpf", $civil->getCpf());
			$insertion->bindValue(":celular", $civil->getCelular());
			$insertion->bindValue(":telefone", $civil->getTelefone());
			return $insertion->execute();
		}
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM Civil; ALTER TABLE Civil AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
	}
?>