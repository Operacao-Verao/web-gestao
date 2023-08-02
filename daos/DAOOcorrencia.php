<?php
include_once("../actions/conn.php");
include_once("../models/Ocorrencia.php");

class DAOOcorrencia {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Insert data of "Ocorrencia" into the table
    // Returns a model if the insertion is successful, otherwise returns null
    public function insert($idTecnico, $idCivil, $acionamento, $relatoCivil, $numCasas, $aprovado, $dataOcorrencia) {
        // Try to insert the provided data into the database
        $insertion = $this->pdo->prepare("INSERT INTO Ocorrencia (idTecnico, idCivil, acionamento, relatoCivil, numCasas, aprovado, dataOcorrencia) VALUES (:idTecnico, :idCivil, :acionamento, :relatoCivil, :numCasas, :aprovado, :dataOcorrencia)");
        $insertion->bindValue(":idTecnico", $idTecnico);
        $insertion->bindValue(":idCivil", $idCivil);
        $insertion->bindValue(":acionamento", $acionamento);
        $insertion->bindValue(":relatoCivil", $relatoCivil);
        $insertion->bindValue(":numCasas", $numCasas);
        $insertion->bindValue(":aprovado", $aprovado);
        $insertion->bindValue(":dataOcorrencia", $dataOcorrencia);

        // Try to insert, if successful, return the corresponding model
        if ($insertion->execute()) {
            // Retrieve the ID of the last inserted instance and return a corresponding model for it
            $last_id = intval($this->pdo->lastInsertId());
            return new Ocorrencia($last_id, $idTecnico, $idCivil, $acionamento, $relatoCivil, $numCasas, $aprovado, $dataOcorrencia);
        }

        // Otherwise, return null
        return null;
    }

    // Remove the "Ocorrencia" model entry from the table
    // Returns true if the removal is successful, otherwise returns false
    public function remove($ocorrencia) {
        $deletion = $this->pdo->prepare("DELETE FROM Ocorrencia WHERE id = :id");
        $deletion->bindValue(":id", $ocorrencia->getId());
        return $deletion->execute();
    }

    // Find a single entry in the "Ocorrencia" table
    // Returns a model if found, returns null otherwise
    public function findById($id) {
        $statement = $this->pdo->query("SELECT * FROM Ocorrencia WHERE id = " . $id);
        $queries = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Only one entry is needed, in this case, the first one
        if ($queries) {
            $query = $queries[0];
            return new Ocorrencia($id, $query['idTecnico'], $query['idCivil'], $query['acionamento'], $query['relatoCivil'], $query['numCasas'], $query['aprovado'], $query['dataOcorrencia']);
        }
        return null;
    }

    // Return all records of "Ocorrencia"
    // Returns an array with all the found models, returns an empty array in case of an error
    public function listAll() {
        $statement = $this->pdo->query("SELECT * FROM Ocorrencia");
        $queries = $statement->fetchAll(PDO::FETCH_ASSOC);

        // All entries will be traversed
        if ($queries) {
            $models = [];
            foreach ($queries as $query) {
                $models[] = new Ocorrencia($query['id'], $query['idTecnico'], $query['idCivil'], $query['acionamento'], $query['relatoCivil'], $query['numCasas'], $query['aprovado'], $query['dataOcorrencia']);
            }
            return $models;
        }
        return [];
    }

    // Update the "Ocorrencia" entry in the table
    // Returns true if the update is successful, otherwise returns false
    public function update($ocorrencia) {
        $update = $this->pdo->prepare("UPDATE Ocorrencia SET idTecnico = :idTecnico, idCivil = :idCivil, acionamento = :acionamento, relatoCivil = :relatoCivil, numCasas = :numCasas, aprovado = :aprovado, dataOcorrencia = :dataOcorrencia WHERE id = :id");
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
