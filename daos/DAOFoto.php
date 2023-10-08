<?php
    class DAOFoto {
        private PDO $pdo;
        
        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }
        
        // Insert data of "Foto" into the table
        // Returns a model if the insertion is successful, otherwise returns null
        public function insert(Relatorio $relatorio, string $codificado): ?Foto{
            $insertion = $this->pdo->prepare("INSERT INTO Foto (id_relatorio, codificado) VALUES (:id_relatorio, :codificado)");
            $insertion->bindValue(":id_relatorio", $relatorio->getId());
            $insertion->bindValue(":codificado", $codificado);

            if ($insertion->execute()) {
                $lastId = intval($this->pdo->lastInsertId());
                return new Foto($lastId, $relatorio->getId(), $codificado);
            }

            return null;
        }

        // Remove the "Foto" model entry from the table
        // Returns true if the removal is successful, otherwise returns false
        public function remove(Foto $foto): bool{
            $deletion = $this->pdo->prepare("DELETE FROM Foto WHERE id = :id");
            $deletion->bindValue(":id", $foto->getId());
            return $deletion->execute();
        }

        // Find a single entry in the "Foto" table by ID
        // Returns a model if found, returns null otherwise
        public function findById(int $id): ?Foto{
            $select = $this->pdo->prepare('SELECT * FROM Foto WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Foto($query['id'], $query['id_relatorio'], $query['codificado']);
            }
            return null;
        }

        // Return all records of "Foto"
        // Returns an array with all the found models, returns an empty array in case of an error
        public function listAll(): array{
            $select = $this->pdo->prepare('SELECT * FROM Foto');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Foto($query['id'], $query['id_relatorio'], $query['codificado']);
            }
            return $models;
        }

        // Return all records of "Foto" where references to a specific "Relatorio"
        // Returns an array with all the found models, returns an empty array in case of an error
        public function searchByRelatorio(Relatorio $relatorio): array{
            $select = $this->pdo->prepare('SELECT * FROM Foto WHERE id_relatorio = :id_relatorio');
            $select->bindValue(':id_relatorio', $relatorio->getId());
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Foto($query['id'], $query['id_relatorio'], $query['codificado']);
            }
            return $models;
        }

        // Update the "Foto" entry in the table
        // Returns true if the update is successful, otherwise returns false
        public function update(Foto $foto): bool{
            $update = $this->pdo->prepare("UPDATE Foto SET id_relatorio = :id_relatorio, codificado = :codificado WHERE id = :id");
            $update->bindValue(":id", $foto->getId());
            $update->bindValue(":id_relatorio", $foto->getIdRelatorio());
            $update->bindValue(":codificado", $foto->getCodificado());
            return $update->execute();
        }
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM Foto; ALTER TABLE Foto AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
    }
?>
