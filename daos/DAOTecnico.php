<?php
	include_once $SERVER_LOCATION.'/daos/DAO.php';
	
	class DAOTecnico extends DAO{
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Tecnico" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(Funcionario $funcionario, bool $ativo): ?Tecnico{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("INSERT INTO Tecnico (id_funcionario, ativo) VALUES (:id_funcionario, :ativo)");
			$insertion->bindValue(":id_funcionario", $funcionario->getId());
			$insertion->bindValue(":ativo", (int)$ativo);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$lastId = intval($this->pdo->lastInsertId());
				return new Tecnico($lastId, $funcionario->getId(), $ativo);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Tecnico" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(Tecnico $tecnico): bool{
			$insertion = $this->pdo->prepare("DELETE FROM Tecnico WHERE id = :id");
			$insertion->bindValue(":id", $tecnico->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Tecnico" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?Tecnico{
            $select = $this->pdo->prepare('SELECT * FROM Tecnico WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Tecnico($query['id'], $query['id_funcionario'], $query['ativo'], $query['token']);
            }
            return null;
		}
		
		// Find a single entry in the "Tecnico" table by its 'Funcionario' attribute
		// Returns a model if found, returns null otherwise
		public function findByFuncionario(Funcionario $funcionario): ?Tecnico{
            $select = $this->pdo->prepare('SELECT * FROM Tecnico WHERE id_funcionario = :id_funcionario');
            $select->bindValue(':id_funcionario', $funcionario->getId());
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Tecnico($query['id'], $query['id_funcionario'], $query['ativo'], $query['token']);
            }
            return null;
		}
		
		// Search for records of "Tecnico"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): array{
            $select = $this->pdo->prepare('SELECT Tecnico.id AS id, Tecnico.id_funcionario AS id_funcionario, Tecnico.ativo AS ativo FROM Tecnico INNER JOIN Funcionario ON Tecnico.id_funcionario = Funcionario.id ORDER BY Funcionario.nome ASC'.$this->sql_length.$this->sql_offset);
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Tecnico($query['id'], $query['id_funcionario'], $query['ativo'], $query['token']);
            }
            return $models;
		}
		
		// Search for records of "Tecnico"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function countAll(): int{
            $query = $this->pdo->prepare('SELECT COUNT(*) FROM Tecnico');
            $query->execute();
            
            return $query->fetch()[0];
		}
		
		// Update the "Tecnico" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(Tecnico $tecnico): bool{
			$insertion = $this->pdo->prepare("UPDATE Tecnico SET id_funcionario = :id_funcionario, ativo = :ativo WHERE id = :id");
			$insertion->bindValue(":id", $tecnico->getId());
			$insertion->bindValue(":id_funcionario", $tecnico->getIdFuncionario());
			$insertion->bindValue(":ativo", (int)$tecnico->getAtivo());
			return $insertion->execute();
		}
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM Tecnico; ALTER TABLE Tecnico AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
	}
?>