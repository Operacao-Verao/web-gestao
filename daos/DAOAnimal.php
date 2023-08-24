<?php
    class DAOAnimal {
        private PDO $pdo;
        
        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }
        
        // Insert data of "Animal" into the table
        // Returns a model if the insertion is successful, otherwise returns null
        public function insert(Relatorio $relatorio, int $caes, int $gatos, int $aves, int $equinos): ?Animal{
            // Try to insert the provided data into the database
            $insertion = $this->pdo->prepare("INSERT INTO Animal (id_relatorio, caes, gatos, aves, equinos) VALUES (:idRelatorio, :caes, :gatos, :aves, :equinos)");
            $insertion->bindValue(":idRelatorio", $relatorio->getId());
            $insertion->bindValue(":caes", $caes);
            $insertion->bindValue(":gatos", $gatos);
            $insertion->bindValue(":aves", $aves);
            $insertion->bindValue(":equinos", $equinos);

            // Try to insert, if successful, return the corresponding model
            if ($insertion->execute()) {
                // Retrieve the ID of the last inserted instance and return a corresponding model for it
                $last_id = intval($this->pdo->lastInsertId());
                return new Animal($last_id, $relatorio->getId(), $caes, $gatos, $aves, $equinos);
            }

            // Otherwise, return null
            return null;
        }

        // Remove the "Animal" model entry from the table
        // Returns true if the removal is successful, otherwise returns false
        public function remove(Animal $animal): bool{
            $deletion = $this->pdo->prepare("DELETE FROM Animal WHERE id = :id");
            $deletion->bindValue(":id", $animal->getId());
            return $deletion->execute();
        }

        // Find a single entry in the "Animal" table
        // Returns a model if found, returns null otherwise
        public function findById($id): ?Animal{
            $statement = $this->pdo->query("SELECT * FROM Animal WHERE id = " . $id);
            $queries = $statement->fetchAll(PDO::FETCH_ASSOC);

            // Only one entry is needed, in this case, the first one
            if ($queries) {
                $query = $queries[0];
                return new Animal($id, $query['id_relatorio'], $query['caes'], $query['gatos'], $query['aves'], $query['equinos']);
            }
            return null;
        }

        // Return all records of "Animal"
        // Returns an array with all the found models, returns an empty array in case of an error
        public function listAll(): ?array{
            $statement = $this->pdo->query("SELECT * FROM Animal");
            $queries = $statement->fetchAll(PDO::FETCH_ASSOC);

            // All entries will be traversed
            if ($queries) {
                $models = [];
                foreach ($queries as $query) {
                    $models[] = new Animal($query['id'], $query['id_relatorio'], $query['caes'], $query['gatos'], $query['aves'], $query['equinos']);
                }
                return $models;
            }
            return [];
        }

        // Update the "Animal" entry in the table
        // Returns true if the update is successful, otherwise returns false
        public function update(Animal $animal): bool{
            $update = $this->pdo->prepare("UPDATE Animal SET id_relatorio = :idRelatorio, caes = :caes, gatos = :gatos, aves = :aves, equinos = :equinos WHERE id = :id");
            $update->bindValue(":id", $animal->getId());
            $update->bindValue(":idRelatorio", $animal->getIdRelatorio());
            $update->bindValue(":caes", $animal->getCaes());
            $update->bindValue(":gatos", $animal->getGatos());
            $update->bindValue(":aves", $animal->getAves());
            $update->bindValue(":equinos", $animal->getEquinos());
            return $update->execute();
        }
    }
?>
