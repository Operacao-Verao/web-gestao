<?php
    class DAOCasa {
        private PDO $pdo;
        
        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }
        
        // Insert data of "Casa" into the table
        // Returns a model if the insertion is successful, otherwise returns null
        public function insert(Local $local, int $interdicao, string $complemento): ?Casa{
            $insertion = $this->pdo->prepare("INSERT INTO Casa (id_local, interdicao, complemento) VALUES (:id_local, :interdicao, :complemento)");
            $insertion->bindValue(":id_local", $local->getId());
            $insertion->bindValue(":interdicao", $interdicao);
            $insertion->bindValue(":complemento", $complemento);

            if ($insertion->execute()) {
                $last_id = intval($this->pdo->lastInsertId());
                return new Casa($last_id, $local->getId(), $interdicao, $complemento);
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
            $statement = $this->pdo->query("SELECT * FROM Casa WHERE id = " .$id);
            $queries = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($queries) {
                $query = $queries[0];
                return new Casa($id, $query['id_local'], $query['interdicao'], $query['complemento']);
            }
            return null;
        }
        
        // Return all records of "Casa"
        // Returns an array with all the found models, returns an empty array in case of an error
        public function listAll(): ?array{
            $statement = $this->pdo->query("SELECT * FROM Casa");
            $queries = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($queries) {
                $models = [];
                foreach ($queries as $query) {
                    $models[] = new Casa($query['id'], $query['id_local'], $query['interdicao'], $query['complemento']);
                }
                return $models;
            }
            return [];
        }

        // Search for all entries of "Casa" that matches the searched text
        // Returns an array with all the found models, returns an empty array in case of not
        public function listBySearch(string $text): ?array{
            $statement = $this->pdo->query("SELECT * FROM Casa INNER JOIN Local on Casa.id_local = Local.id WHERE cep like '".$text."%' or numero like '".$text."%' or complemento like '".$text."%'");
            $queries = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($queries) {
                $models = [];
                foreach ($queries as $query) {
                    $models[] = new Casa($query['id'], $query['id_local'], $query['interdicao'], $query['complemento']);
                }
                return $models;
            }
            return [];
        }
        
        // Find a single entry in the "Casa" table by cep and numero
        // Returns a model if found, returns null otherwise
        public function listByCepNumero(string $cep, string $numero): ?array{
            $statement = $this->pdo->query("SELECT * FROM Casa INNER JOIN Local ON Casa.id_local = Local.id WHERE cep = " . $cep." and numero = ".$numero);
            $queries = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($queries) {
                $models = [];
                foreach ($queries as $query) {
                    $models[] = new Casa($query['id'], $query['id_local'], $query['interdicao'], $query['complemento']);
                }
                return $models;
            }
            return [];
        }
        
        // Update the "Casa" entry in the table
        // Returns true if the update is successful, otherwise returns false
        public function update(Casa $casa): bool{
            $update = $this->pdo->prepare("UPDATE Casa SET id_local = :id_local, interdicao = :interdicao, complemento = :complemento WHERE id = :id");
            $update->bindValue(":id", $casa->getId());
            $update->bindValue(":id_local", $casa->getIdLocal());
            $update->bindValue(":interdicao", $casa->getInterdicao());
            $update->bindValue(":complemento", $casa->getComplemento());
            return $update->execute();
        }
    }
?>
