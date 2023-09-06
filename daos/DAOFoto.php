<?php
    class DAOFoto {
        private PDO $pdo;
        
        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }
        
        // Insert data of "Foto" into the table
        // Returns a model if the insertion is successful, otherwise returns null
        public function insert(Relatorio $relatorio, string $codificado): ?Foto{
            $insertion = $this->pdo->prepare("INSERT INTO Foto (id_relatorio, codificado) VALUES (:idRelatorio, :codificado)");
            $insertion->bindValue(":idRelatorio", $relatorio->getId());
            $insertion->bindValue(":codificado", $codificado);

            if ($insertion->execute()) {
                $last_id = intval($this->pdo->lastInsertId());
                return new Foto($last_id, $relatorio->getId(), $codificado);
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
            $statement = $this->pdo->query("SELECT * FROM Foto WHERE id = " . $id);
            $queries = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($queries) {
                $query = $queries[0];
                return new Foto($id, $query['id_relatorio'], $query['codificado']);
            }
            return null;
        }

        // Return all records of "Foto"
        // Returns an array with all the found models, returns an empty array in case of an error
        public function listAll(): ?array{
            $statement = $this->pdo->query("SELECT * FROM Foto");
            $queries = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($queries) {
                $models = [];
                foreach ($queries as $query) {
                    $models[] = new Foto($query['id'], $query['id_relatorio'], $query['codificado']);
                }
                return $models;
            }
            return [];
        }

        // Return all records of "Foto" where references to a specific "Relatorio"
        // Returns an array with all the found models, returns an empty array in case of an error
        public function listByRelatorio(Relatorio $relatorio): ?array{
            $statement = $this->pdo->query("SELECT * FROM Foto WHERE id_relatorio = ".$relatorio->getId());
            $queries = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($queries) {
                $models = [];
                foreach ($queries as $query) {
                    $models[] = new Foto($query['id'], $query['id_relatorio'], $query['codificado']);
                }
                return $models;
            }
            return [];
        }

        // Update the "Foto" entry in the table
        // Returns true if the update is successful, otherwise returns false
        public function update(Foto $foto): bool{
            $update = $this->pdo->prepare("UPDATE Foto SET id_relatorio = :idRelatorio, codificado = :codificado WHERE id = :id");
            $update->bindValue(":id", $foto->getId());
            $update->bindValue(":idRelatorio", $foto->getIdRelatorio());
            $update->bindValue(":codificado", $foto->getCodificado());
            return $update->execute();
        }
    }
?>
