<?php
	class DAORelatorio{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "Relatorio" into the table
		// Returns a model if the insertion is successful, otherwise returns null
			public function insert(Ocorrencia $ocorrencia, int $casa, int $gravidade, string $relatorio, string $encaminhamento, string $memorando, string $oficio, string $processo, string $assunto, string $observacoes, int $areaAfetada, int
			$tipoConstrucao, int $tipoTalude, int $vegetacao, int $situacaoVitimas, bool $danosMateriais, string $dataGeracao, string $dataAtendimento): ?Relatorio{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("insert into Relatorio (id_ocorrencia, id_casa, gravidade, relatorio, encaminhamento, memorando, oficio, processo, assunto, observacoes, area_afetada, tipo_construcao, tipo_talude, vegetacao, situacao_vitimas, interdicao, danos_materiais, data_geracao, data_atendimento) values (:ocorrencia, :casa, :gravidade, :relatorio, :encaminhamento, :memorando, :oficio, :processo, :assunto, :observacoes, :area_afetada, :tipo_construcao, :tipo_talude, :vegetacao, :situacao_vitimas, :interdicao, :danos_materiais, :data_geracao, :data_atendimento)");
			$insertion->bindValue(":ocorrencia", $ocorrencia->getId());
			$insertion->bindValue(":casa", $casa);
			$insertion->bindValue(":gravidade", $gravidade);
			$insertion->bindValue(":relatorio", $relatorio);
			$insertion->bindValue(":encaminhamento", $encaminhamento);
			$insertion->bindValue(":memorando", $memorando);
			$insertion->bindValue(":oficio", $oficio);
			$insertion->bindValue(":processo", $processo);
			$insertion->bindValue(":assunto", $assunto);
			$insertion->bindValue(":observacoes", $observacoes);
			$insertion->bindValue(":area_afetada", $areaAfetada);
			$insertion->bindValue(":tipo_construcao", $tipoConstrucao);
			$insertion->bindValue(":tipo_talude", $tipoTalude);
			$insertion->bindValue(":vegetacao", $vegetacao);
			$insertion->bindValue(":situacao_vitimas", $situacaoVitimas);
			$insertion->bindValue(":interdicao", $interdicao);
			$insertion->bindValue(":danos_materiais", $danosMateriais);
			$insertion->bindValue(":data_geracao", $dataGeracao);
			$insertion->bindValue(":data_atendimento", $dataAtendimento);

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$last_id = intval($this->pdo->lastInsertId());
				return new Relatorio($last_id, $ocorrencia->getId(), $casa, $gravidade, $relatorio, $encaminhamento, $memorando, $oficio, $processo, $assunto, $observacoes, $areaAfetada,
					$tipoConstrucao, $tipoTalude, $vegetacao, $situacaoVitimas, $interdicao, $danosMateriais, $dataGeracao, $dataAtendimento);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "Relatorio" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(Relatorio $relatorio): bool{
			$insertion = $this->pdo->prepare("delete from Relatorio where id = :id");
			$insertion->bindValue(":id", $relatorio->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "Relatorio" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?Relatorio{
			$statement = $this->pdo->query("select * from Relatorio where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one
			if ($queries){
				$query = $queries[0];
				return new Relatorio($id, $query['id_ocorrencia'], $query['id_casa'], $query['gravidade'], $query['relatorio'], $query['encaminhamento'], $query['memorando'], $query['oficio'], $query['processo'],
					$query['assunto'], $query['observacoes'], $query['area_afetada'], $query['tipo_construcao'], $query['tipo_talude'], $query['vegetacao'], $query['situacao_vitimas'], $query['interdicao'], $query['danos_materiais'], $query['data_geracao'], $query['data_atendimento']);
			}
			return null;
		}
		
		// Find a single entry in the "Relatorio" table by its corresponding property "Ocorrencia"
		// Returns a model if found, returns null otherwise
		public function findByOcorrencia(Ocorrencia $ocorrencia): ?Relatorio{
			$statement = $this->pdo->query("select * from Relatorio where id_ocorrencia = ".$ocorrencia->getId());
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one
			if ($queries){
				$query = $queries[0];
				return new Relatorio($query['id'], $query['id_ocorrencia'], $query['id_casa'], $query['gravidade'], $query['relatorio'], $query['encaminhamento'], $query['memorando'], $query['oficio'], $query['processo'],
					$query['assunto'], $query['observacoes'], $query['area_afetada'], $query['tipo_construcao'], $query['tipo_talude'], $query['vegetacao'], $query['situacao_vitimas'], $query['interdicao'], $query['danos_materiais'], $query['data_geracao'], $query['data_atendimento']);
			}
			return null;
		}

		// Find a single entry in the "Relatorio" table by its corresponding property "Casa"
		// Returns a model if found, returns null otherwise
		public function findByCasa(Casa $casa): ?array{
			$statement = $this->pdo->query("select * from Relatorio WHERE id_casa = ".$casa->getId());
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new Relatorio($query['id'], $query['id_ocorrencia'], $query['id_casa'], $query['gravidade'], $query['relatorio'], $query['encaminhamento'], $query['memorando'], $query['oficio'], $query['processo'],
					$query['assunto'], $query['observacoes'], $query['area_afetada'], $query['tipo_construcao'], $query['tipo_talude'], $query['vegetacao'], $query['situacao_vitimas'], $query['interdicao'], $query['danos_materiais'], $query['data_geracao'], $query['data_atendimento']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Return all records of "Relatorio"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): ?array{
			$statement = $this->pdo->query("select * from Relatorio");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new Relatorio($query['id'], $query['id_ocorrencia'], $query['id_casa'], $query['gravidade'], $query['relatorio'], $query['encaminhamento'], $query['memorando'], $query['oficio'], $query['processo'],
					$query['assunto'], $query['observacoes'], $query['area_afetada'], $query['tipo_construcao'], $query['tipo_talude'], $query['vegetacao'], $query['situacao_vitimas'], $query['interdicao'], $query['danos_materiais'], $query['data_geracao'], $query['data_atendimento']);
				}
				return $modelos;
			}
			return [];
		}
		
        // Search for records of "Relatorio" by text
        // Returns an array with all the found models, returns an empty array in case of an error
        public function searchByText(string $text): ?array{
            $text = addslashes($text);
            $statement = $this->pdo->query('select * from Tecnico, Funcionario, Relatorio inner join Ocorrencia on Relatorio.id_ocorrencia = Ocorrencia.id inner join Casa on Relatorio.id_casa = Casa.id inner join Residencial on Casa.id_residencial = Residencial.id inner join Endereco on Residencial.cep = Endereco.cep WHERE ((Ocorrencia.id_tecnico = Tecnico.id and Tecnico.id_funcionario = Funcionario.id) or Ocorrencia.id_tecnico is null) and (Endereco.rua like "%'.$text.'%" or Endereco.bairro like "%'.$text.'%" or Residencial.numero like "'.$text.'%" or ((not Ocorrencia.id_tecnico is null) and Funcionario.nome like "'.$text.'%")) group by Relatorio.id order by Relatorio.data_geracao desc');
            $queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new Relatorio($query['id'], $query['id_ocorrencia'], $query['id_casa'], $query['gravidade'], $query['relatorio'], $query['encaminhamento'], $query['memorando'], $query['oficio'], $query['processo'],
					$query['assunto'], $query['observacoes'], $query['area_afetada'], $query['tipo_construcao'], $query['tipo_talude'], $query['vegetacao'], $query['situacao_vitimas'], $query['interdicao'], $query['danos_materiais'], $query['data_geracao'], $query['data_atendimento']);
				}
				return $modelos;
			}
			return [];
        }

		// Update the "Relatorio" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(Relatorio $relatorio): bool{
			$insertion = $this->pdo->prepare("update Relatorio set id_ocorrencia = :id_ocorrencia, gravidade = :gravidade, relatorio = :relatorio, encaminhamento = :encaminhamento, memorando = :memorando, oficio = :oficio, processo = :processo, assunto = :assunto, observacoes = :observacoes, area_afetada = :area_afetada, tipo_construcao = :tipo_construcao, tipo_talude = :tipo_talude, vegetacao = :vegetacao, situacao_vitimas = :situacao_vitimas, interdicao = :interdicao, danos_materiais = :danos_materiais, data_geracao = :data_geracao, data_atendimento = :data_atendimento where id = :id");
			$insertion->bindValue(":id", $relatorio->getId());
			$insertion->bindValue(":id_ocorrencia", $relatorio->getIdOcorrencia());
			$insertion->bindValue(":gravidade", $relatorio->getGravidade());
			$insertion->bindValue(":relatorio", $relatorio->getRelatorio());
			$insertion->bindValue(":encaminhamento", $relatorio->getEncaminhamento());
			$insertion->bindValue(":memorando", $relatorio->getMemorando());
			$insertion->bindValue(":oficio", $relatorio->getOficio());
			$insertion->bindValue(":processo", $relatorio->getProcesso());
			$insertion->bindValue(":assunto", $relatorio->getAssunto());
			$insertion->bindValue(":observacoes", $relatorio->getObservacoes());
			$insertion->bindValue(":area_afetada", $relatorio->getAreaAfetada());
			$insertion->bindValue(":tipo_construcao", $relatorio->getTipoConstrucao());
			$insertion->bindValue(":tipo_talude", $relatorio->getTipoTalude());
			$insertion->bindValue(":vegetacao", $relatorio->getVegetacao());
			$insertion->bindValue(":situacao_vitimas", $relatorio->getSituacaoVitimas());
			$insertion->bindValue(":interdicao", $relatorio->getInterdicao());
			$insertion->bindValue(":danos_materiais", $relatorio->getDanosMateriais());
			$insertion->bindValue(":data_geracao", $relatorio->getDataGeracao());
			$insertion->bindValue(":data_atendimento", $relatorio->getDataAtendimento());
			return $insertion->execute();
		}
	}
?>