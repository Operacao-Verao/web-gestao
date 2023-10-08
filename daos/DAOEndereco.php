<?php
	class DAOEndereco{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Endereco" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(string $cep, string $rua, string $bairro, string $cidade): ?Endereco{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("INSERT INTO Endereco (cep, rua, bairro, cidade) VALUES (:cep, :rua, :bairro, :cidade)");
			$insertion->bindValue(":cep", $cep);
			$insertion->bindValue(":rua", $rua);
			$insertion->bindValue(":bairro", $bairro);
			$insertion->bindValue(":cidade", $cidade);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				return new Endereco($cep, $rua, $bairro, $cidade);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Endereco" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(Endereco $endereco): bool{
			$insertion = $this->pdo->prepare("DELETE FROM Endereco WHERE cep = :cep");
			$insertion->bindValue(":cep", $endereco->getCep());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Endereco" table
		// Returns a model if found, returns null otherwise
		public function findByCep(string $cep): ?Endereco{
            $select = $this->pdo->prepare('SELECT * FROM Endereco WHERE cep = :cep');
            $select->bindValue(':cep', $cep);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Endereco($query['cep'], $query['rua'], $query['bairro'], $query['cidade']);
            }
            return null;
		}
		
		// Return all records of "Endereco"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): array{
            $select = $this->pdo->prepare('SELECT * FROM Endereco');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Endereco($query['cep'], $query['rua'], $query['bairro'], $query['cidade']);
            }
            return $models;
		}
		
		// Update the "Endereco" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(Endereco $endereco): bool{
			$insertion = $this->pdo->prepare("UPDATE Endereco SET cep = :cep, rua = :rua, bairro = :bairro, cidade = :cidade WHERE cep = :cep");
			$insertion->bindValue(":cep", $endereco->getCep());
			$insertion->bindValue(":rua", $endereco->getRua());
			$insertion->bindValue(":bairro", $endereco->getBairro());
			$insertion->bindValue(":cidade", $endereco->getCidade());
			return $insertion->execute();
		}
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM Endereco;");
			return $deletion->execute();
        }
	}
?>