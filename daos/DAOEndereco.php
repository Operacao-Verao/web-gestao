<?php
	include_once("../actions/conn.php");
	include_once("../models/Endereco.php");
	
	class DAOEndereco{
		private $pdo;
		
		public function __construct($pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Endereco" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert($cep, $rua, $bairro, $cidade) {
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("insert into Endereco (cep, rua, bairro, cidade) values (:cep, :rua, :bairro, :cidade)");
			$insertion->bindValue(":cep", $cep);
			$insertion->bindValue(":rua", $rua);
			$insertion->bindValue(":bairro", $bairro);
			$insertion->bindValue(":cidade", $cidade);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				return new Endereco($cep, $rua, $bairro, $cidade);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Endereco" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove($endereco) {
			$insertion = $this->pdo->prepare("delete from Endereco where cep = :cep");
			$insertion->bindValue(":cep", $endereco->getCep());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Endereco" table
		// Returns a model if found, returns null otherwise
		public function findByCep($cep) {
			$statement = $this->pdo->query("select * from Endereco where cep = ".$cep);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one

			if ($queries){
				$query = $queries[0];
				return new Endereco($query['cep'], $query['rua'], $query['bairro'], $query['cidade']);
			}
			return null;
		}
		
		// Return all records of "Afetados"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll() {
			$statement = $this->pdo->query("select * from Endereco");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new Endereco($query['cep'], $query['rua'], $query['bairro'], $query['cidade']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Update the "Afetados" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update($endereco) {
			$insertion = $this->pdo->prepare("update Endereco set cep = :cep, rua = :rua, bairro = :bairro, cidade = :cidade where cep = :cep");
			$insertion->bindValue(":cep", $endereco->getCep());
			$insertion->bindValue(":rua", $endereco->getRua());
			$insertion->bindValue(":bairro", $endereco->getBairro());
			$insertion->bindValue(":cidade", $endereco->getCidade());
			return $insertion->execute();
		}
	}
?>