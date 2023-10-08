<?php
    class DAOOcorrencia {
        private PDO $pdo;
        
        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
        }
        
        // Insert data of "Ocorrencia" into the table
        // Returns a model if the insertion is successful, otherwise returns null
        public function insert(?Tecnico $tecnico, Civil $civil, Residencial $residencial, string $acionamento, string $relatoCivil, int $numCasas, int $aprovado, int $encerrado, string $dataOcorrencia): ?Ocorrencia{
            // Try to insert the provided data into the database
            $insertion = $this->pdo->prepare("INSERT INTO Ocorrencia (id_tecnico, id_civil, id_residencial, acionamento, relato_civil, num_casas, aprovado, encerrado, data_ocorrencia) VALUES (:id_tecnico, :id_civil, :id_residencial, :acionamento, :relato_civil, :num_casas, :aprovado, :encerrado, :data_ocorrencia)");
            $insertion->bindValue(":id_tecnico", $tecnico? $tecnico->getId(): null);
            $insertion->bindValue(":id_civil", $civil->getId());
            $insertion->bindValue(":id_residencial", $residencial->getId());
            $insertion->bindValue(":acionamento", $acionamento);
            $insertion->bindValue(":relato_civil", $relatoCivil);
            $insertion->bindValue(":num_casas", $numCasas);
            $insertion->bindValue(":aprovado", $aprovado);
            $insertion->bindValue(":encerrado", $encerrado);
            $insertion->bindValue(":data_ocorrencia", $dataOcorrencia);

            // Try to insert, if successful, return the corresponding model
            if ($insertion->execute()) {
                // Retrieve the ID of the last inserted instance and return a corresponding model for it
                $lastId = intval($this->pdo->lastInsertId());
                return new Ocorrencia($lastId, $tecnico? $tecnico->getId(): null, $civil->getId(), $residencial->getId(), $acionamento, $relatoCivil, $numCasas, $aprovado, $encerrado, $dataOcorrencia);
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
            $select = $this->pdo->prepare('SELECT * FROM Ocorrencia WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Ocorrencia($query['id'], $query['id_tecnico'], $query['id_civil'], $query['id_residencial'], $query['acionamento'], $query['relato_civil'], $query['num_casas'], $query['aprovado'], $query['encerrado'], $query['data_ocorrencia']);
            }
            return null;
        }
        
        
        // Search for records of "Ocorrencia" by "residencial" property
        // Returns a model if found, returns null otherwise
        public function searchByResidencial(Residencial $residencial): array{
            $select = $this->pdo->prepare('SELECT * FROM Ocorrencia WHERE id_residencial = :id_residencial ORDER BY Ocorrencia.data_ocorrencia DESC');
            $select->bindValue(':id_residencial', $residencial->getId());
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Ocorrencia($query['id'], $query['id_tecnico'], $query['id_civil'], $query['id_residencial'], $query['acionamento'], $query['relato_civil'], $query['num_casas'], $query['aprovado'], $query['encerrado'], $query['data_ocorrencia']);
            }
            return $models;
        }
        
        // Return all records of "Ocorrencia"
        // Returns an array with all the found models, returns an empty array in case of an error
        public function listAll(): array{
            $select = $this->pdo->prepare('SELECT * FROM Ocorrencia ORDER BY Ocorrencia.data_ocorrencia DESC');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Ocorrencia($query['id'], $query['id_tecnico'], $query['id_civil'], $query['id_residencial'], $query['acionamento'], $query['relato_civil'], $query['num_casas'], $query['aprovado'], $query['encerrado'], $query['data_ocorrencia']);
            }
            return $models;
        }
        
        // Search for records of "Ocorrencia" by text and "aprovado" status
        // Returns an array with all the found models, returns an empty array in case of an error
        public function searchByText(string $text, bool $status): array{
            $select = $this->pdo->prepare('SELECT Ocorrencia.id AS id, Ocorrencia.id_tecnico AS id_tecnico, Ocorrencia.id_civil AS id_civil, Ocorrencia.id_residencial AS id_residencial, Ocorrencia.acionamento AS acionamento, Ocorrencia.relato_civil AS relato_civil, Ocorrencia.num_casas AS num_casas, Ocorrencia.aprovado AS aprovado, Ocorrencia.encerrado AS encerrado, Ocorrencia.data_ocorrencia AS data_ocorrencia FROM Ocorrencia INNER JOIN Civil ON Ocorrencia.id_civil = Civil.id INNER JOIN Residencial ON Ocorrencia.id_residencial = Residencial.id INNER JOIN Endereco ON Residencial.cep = Endereco.cep WHERE (Ocorrencia.relato_civil LIKE :text OR Endereco.rua LIKE :text OR Endereco.bairro LIKE :text OR Residencial.numero LIKE :text) AND aprovado = :aprovado ORDER BY Ocorrencia.data_ocorrencia DESC');
            $select->bindValue(':text', "%".$text."%");
            $select->bindValue(':aprovado', $status);
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Ocorrencia($query['id'], $query['id_tecnico'], $query['id_civil'], $query['id_residencial'], $query['acionamento'], $query['relato_civil'], $query['num_casas'], $query['aprovado'], $query['encerrado'], $query['data_ocorrencia']);
            }
            return $models;
        }
        
        // Update the "Ocorrencia" entry in the table
        // Returns true if the update is successful, otherwise returns false
        public function update(Ocorrencia $ocorrencia): bool{
            $update = $this->pdo->prepare("UPDATE Ocorrencia SET id_tecnico = :id_tecnico, id_civil = :id_civil, id_residencial = :id_residencial, acionamento = :acionamento, relato_civil = :relato_civil, num_casas = :num_casas, aprovado = :aprovado, encerrado = :encerrado, data_ocorrencia = :data_ocorrencia WHERE id = :id");
            $update->bindValue(":id", $ocorrencia->getId());
            $update->bindValue(":id_tecnico", $ocorrencia->getIdTecnico());
            $update->bindValue(":id_civil", $ocorrencia->getIdCivil());
            $update->bindValue(":id_residencial", $ocorrencia->getIdResidencial());
            $update->bindValue(":acionamento", $ocorrencia->getAcionamento());
            $update->bindValue(":relato_civil", $ocorrencia->getRelatoCivil());
            $update->bindValue(":num_casas", $ocorrencia->getNumCasas());
            $update->bindValue(":aprovado", intval($ocorrencia->getAprovado()));
            $update->bindValue(":encerrado", intval($ocorrencia->getEncerrado()));
            $update->bindValue(":data_ocorrencia", $ocorrencia->getDataOcorrencia());
            return $update->execute();
        }
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM Ocorrencia; ALTER TABLE Ocorrencia AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
    }
?>
