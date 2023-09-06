<?php
    class DAOAfetados {
        private PDO $pdo;

        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }

        // Insert data of "Afetados" into the table
        // Returns a model if the insertion is successful, otherwise returns null
        public function insert(Relatorio $relatorio, int $adultos, int $criancas, int $idosos, int $especiais, int $mortos, int $feridos, int $enfermos): ?Afetados{
            // Try to insert the provided data into the database
            $insertion = $this->pdo->prepare("INSERT INTO Afetados (id_relatorio, adultos, criancas, idosos, especiais, mortos, feridos, enfermos) VALUES (:idRelatorio, :adultos, :criancas, :idosos, :especiais, :mortos, :feridos, :enfermos)");
            $insertion->bindValue(":idRelatorio", $relatorio->getId());
            $insertion->bindValue(":adultos", $adultos);
            $insertion->bindValue(":criancas", $criancas);
            $insertion->bindValue(":idosos", $idosos);
            $insertion->bindValue(":especiais", $especiais);
            $insertion->bindValue(":mortos", $mortos);
            $insertion->bindValue(":feridos", $feridos);
            $insertion->bindValue(":enfermos", $enfermos);

            // Try to insert, if successful, return the corresponding model
            if ($insertion->execute()) {
                // Retrieve the ID of the last inserted instance and return a corresponding model for it
                $last_id = intval($this->pdo->lastInsertId());
                return new Afetados($last_id, $relatorio->getId(), $adultos, $criancas, $idosos, $especiais, $mortos, $feridos, $enfermos);
            }

            // Otherwise, return null
            return null;
        }

        // Remove the "Afetados" model entry from the table
        // Returns true if the removal is successful, otherwise returns false
        public function remove(Afetados $afetados): bool{
            $deletion = $this->pdo->prepare("DELETE FROM Afetados WHERE id = :id");
            $deletion->bindValue(":id", $afetados->getId());
            return $deletion->execute();
        }

        // Find a single entry in the "Afetados" table
        // Returns a model if found, returns null otherwise
        public function findById(int $id): ?Afetados{
            $statement = $this->pdo->query("SELECT * FROM Afetados WHERE id = " . $id);
            $queries = $statement->fetchAll(PDO::FETCH_ASSOC);

            // Only one entry is needed, in this case, the first one
            if ($queries) {
                $query = $queries[0];
                return new Afetados($id, $query['id_relatorio'], $query['adultos'], $query['criancas'], $query['idosos'], $query['especiais'], $query['mortos'], $query['feridos'], $query['enfermos']);
            }
            return null;
        }
        
        // Find a single entry in the "Afetados" table by "Relatorio" reference
        // Returns a model if found, returns null otherwise
        public function findByRelatorio(Relatorio $relatorio): ?Afetados{
            $statement = $this->pdo->query("SELECT * FROM Afetados WHERE id_relatorio = " . $relatorio->getId());
            $queries = $statement->fetchAll(PDO::FETCH_ASSOC);

            // Only one entry is needed, in this case, the first one
            if ($queries) {
                $query = $queries[0];
                return new Afetados($query['id'], $query['id_relatorio'], $query['adultos'], $query['criancas'], $query['idosos'], $query['especiais'], $query['mortos'], $query['feridos'], $query['enfermos']);
            }
            return null;
        }
        
        // Return all records of "Afetados"
        // Returns an array with all the found models, returns an empty array in case of an error
        public function listAll(): ?array{
            $statement = $this->pdo->query("SELECT * FROM Afetados");
            $queries = $statement->fetchAll(PDO::FETCH_ASSOC);

            // All entries will be traversed
            if ($queries) {
                $models = [];
                foreach ($queries as $query) {
                    $models[] = new Afetados($query['id'], $query['id_relatorio'], $query['adultos'], $query['criancas'], $query['idosos'], $query['especiais'], $query['mortos'], $query['feridos'], $query['enfermos']);
                }
                return $models;
            }
            return [];
        }

        // Update the "Afetados" entry in the table
        // Returns true if the update is successful, otherwise returns false
        public function update(Afetados $afetados): bool{
            $update = $this->pdo->prepare("UPDATE Afetados SET id_relatorio = :idRelatorio, adultos = :adultos, criancas = :criancas, idosos = :idosos, especiais = :especiais, mortos = :mortos, feridos = :feridos, enfermos = :enfermos WHERE id = :id");
            $update->bindValue(":id", $afetados->getId());
            $update->bindValue(":idRelatorio", $afetados->getIdRelatorio());
            $update->bindValue(":adultos", $afetados->getAdultos());
            $update->bindValue(":criancas", $afetados->getCriancas());
            $update->bindValue(":idosos", $afetados->getIdosos());
            $update->bindValue(":especiais", $afetados->getEspeciais());
            $update->bindValue(":mortos", $afetados->getMortos());
            $update->bindValue(":feridos", $afetados->getFeridos());
            $update->bindValue(":enfermos", $afetados->getEnfermos());
            return $update->execute();
        }
    }
?>
