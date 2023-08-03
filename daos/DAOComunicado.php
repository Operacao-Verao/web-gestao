<?php
	include_once("../actions/conn.php");
	include_once("../models/Comunicado.php");
	
	class DAOComunicado{
		private $pdo;
		
		public function __construct($pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Comunicado" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert($gestor, $conteudo) {
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("insert into Comunicado (id_gestor, conteudo) values (:gestor, :conteudo)");
			$insertion->bindValue(":gestor", $gestor->getId());
			$insertion->bindValue(":conteudo", $conteudo);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$last_id = intval($this->pdo->lastInsertId());
				return new Comunicado($last_id, $gestor->getId(), $conteudo);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Comunicado" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove($comunicado) {
			$insertion = $this->pdo->prepare("delete from Comunicado where id = :id");
			$insertion->bindValue(":id", $comunicado->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Comunicado" table
		// Returns a model if found, returns null otherwise
		public function findById($id) {
			$statement = $this->pdo->query("select * from Comunicado where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one
			if ($queries){
				$query = $queries[0];
				return new Comunicado($id, $query['id_gestor'], $query['conteudo']);
			}
			return null;
		}
		
		// Return all records of "Comunicado"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll() {
			$statement = $this->pdo->query("select * from Comunicado");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new Comunicado($query['id'], $query['id_gestor'], $query['conteudo']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Update the "Comunicado" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update($comunicado) {
			$insertion = $this->pdo->prepare("update Comunicado set id_gestor = :gestor, conteudo = :conteudo where id = :id");
			$insertion->bindValue(":id", $comunicado->getId());
			$insertion->bindValue(":gestor", $comunicado->getIdGestor());
			$insertion->bindValue(":conteudo", $comunicado->getConteudo());
			return $insertion->execute();
		}
	}
?>