<?php
    class DAOOcorrencia {
        private PDO $pdo;
        
        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }
        
        // Insert data of "Ocorrencia" into the table
        // Returns a model if the insertion is successful, otherwise returns null
        public function insert(Tecnico|null $tecnico, Civil $civil, string $acionamento, string $relatoCivil, int $numCasas, bool $aprovado, string $dataOcorrencia): ?Ocorrencia{
            // Try to insert the provided data into the database
            $insertion = $this->pdo->prepare("INSERT INTO Ocorrencia (id_tecnico, id_civil, acionamento, relato_civil, num_casas, aprovado, data_ocorrencia) VALUES (:idTecnico, :idCivil, :acionamento, :relatoCivil, :numCasas, :aprovado, :dataOcorrencia)");
            $insertion->bindValue(":idTecnico", $tecnico? $tecnico->getId(): null);
            $insertion->bindValue(":idCivil", $civil->getId());
            $insertion->bindValue(":acionamento", $acionamento);
            $insertion->bindValue(":relatoCivil", $relatoCivil);
            $insertion->bindValue(":numCasas", $numCasas);
            $insertion->bindValue(":aprovado", $aprovado);
            $insertion->bindValue(":dataOcorrencia", $dataOcorrencia);

            // Try to insert, if successful, return the corresponding model
            if ($insertion->execute()) {
                // Retrieve the ID of the last inserted instance and return a corresponding model for it
                $last_id = intval($this->pdo->lastInsertId());
                return new Ocorrencia($last_id, $tecnico? $tecnico->getId(): null, $civil->getId(), $acionamento, $relatoCivil, $numCasas, $aprovado, $dataOcorrencia);
            }

            // Otherwise, return null
            return null;
        }

        // Remove the "Ocorrencia" model entry from the table
        // Returns true if the removal is successful, otherwise returns false
        public function remove(Ocorrencia $ocorrencia): bool{
            $deletion = $this->pdo->prepare("DELETE FROM Ocorrencia WHERE id = :id");
            $deletion->bindValue(":id", $ocorrencia->getId());
            return $deletion->execute();
        }

        // Find a single entry in the "Ocorrencia" table
        // Returns a model if found, returns null otherwise
        public function findById(int $id): ?Ocorrencia{
            $statement = $this->pdo->query("SELECT * FROM Ocorrencia WHERE id = " . $id);
            $queries = $statement->fetchAll(PDO::FETCH_ASSOC);

            // Only one entry is needed, in this case, the first one
            if ($queries) {
                $query = $queries[0];
                return new Ocorrencia($id, $query['id_tecnico'], $query['id_civil'], $query['acionamento'], $query['relato_civil'], $query['num_casas'], $query['aprovado'], $query['data_ocorrencia']);
            }
            return null;
        }

        // Return all records of "Ocorrencia"
        // Returns an array with all the found models, returns an empty array in case of an error
        public function listAll(): ?array{
            $statement = $this->pdo->query("SELECT * FROM Ocorrencia");
            $queries = $statement->fetchAll(PDO::FETCH_ASSOC);

            // All entries will be traversed
            if ($queries) {
                $models = [];
                foreach ($queries as $query) {
                    $models[] = new Ocorrencia($query['id'], $query['id_tecnico'], $query['id_civil'], $query['acionamento'], $query['relato_civil'], $query['num_casas'], $query['aprovado'], $query['data_ocorrencia']);
                }
                return $models;
            }
            return [];
        }

        // Search for records of "Ocorrencia" by text and "aprovado" status
        // Returns an array with all the found models, returns an empty array in case of an error
        public function searchByText(string $text, bool $status): ?array{
            $text = addslashes($text);
            $statement = $this->pdo->query('select * from Ocorrencia, Relatorio, Casa, Endereco where (Ocorrencia.id=Relatorio.id and Relatorio.id_casa=Casa.id and Casa.cep=Endereco.cep) and (Ocorrencia.relato_civil like "%'.$text.'%" or Endereco.rua like "%'.$text.'%" or Endereco.bairro like "%'.$text.'%" or Casa.numero like "'.$text.'%") and aprovado = '.($status?1:0));
            $queries = $statement->fetchAll(PDO::FETCH_ASSOC);

            // All entries will be traversed
            if ($queries) {
                $models = [];
                foreach ($queries as $query) {
                    $models[] = new Ocorrencia($query['id'], $query['id_tecnico'], $query['id_civil'], $query['acionamento'], $query['relato_civil'], $query['num_casas'], $query['aprovado'], $query['data_ocorrencia']);
                }
                return $models;
            }
            return [];
        }

        // Update the "Ocorrencia" entry in the table
        // Returns true if the update is successful, otherwise returns false
        public function update(Ocorrencia $ocorrencia): bool{
            $update = $this->pdo->prepare("UPDATE Ocorrencia SET id_tecnico = :idTecnico, id_civil = :idCivil, acionamento = :acionamento, relato_civil = :relatoCivil, num_casas = :numCasas, aprovado = :aprovado, data_ocorrencia = :dataOcorrencia WHERE id = :id");
            $update->bindValue(":id", $ocorrencia->getId());
            $update->bindValue(":idTecnico", $ocorrencia->getIdTecnico());
            $update->bindValue(":idCivil", $ocorrencia->getIdCivil());
            $update->bindValue(":acionamento", $ocorrencia->getAcionamento());
            $update->bindValue(":relatoCivil", $ocorrencia->getRelatoCivil());
            $update->bindValue(":numCasas", $ocorrencia->getNumCasas());
            $update->bindValue(":aprovado", $ocorrencia->getAprovado());
            $update->bindValue(":dataOcorrencia", $ocorrencia->getDataOcorrencia());
            return $update->execute();
        }
    }
?>
