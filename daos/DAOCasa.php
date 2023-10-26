<?php
    include_once $SERVER_LOCATION.'/daos/DAO.php';
    
    class DAOCasa extends DAO{
        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }
        
        // Insert data of "Casa" into the table
        // Returns a model if the insertion is successful, otherwise returns null
        public function insert(Residencial $residencial, int $interdicao, string $complemento): ?Casa{
            $insertion = $this->pdo->prepare("INSERT INTO Casa (id_residencial, interdicao, complemento) VALUES (:id_residencial, :interdicao, :complemento)");
            $insertion->bindValue(":id_residencial", $residencial->getId());
            $insertion->bindValue(":interdicao", $interdicao);
            $insertion->bindValue(":complemento", $complemento);

            if ($insertion->execute()) {
                $lastId = intval($this->pdo->lastInsertId());
                return new Casa($lastId, $residencial->getId(), $interdicao, $complemento);
            }

            return null;
        }

        // Remove the "Casa" model entry from the table
        // Returns true if the removal is successful, otherwise returns false
        public function remove(Casa $casa): bool{
            $deletion = $this->pdo->prepare("DELETE FROM Casa WHERE id = :id");
            $deletion->bindValue(":id", $casa->getId());
            return $deletion->execute();
        }

        // Find a single entry in the "Casa" table by ID
        // Returns a model if found, returns null otherwise
        public function findById(int $id): ?Casa{
            $select = $this->pdo->prepare('SELECT * FROM Casa WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Casa($query['id'], $query['id_residencial'], $query['interdicao'], $query['complemento']);
            }
            return null;
        }
        
        // Return all records of "Casa"
        // Returns an array with all the found models, returns an empty array in case of an error
        public function listAll(): array{
            $select = $this->pdo->prepare('SELECT * FROM Casa'.$this->sql_length.$this->sql_offset);
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Casa($query['id'], $query['id_residencial'], $query['interdicao'], $query['complemento']);
            }
            return $models;
        }
        
        // Count all records of "Casa"
        // Returns an array with all the found models, returns an empty array in case of an error
        public function countAll(): int{
            $select = $this->pdo->prepare('SELECT COUNT(*) FROM Casa');
            $select->execute();
            
            return $select->fetch()[0];
        }
        
        // Search for all entries of "Casa" that matches the searched text
        // Returns an array with all the found models, returns an empty array in case of not
        public function searchByText(string $text): ?array{
            $select = $this->pdo->prepare('SELECT Casa.id AS id, Casa.id_residencial AS id_residencial, Casa.interdicao AS interdicao, Casa.complemento AS complemento FROM Casa INNER JOIN Residencial on Casa.id_residencial = Residencial.id WHERE cep LIKE :text OR numero LIKE :text OR complemento LIKE :text'.$this->sql_length.$this->sql_offset);
            $select->bindValue(':text', $text.'%');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Casa($query['id'], $query['id_residencial'], $query['interdicao'], $query['complemento']);
            }
            return $models;
        }
        
        // Search for all entries of "Casa" that matches the searched text and count
        // Returns an array with all the found models, returns an empty array in case of not
        public function countByText(string $text): int{
            $select = $this->pdo->prepare('SELECT COUNT(*) FROM Casa INNER JOIN Residencial on Casa.id_residencial = Residencial.id WHERE cep LIKE :text OR numero LIKE :text OR complemento LIKE :text');
            $select->bindValue(':text', $text.'%');
            $select->execute();
            
            return $select->fetch()[0];
        }
        
        // Search for all entries of "Casa" table by cep and numero
        // Returns a model if found, returns null otherwise
        public function searchByCepNumero(string $cep, string $numero): array{
            $select = $this->pdo->prepare('SELECT Casa.id AS id, Casa.id_residencial AS id_residencial, Casa.interdicao AS interdicao, Casa.complemento AS complemento FROM Casa INNER JOIN Residencial ON Casa.id_residencial = Residencial.id WHERE cep = :cep AND numero = :numero'.$this->sql_length.$this->sql_offset);
            $select->bindValue(':cep', $cep);
            $select->bindValue(':numero', $numero);
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Casa($query['id'], $query['id_residencial'], $query['interdicao'], $query['complemento']);
            }
            return $models;
        }
        
        // Update the "Casa" entry in the table
        // Returns true if the update is successful, otherwise returns false
        public function update(Casa $casa): bool{
            $update = $this->pdo->prepare("UPDATE Casa SET id_residencial = :id_residencial, interdicao = :interdicao, complemento = :complemento WHERE id = :id");
            $update->bindValue(":id", $casa->getId());
            $update->bindValue(":id_residencial", $casa->getIdResidencial());
            $update->bindValue(":interdicao", $casa->getInterdicao());
            $update->bindValue(":complemento", $casa->getComplemento());
            return $update->execute();
        }
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM Casa; ALTER TABLE Casa AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
    }
?>
