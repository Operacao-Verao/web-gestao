<?php
	include_once("../actions/conn.php");
	include_once("../models/Comunicado.php");
	
	class DAOComunicado{
		private $pdo;
		
		public function __construct($pdo) {
			$this->pdo = $pdo;
		}
		
		// Insere dados de comunicado na tabela
		// Retorna um modelo se for realizado com sucesso, retona null do contrário
		public function insert($gestor, $conteudo) {
			// Tenta inserir os dados fornecidos no banco de dados
			$insertion = $this->pdo->prepare("insert into Comunicado (id_gestor, conteudo) values (:gestor, :conteudo)");
			$insertion->bindValue(":gestor", $gestor->getId());
			$insertion->bindValue(":conteudo", $conteudo);

			// Tenta inserir, se for um sucesso, retorna o modelo correspondente
			if ($insertion->execute()){
				// Resgata a id da última instância inserida, e retorna um modelo correspondente á ela
				$last_id = intval($this->pdo->lastInsertId());
				return new Comunicado($last_id, $gestor->getId(), $conteudo);
			}

			// Do contrário retorna nulo
			return null;
		}
		
		// Remove a entrada de modelo Comunicado da tabela
		// Retorna true se for realizado com sucesso, do contrário retorna false
		public function remove($comunicado) {
			$insertion = $this->pdo->prepare("delete from Comunicado where id = :id");
			$insertion->bindValue(":id", $comunicado->getId());
			return $insertion->execute();
		}
		
		// Procura uma única entrada na tabela Comunicado
		// Retorna um modelo se for encontrado, retorna null do contrário
		public function findById($id) {
			$statement = $this->pdo->query("select * from Comunicado where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Apenas uma entrada será necessária, no caso, a primeira
			if ($queries){
				$query = $queries[0];
				return new Comunicado($id, $query['id_gestor'], $query['conteudo']);
			}
			return null;
		}
		
		// Retorna todos os cadastros de Comunicado
		// Retorna um array com todos os modelos encontrados, retorna null em caso de erro
		public function listAll() {
			$statement = $this->pdo->query("select * from Comunicado");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// Todas as entradas serão percorridas
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new Comunicado($query['id'], $query['id_gestor'], $query['conteudo']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Atualiza a entrada de Comunicado na tabela
		// Retorna true se for realizado com sucesso, do contrário retorna false
		public function update($comunicado) {
			$insertion = $this->pdo->prepare("update Comunicado set id_gestor = :gestor, conteudo = :conteudo where id = :id");
			$insertion->bindValue(":id", $comunicado->getId());
			$insertion->bindValue(":gestor", $comunicado->getIdGestor());
			$insertion->bindValue(":conteudo", $comunicado->getConteudo());
			return $insertion->execute();
		}
	}
?>