<?php
    include_once $SERVER_LOCATION.'/daos/DAO.php';
    
	class DAORelatorio extends DAO{
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Relatorio" into the table
		// Returns a model if the insertion is successful, otherwise returns null
			public function insert(Ocorrencia $ocorrencia, Casa $casa, int $gravidade, string $relatorio, string $assunto, string $observacoes, int $areaAfetada, int
			$tipoConstrucao, int $tipoTalude, int $vegetacao, int $interdicao, int $situacaoVitimas, bool $danosMateriais, string $dataGeracao, string $dataAtendimento, string $assinaturaTecnico, string $assinaturaCivil): ?Relatorio{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("INSERT INTO Relatorio (id_ocorrencia, id_casa, gravidade, relatorio, assunto, observacoes, area_afetada, tipo_construcao, tipo_talude, vegetacao, situacao_vitimas, interdicao, danos_materiais, data_geracao, data_atendimento, assinatura_tecnico, assinatura_civil) VALUES (:ocorrencia, :casa, :gravidade, :relatorio, :assunto, :observacoes, :area_afetada, :tipo_construcao, :tipo_talude, :vegetacao, :situacao_vitimas, :interdicao, :danos_materiais, :data_geracao, :data_atendimento, :assinatura_tecnico, :assinatura_civil)");
			$insertion->bindValue(":ocorrencia", $ocorrencia->getId());
			$insertion->bindValue(":casa", $casa->getId());
			$insertion->bindValue(":gravidade", $gravidade);
			$insertion->bindValue(":relatorio", $relatorio);
			$insertion->bindValue(":assunto", $assunto);
			$insertion->bindValue(":observacoes", $observacoes);
			$insertion->bindValue(":area_afetada", $areaAfetada);
			$insertion->bindValue(":tipo_construcao", $tipoConstrucao);
			$insertion->bindValue(":tipo_talude", $tipoTalude);
			$insertion->bindValue(":vegetacao", $vegetacao);
			$insertion->bindValue(":situacao_vitimas", $situacaoVitimas);
			$insertion->bindValue(":interdicao", $interdicao);
			$insertion->bindValue(":danos_materiais", (int)$danosMateriais);
			$insertion->bindValue(":data_geracao", $dataGeracao);
			$insertion->bindValue(":data_atendimento", $dataAtendimento);
			$insertion->bindValue(":assinatura_tecnico", $assinaturaTecnico);
			$insertion->bindValue(":assinatura_civil", $assinaturaCivil);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$lastId = intval($this->pdo->lastInsertId());
				return new Relatorio($lastId, $ocorrencia->getId(), $casa->getId(), $gravidade, $relatorio, $assunto, $observacoes, $areaAfetada,
					$tipoConstrucao, $tipoTalude, $vegetacao, $situacaoVitimas, $interdicao, $danosMateriais, $dataGeracao, $dataAtendimento, $assinaturaTecnico, $assinaturaCivil);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Relatorio" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(Relatorio $relatorio): bool{
			$insertion = $this->pdo->prepare("DELETE FROM Relatorio WHERE id = :id");
			$insertion->bindValue(":id", $relatorio->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Relatorio" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?Relatorio{
            $select = $this->pdo->prepare('SELECT * FROM Relatorio WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Relatorio($query['id'], $query['id_ocorrencia'], $query['id_casa'], $query['gravidade'], $query['relatorio'], $query['assunto'], $query['observacoes'], $query['area_afetada'], $query['tipo_construcao'], $query['tipo_talude'], $query['vegetacao'], $query['situacao_vitimas'], $query['interdicao'], $query['danos_materiais'], $query['data_geracao'], $query['data_atendimento'], $query['assinatura_tecnico'], $query['assinatura_civil']);
            }
            return null;
		}
		
		// Find a single entry in the "Relatorio" table by its corresponding property "Ocorrencia"
		// Returns a model if found, returns null otherwise
		public function findByOcorrencia(Ocorrencia $ocorrencia): ?Relatorio{
            $select = $this->pdo->prepare('SELECT * FROM Relatorio WHERE id_ocorrencia = :id_ocorrencia');
            $select->bindValue(':id_ocorrencia', $ocorrencia->getId());
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new Relatorio($query['id'], $query['id_ocorrencia'], $query['id_casa'], $query['gravidade'], $query['relatorio'], $query['assunto'], $query['observacoes'], $query['area_afetada'], $query['tipo_construcao'], $query['tipo_talude'], $query['vegetacao'], $query['situacao_vitimas'], $query['interdicao'], $query['danos_materiais'], $query['data_geracao'], $query['data_atendimento'], $query['assinatura_tecnico'], $query['assinatura_civil']);
            }
            return null;
		}

		// Search for entry in the "Relatorio" table by its corresponding property "Casa"
		// Returns a model if found, returns null otherwise
		public function searchByCasa(Casa $casa): array{
            $select = $this->pdo->prepare('SELECT * FROM Relatorio WHERE id_casa = :id_casa'.$this->sql_length.$this->sql_offset);
            $select->bindValue(':id_casa', $casa->getId());
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Relatorio($query['id'], $query['id_ocorrencia'], $query['id_casa'], $query['gravidade'], $query['relatorio'], $query['assunto'], $query['observacoes'], $query['area_afetada'], $query['tipo_construcao'], $query['tipo_talude'], $query['vegetacao'], $query['situacao_vitimas'], $query['interdicao'], $query['danos_materiais'], $query['data_geracao'], $query['data_atendimento'], $query['assinatura_tecnico'], $query['assinatura_civil']);
            }
            return $models;
		}
		
		// Return all records of "Relatorio"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): array{
            $select = $this->pdo->prepare('SELECT * FROM Relatorio'.$this->sql_length.$this->sql_offset);
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Relatorio($query['id'], $query['id_ocorrencia'], $query['id_casa'], $query['gravidade'], $query['relatorio'], $query['assunto'], $query['observacoes'], $query['area_afetada'], $query['tipo_construcao'], $query['tipo_talude'], $query['vegetacao'], $query['situacao_vitimas'], $query['interdicao'], $query['danos_materiais'], $query['data_geracao'], $query['data_atendimento'], $query['assinatura_tecnico'], $query['assinatura_civil']);
            }
            return $models;
		}
		
        // Search for records of "Relatorio" by text
        // Returns an array with all the found models, returns an empty array in case of an error
        public function searchByText(string $text): array{
            $select = $this->pdo->prepare('SELECT Relatorio.id AS id, Relatorio.id_ocorrencia AS id_ocorrencia, Relatorio.id_casa AS id_casa, Relatorio.gravidade AS gravidade, Relatorio.relatorio AS relatorio, Relatorio.assunto AS assunto, Relatorio.observacoes AS observacoes, Relatorio.area_afetada AS area_afetada, Relatorio.tipo_construcao AS tipo_construcao, Relatorio.tipo_talude AS tipo_talude, Relatorio.vegetacao AS vegetacao, Relatorio.situacao_vitimas AS situacao_vitimas, Relatorio.interdicao AS interdicao, Relatorio.danos_materiais AS danos_materiais, Relatorio.data_geracao AS data_geracao, Relatorio.data_atendimento AS data_atendimento, Relatorio.assinatura_tecnico AS assinatura_tecnico, Relatorio.assinatura_civil AS assinatura_civil FROM Relatorio INNER JOIN Ocorrencia ON Relatorio.id_ocorrencia = Ocorrencia.id INNER JOIN Tecnico ON Ocorrencia.id_tecnico = Tecnico.id INNER JOIN Funcionario ON Tecnico.id_funcionario = Funcionario.id INNER JOIN Casa ON Relatorio.id_casa = Casa.id INNER JOIN Residencial ON Casa.id_residencial = Residencial.id INNER JOIN Endereco ON Residencial.cep = Endereco.cep WHERE ((Ocorrencia.id_tecnico = Tecnico.id AND Tecnico.id_funcionario = Funcionario.id) OR Ocorrencia.id_tecnico IS NULL) AND (Endereco.rua LIKE :text OR Endereco.bairro LIKE :text OR Residencial.numero LIKE :text OR ((NOT Ocorrencia.id_tecnico IS NULL) AND Funcionario.nome LIKE :text)) /*GROUP BY Relatorio.id */ORDER BY Relatorio.data_geracao DESC'.$this->sql_length.$this->sql_offset);
            $select->bindValue(':text', '%'.$text.'%');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new Relatorio($query['id'], $query['id_ocorrencia'], $query['id_casa'], $query['gravidade'], $query['relatorio'], $query['assunto'], $query['observacoes'], $query['area_afetada'], $query['tipo_construcao'], $query['tipo_talude'], $query['vegetacao'], $query['situacao_vitimas'], $query['interdicao'], $query['danos_materiais'], $query['data_geracao'], $query['data_atendimento'], $query['assinatura_tecnico'], $query['assinatura_civil']);
            }
            return $models;
        }

        // Search for records of "Relatorio" and count by text
        // Returns an array with all the found models, returns an empty array in case of an error
        public function countByText(string $text): int{
            $select = $this->pdo->prepare('SELECT COUNT(*) FROM Relatorio INNER JOIN Ocorrencia ON Relatorio.id_ocorrencia = Ocorrencia.id INNER JOIN Tecnico ON Ocorrencia.id_tecnico = Tecnico.id INNER JOIN Funcionario ON Tecnico.id_funcionario = Funcionario.id INNER JOIN Casa ON Relatorio.id_casa = Casa.id INNER JOIN Residencial ON Casa.id_residencial = Residencial.id INNER JOIN Endereco ON Residencial.cep = Endereco.cep WHERE ((Ocorrencia.id_tecnico = Tecnico.id AND Tecnico.id_funcionario = Funcionario.id) OR Ocorrencia.id_tecnico IS NULL) AND (Endereco.rua LIKE :text OR Endereco.bairro LIKE :text OR Residencial.numero LIKE :text OR ((NOT Ocorrencia.id_tecnico IS NULL) AND Funcionario.nome LIKE :text)) /*GROUP BY Relatorio.id */');
            $select->bindValue(':text', '%'.$text.'%');
            $select->execute();
            
            return $select->fetch()[0];
        }

        // Count and return the number of entries in "Relatorio" with the given 'interdicao' status
        public function statisticsTotal(bool $interdicao): int{
            $select = $this->pdo->prepare('SELECT COUNT(*) FROM Relatorio WHERE (:status AND (interdicao = 1 OR interdicao = 2)) OR (NOT :status AND interdicao = 0)');
            $select->bindValue(':status', $interdicao);
            $select->execute();
            
            // Return the quantity of references
            return $query = $select->fetch()[0];
        }
        
        // Count and return the number of entries in "Relatorio" with the given 'interdicao' status
        public function statisticsRecent(): int{
            $select = $this->pdo->prepare('SELECT COUNT(*) FROM Relatorio');
            $select->execute();
            
            // Return the quantity of references
            return $query = $select->fetch()[0];
        }
        
		// Update the "Relatorio" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(Relatorio $relatorio): bool{
			$insertion = $this->pdo->prepare("UPDATE Relatorio SET id_ocorrencia = :id_ocorrencia, gravidade = :gravidade, relatorio = :relatorio, assunto = :assunto, observacoes = :observacoes, area_afetada = :area_afetada, tipo_construcao = :tipo_construcao, tipo_talude = :tipo_talude, vegetacao = :vegetacao, situacao_vitimas = :situacao_vitimas, interdicao = :interdicao, danos_materiais = :danos_materiais, data_geracao = :data_geracao, data_atendimento = :data_atendimento, assinatura_tecnico = :assinatura_tecnico, assinatura_civil = :assinatura_civil WHERE id = :id");
			$insertion->bindValue(":id", $relatorio->getId());
			$insertion->bindValue(":id_ocorrencia", $relatorio->getIdOcorrencia());
			$insertion->bindValue(":gravidade", $relatorio->getGravidade());
			$insertion->bindValue(":relatorio", $relatorio->getRelatorio());
			$insertion->bindValue(":assunto", $relatorio->getAssunto());
			$insertion->bindValue(":observacoes", $relatorio->getObservacoes());
			$insertion->bindValue(":area_afetada", $relatorio->getAreaAfetada());
			$insertion->bindValue(":tipo_construcao", $relatorio->getTipoConstrucao());
			$insertion->bindValue(":tipo_talude", $relatorio->getTipoTalude());
			$insertion->bindValue(":vegetacao", $relatorio->getVegetacao());
			$insertion->bindValue(":situacao_vitimas", $relatorio->getSituacaoVitimas());
			$insertion->bindValue(":interdicao", $relatorio->getInterdicao());
			$insertion->bindValue(":danos_materiais", (int)$relatorio->getDanosMateriais());
			$insertion->bindValue(":data_geracao", $relatorio->getDataGeracao());
			$insertion->bindValue(":data_atendimento", $relatorio->getDataAtendimento());
			$insertion->bindValue(":assinatura_tecnico", $relatorio->getAssinaturaTecnico());
			$insertion->bindValue(":assinatura_civil", $relatorio->getAssinaturaCivil());
			return $insertion->execute();
		}
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM Relatorio; ALTER TABLE Relatorio AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
	}
?>