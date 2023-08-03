<?php
    include_once("../actions/conn.php");
    include_once("../models/Memo.php");
    
    class DAOMemo {
        private $pdo;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        // Insert data of "Memo" into the table
        // Returns a model if the insertion is successful, otherwise returns null
        public function insert($relatorio, $secretaria, $dataMemo, $statusMemo, $processo) {
            $insertion = $this->pdo->prepare("INSERT INTO Memo (id_relatorio, id_secretaria, data_memo, status_memo, processo) VALUES (:idRelatorio, :idSecretaria, :dataMemo, :statusMemo, :processo)");
            $insertion->bindValue(":idRelatorio", $relatorio->getId());
            $insertion->bindValue(":idSecretaria", $secretaria->getId());
            $insertion->bindValue(":dataMemo", $dataMemo);
            $insertion->bindValue(":statusMemo", $statusMemo);
            $insertion->bindValue(":processo", $processo);

            if ($insertion->execute()) {
                $last_id = intval($this->pdo->lastInsertId());
                return new Memo($last_id, $relatorio->getId(), $secretaria->getId(), $dataMemo, $statusMemo, $processo);
            }

            return null;
        }

        // Remove the "Memo" model entry from the table
        // Returns true if the removal is successful, otherwise returns false
        public function remove($memo) {
            $deletion = $this->pdo->prepare("DELETE FROM Memo WHERE id = :id");
            $deletion->bindValue(":id", $memo->getId());
            return $deletion->execute();
        }

        // Find a single entry in the "Memo" table by ID
        // Returns a model if found, returns null otherwise
        public function findById($id) {
            $statement = $this->pdo->query("SELECT * FROM Memo WHERE id = " . $id);
            $queries = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($queries) {
                $query = $queries[0];
                return new Memo($id, $query['id_relatorio'], $query['id_secretaria'], $query['data_memo'], $query['status_memo'], $query['processo']);
            }
            return null;
        }

        // Return all records of "Memo"
        // Returns an array with all the found models, returns an empty array in case of an error
        public function listAll() {
            $statement = $this->pdo->query("SELECT * FROM Memo");
            $queries = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($queries) {
                $models = [];
                foreach ($queries as $query) {
                    $models[] = new Memo($query['id'], $query['id_relatorio'], $query['id_secretaria'], $query['data_memo'], $query['status_memo'], $query['processo']);
                }
                return $models;
            }
            return [];
        }

        // Update the "Memo" entry in the table
        // Returns true if the update is successful, otherwise returns false
        public function update($memo) {
            $update = $this->pdo->prepare("UPDATE Memo SET id_relatorio = :idRelatorio, id_secretaria = :idSecretaria, data_memo = :dataMemo, status_memo = :statusMemo, processo = :processo WHERE id = :id");
            $update->bindValue(":id", $memo->getId());
            $update->bindValue(":idRelatorio", $memo->getIdRelatorio());
            $update->bindValue(":idSecretaria", $memo->getIdSecretaria());
            $update->bindValue(":dataMemo", $memo->getDataMemo());
            $update->bindValue(":statusMemo", $memo->getStatusMemo());
            $update->bindValue(":processo", $memo->getProcesso());
            return $update->execute();
        }
    }
?>
