<?php
	include_once("../actions/conn.php");
	include_once("../models/Tecnico.php");
	
	class DAOTecnico{
		private $pdo;
		
		public function __construct($pdo) {
			$this->pdo = $pdo;
		}
		
		// Insere dados de tecnico na tabela
		// Retorna um modelo se for realizado com sucesso, retona null do contrário
		public function insert($funcionario) {
			// Tenta inserir os dados fornecidos no banco de dados
			$insertion = $this->pdo->prepare("insert into Tecnico (id_funcionario) values (:funcionario)");
			$insertion->bindValue(":funcionario", $funcionario->getId());

			// Tenta inserir, se for um sucesso, retorna o modelo correspondente
			if ($insertion->execute()){
				// Resgata a id da última instância inserida, e retorna um modelo correspondente á ela
				$last_id = intval($this->pdo->lastInsertId());
				return new Tecnico($last_id, $funcionario->getId());
			}

			// Do contrário retorna nulo
			return null;
		}
		
		// Remove a entrada de modelo Tecnico da tabela
		// Retorna true se for realizado com sucesso, do contrário retorna false
		public function remove($tecnico) {
			$insertion = $this->pdo->prepare("delete from Tecnico where id = :id");
			$insertion->bindValue(":id", $tecnico->getId());
			return $insertion->execute();
		}
		
		// Procura uma única entrada na tabela Tecnico
		// Retorna um modelo se for encontrado, retorna null do contrário
		public function findById($id) {
			$statement = $this->pdo->query("select * from Tecnico where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Apenas uma entrada será necessária, no caso, a primeira
			if ($queries){
				$query = $queries[0];
				return new Tecnico($id, $query['id_funcionario']);
			}
			return null;
		}
		
		// Retorna todos os cadastros de Tecnico
		// Retorna um array com todos os modelos encontrados, retorna null em caso de erro
		public function listAll() {
			$statement = $this->pdo->query("select * from Tecnico");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// Todas as entradas serão percorridas
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new Tecnico($query['id'], $query['id_funcionario']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Atualiza a entrada de Tecnico na tabela
		// Retorna true se for realizado com sucesso, do contrário retorna false
		public function update($tecnico) {
			$insertion = $this->pdo->prepare("update Tecnico set id_funcionario = :funcionario where id = :id");
			$insertion->bindValue(":id", $tecnico->getId());
			$insertion->bindValue(":funcionario", $tecnico->getIdFuncionario());
			return $insertion->execute();
		}
	}
?>