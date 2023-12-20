<?php
    include_once $SERVER_LOCATION.'/daos/DAO.php';
    
    class DAOMemo extends DAO{
        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }
        
        // Insert data of "Memo" into the table
        // Returns a model if the insertion is successful, otherwise returns null
        public function insert(Relatorio $relatorio, Secretaria $secretaria, string $dataMemo, string $statusMemo, string $setor, string $memorando, string $oficio, string $processo): ?Memo{
            $insertion = $this->pdo->prepare("INSERT INTO Memo (id_relatorio, id_secretaria, data_memo, status_memo, setor, memorando, oficio, processo) VALUES (:id_relatorio, :id_secretaria, :data_memo, :status_memo, :setor, :memorando, :oficio, :processo)");
            $insertion->bindValue(":id_relatorio", $relatorio->getId());
            $insertion->bindValue(":id_secretaria", $secretaria->getId());
            $insertion->bindValue(":data_memo", $dataMemo);
            $insertion->bindValue(":status_memo", $statusMemo);
            $insertion->bindValue(":setor", $setor);
            $insertion->bindValue(":memorando", $memorando);
            $insertion->bindValue(":oficio", $oficio);
            $insertion->bindValue(":processo", $processo);

            if ($insertion->execute()) {
                $lastId = intval($this->pdo->lastInsertId());
                return new Memo($lastId, $relatorio->getId(), $secretaria->getId(), $dataMemo, $statusMemo, $setor, $memorando, $oficio, $processo);
            }

            return null;
        }

        // Remove the "Memo" model entry from the table
        // Returns true if the removal is successful, otherwise returns false
        public function remove(Memo $memo): bool{
            $deletion = $this->pdo->prepare("DELETE FROM Memo WHERE id = :id");
            $deletion->bindValue(":id", $memo->getId());
            return $deletion->execute();
        }

        // Find a single entry in the "Memo" table by ID
        // Returns a model if found, returns null otherwise
        public function findById(int $id): ?Memo{
            $select = $this->pdo->prepare('SELECT * FROM Memo WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Memo($query['id'], $query['id_relatorio'], $query['id_secretaria'], $query['data_memo'], $query['status_memo'], $query['setor'], $query['memorando'], $query['oficio'], $query['processo']);
            }
            return null;
        }

        // Find a single entry in the "Memo" table by "Relatorio" reference
        // Returns a model if found, returns null otherwise
        public function findByRelatorio(Relatorio $relatorio): ?Memo{
            $select = $this->pdo->prepare('SELECT * FROM Memo WHERE id_relatorio = :id_relatorio');
            $select->bindValue(':id_relatorio', $relatorio->getId());
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Memo($query['id'], $query['id_relatorio'], $query['id_secretaria'], $query['data_memo'], $query['status_memo'], $query['setor'], $query['memorando'], $query['oficio'], $query['processo']);
            }
            return null;
        }
        
        // Return all records of "Memo"
        // Returns an array with all the found models, returns an empty array in case of an error
        public function listAll(): ?array{
            $select = $this->pdo->prepare('SELECT * FROM Memo'.$this->sql_length.$this->sql_offset);
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Memo($query['id'], $query['id_relatorio'], $query['id_secretaria'], $query['data_memo'], $query['status_memo'], $query['setor'], $query['memorando'], $query['oficio'], $query['processo']);
            }
            return $models;
        }
        
        // Count all records of "Memo"
        // Returns an array with all the found models, returns an empty array in case of an error
        public function countAll(): int{
            $select = $this->pdo->prepare('SELECT COUNT(*) FROM Memo');
            $select->execute();
            
            return $select->fetch()[0];
        }
        
        // Return all records of "Memo" where references to a specific "Relatorio"
        // Returns an array with all the found models, returns an empty array in case of an error
        public function searchByRelatorio(Relatorio $relatorio): array{
            $select = $this->pdo->prepare('SELECT * FROM Memo WHERE id_relatorio = :id_relatorio ORDER BY data_memo DESC');
            $select->bindValue(':id_relatorio', $relatorio->getId());
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Memo($query['id'], $query['id_relatorio'], $query['id_secretaria'], $query['data_memo'], $query['status_memo'], $query['setor'], $query['memorando'], $query['oficio'], $query['processo']);
            }
            return $models;
        }
        
        // Search for records of "Memo" that matches the text
        // Returns an array with all the found models, returns an empty array in case of an error
        public function searchByText($text): ?array{
            $select = $this->pdo->prepare('SELECT Memo.id AS id, Memo.id_relatorio AS id_relatorio, Memo.id_secretaria AS id_secretaria, Memo.data_memo AS data_memo, Memo.status_memo AS status_memo, Memo.setor AS setor, Memo.memorando AS memorando, Memo.oficio AS oficio, Memo.processo AS processo FROM Memo INNER JOIN Relatorio ON Memo.id_relatorio = Relatorio.id INNER JOIN Casa ON Relatorio.id_casa = Casa.id INNER JOIN Residencial ON Casa.id_residencial = Residencial.id INNER JOIN Endereco ON Residencial.cep = Endereco.cep WHERE Endereco.rua LIKE :text OR Endereco.bairro LIKE :text OR Residencial.numero LIKE :text OR Memo.memorando LIKE :text ORDER BY data_memo DESC'.$this->sql_length.$this->sql_offset);
            $select->bindValue(':text', '%'.$text.'%');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Memo($query['id'], $query['id_relatorio'], $query['id_secretaria'], $query['data_memo'], $query['status_memo'], $query['setor'], $query['memorando'], $query['oficio'], $query['processo']);
            }
            return $models;
        }
        
        // Count all records of "Memo" that matches the text
        // Returns an array with all the found models, returns an empty array in case of an error
        public function countByText($text): int{
            $select = $this->pdo->prepare('SELECT COUNT(*) FROM Memo INNER JOIN Relatorio ON Memo.id_relatorio = Relatorio.id INNER JOIN Casa ON Relatorio.id_casa = Casa.id INNER JOIN Residencial ON Casa.id_residencial = Residencial.id INNER JOIN Endereco ON Residencial.cep = Endereco.cep WHERE Endereco.rua LIKE :text OR Endereco.bairro LIKE :text OR Residencial.numero LIKE :text OR Memo.memorando LIKE :text');
            $select->bindValue(':text', '%'.$text.'%');
            $select->execute();
            
            return $select->fetch()[0];
        }
        
        // Update the "Memo" entry in the table
        // Returns true if the update is successful, otherwise returns false
        public function update(Memo $memo): bool{
            $update = $this->pdo->prepare("UPDATE Memo SET id_relatorio = :id_relatorio, id_secretaria = :id_secretaria, data_memo = :data_memo, status_memo = :status_memo, setor = :setor, memorando = :memorando, oficio = :oficio, processo = :processo WHERE id = :id");
            $update->bindValue(":id", $memo->getId());
            $update->bindValue(":id_relatorio", $memo->getIdRelatorio());
            $update->bindValue(":id_secretaria", $memo->getIdSecretaria());
            $update->bindValue(":data_memo", $memo->getDataMemo());
            $update->bindValue(":status_memo", $memo->getStatusMemo());
            $update->bindValue(":setor", $memo->getSetor());
            $update->bindValue(":memorando", $memo->getMemorando());
            $update->bindValue(":oficio", $memo->getOficio());
            $update->bindValue(":processo", $memo->getProcesso());
            return $update->execute();
        }
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM Memo; ALTER TABLE Memo AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
    }
?>
