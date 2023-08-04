<?php
	include_once("../actions/conn.php");
	include_once("../models/Registro.php");
	
	class DAORegistro{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insere dados de registro na tabela
		// Retorna um modelo se for realizado com sucesso, retona null do contrário
		public function insert(Funcionario $funcionario, int $acao, string $descricao, string $momento): ?Registro{
			// Tenta inserir os dados fornecidos no banco de dados
			$insertion = $this->pdo->prepare("insert into Registro (id_funcionario, acao, descricao, momento) values (:funcionario, :acao, :descricao, :momento)");
			$insertion->bindValue(":funcionario", $funcionario->getId());
			$insertion->bindValue(":acao", $acao);
			$insertion->bindValue(":descricao", $descricao);
			$insertion->bindValue(":momento", $momento);

			// Tenta inserir, se for um sucesso, retorna o modelo correspondente
			if ($insertion->execute()){
				// Resgata a id da última instância inserida, e retorna um modelo correspondente á ela
				$last_id = intval($this->pdo->lastInsertId());
				return new Registro($last_id, $funcionario->getId(), $acao, $descricao, $momento);
			}

			// Do contrário retorna nulo
			return null;
		}
		
		// Remove a entrada de modelo Registro da tabela
		// Retorna true se for realizado com sucesso, do contrário retorna false
		public function remove(Registro $registro): bool{
			$insertion = $this->pdo->prepare("delete from Registro where id = :id");
			$insertion->bindValue(":id", $registro->getId());
			return $insertion->execute();
		}
		
		// Procura uma única entrada na tabela Registro
		// Retorna um modelo se for encontrado, retorna null do contrário
		public function findById(int $id): ?Registro{
			$statement = $this->pdo->query("select * from Registro where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Apenas uma entrada será necessária, no caso, a primeira
			if ($queries){
				$query = $queries[0];
				return new Registro($id, $query['idFuncionario'], $query['acao'], $query['descricao'], $query['momento']);
			}
			return null;
		}
		
		// Retorna todos os cadastros de Registro
		// Retorna um array com todos os modelos encontrados, retorna null em caso de erro
		public function listAll(): ?array{
			$statement = $this->pdo->query("select * from Registro");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// Todas as entradas serão percorridas
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new Registro($query['id'], $query['id_funcionario'], $query['acao'], $query['descricao'], $query['momento']);
				}
				return $modelos;
			}
			return [];
		}
	}
?>