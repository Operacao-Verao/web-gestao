<?php
    class DAOMemo {
        private PDO $pdo;
        
        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }
        
        // Insert data of "Memo" into the table
        // Returns a model if the insertion is successful, otherwise returns null
        public function insert(Relatorio $relatorio, Secretaria $secretaria, string $dataMemo, string $statusMemo, string $setor, string $processo): ?Memo{
            $insertion = $this->pdo->prepare("INSERT INTO Memo (id_relatorio, id_secretaria, data_memo, status_memo, setor, processo) VALUES (:id_relatorio, :id_secretaria, :data_memo, :status_memo, :setor, :processo)");
            $insertion->bindValue(":id_relatorio", $relatorio->getId());
            $insertion->bindValue(":id_secretaria", $secretaria->getId());
            $insertion->bindValue(":data_memo", $dataMemo);
            $insertion->bindValue(":status_memo", $statusMemo);
            $insertion->bindValue(":setor", $setor);
            $insertion->bindValue(":processo", $processo);

            if ($insertion->execute()) {
                $lastId = intval($this->pdo->lastInsertId());
                return new Memo($lastId, $relatorio->getId(), $secretaria->getId(), $dataMemo, $statusMemo, $setor, $processo);
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
                return new Memo($query['id'], $query['id_relatorio'], $query['id_secretaria'], $query['data_memo'], $query['status_memo'], $query['setor'], $query['processo']);
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
                return new Memo($query['id'], $query['id_relatorio'], $query['id_secretaria'], $query['data_memo'], $query['status_memo'], $query['setor'], $query['processo']);
            }
            return null;
        }

        // Return all records of "Memo"
        // Returns an array with all the found models, returns an empty array in case of an error
        public function listAll(): ?array{
            $select = $this->pdo->prepare('SELECT * FROM Memo');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Memo($query['id'], $query['id_relatorio'], $query['id_secretaria'], $query['data_memo'], $query['status_memo'], $query['setor'], $query['processo']);
            }
            return $models;
        }

        // Update the "Memo" entry in the table
        // Returns true if the update is successful, otherwise returns false
        public function update(Memo $memo): bool{
            $update = $this->pdo->prepare("UPDATE Memo SET id_relatorio = :id_relatorio, id_secretaria = :id_secretaria, data_memo = :data_memo, status_memo = :status_memo, setor = :setor, processo = :processo WHERE id = :id");
            $update->bindValue(":id", $memo->getId());
            $update->bindValue(":id_relatorio", $memo->getIdRelatorio());
            $update->bindValue(":id_secretaria", $memo->getIdSecretaria());
            $update->bindValue(":data_memo", $memo->getDataMemo());
            $update->bindValue(":status_memo", $memo->getStatusMemo());
            $update->bindValue(":setor", $memo->getSetor());
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
