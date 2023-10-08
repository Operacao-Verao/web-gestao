<?php
	class DAORegistro{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insere dados de registro na tabela
		// Retorna um modelo se for realizado com sucesso, retona null do contrário
		public function insert(Funcionario $funcionario, int $acao, string $descricao, string $momento): ?Registro{
			// Tenta inserir os dados fornecidos no banco de dados
			$insertion = $this->pdo->prepare("INSERT INTO Registro (id_funcionario, acao, descricao, momento) VALUES (:funcionario, :acao, :descricao, :momento)");
			$insertion->bindValue(":funcionario", $funcionario->getId());
			$insertion->bindValue(":acao", $acao);
			$insertion->bindValue(":descricao", $descricao);
			$insertion->bindValue(":momento", $momento);

			// Tenta inserir, se for um sucesso, retorna o modelo correspondente
			if ($insertion->execute()){
				// Resgata a id da última instância inserida, e retorna um modelo correspondente á ela
				$lastId = intval($this->pdo->lastInsertId());
				return new Registro($lastId, $funcionario->getId(), $acao, $descricao, $momento);
			}

			// Do contrário retorna nulo
			return null;
		}
		
		// Remove a entrada de modelo Registro da tabela
		// Retorna true se for realizado com sucesso, do contrário retorna false
		public function remove(Registro $registro): bool{
			$insertion = $this->pdo->prepare("DELETE FROM Registro WHERE id = :id");
			$insertion->bindValue(":id", $registro->getId());
			return $insertion->execute();
		}
		
		// Procura uma única entrada na tabela Registro
		// Retorna um modelo se for encontrado, retorna null do contrário
		public function findById(int $id): ?Registro{
            $select = $this->pdo->prepare('SELECT * FROM Registro WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Registro($query['id'], $query['id_funcionario'], $query['acao'], $query['descricao'], $query['momento']);
            }
            return null;
		}
		
		// Retorna todos os cadastros de Registro
		// Retorna um array com todos os modelos encontrados, retorna null em caso de erro
		public function listAll(): array{
            $select = $this->pdo->prepare('SELECT * FROM Registro');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Registro($query['id'], $query['id_funcionario'], $query['acao'], $query['descricao'], $query['momento']);
            }
            return $models;
		}
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM Registro; ALTER TABLE Registro AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
	}
?>