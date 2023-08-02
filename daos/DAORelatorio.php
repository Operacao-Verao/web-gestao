<?php
	include_once("../actions/conn.php");
	include_once("../models/Relatorio.php");
	
	class DAORelatorio{
		private $pdo;
		
		public function __construct($pdo) {
			$this->pdo = $pdo;
		}
		
		// Insere dados de relatório na tabela
		// Retorna um modelo se for realizado com sucesso, retona null do contrário
		public function insert($ocorrencia, $casa, $enfermos, $gravidade, $relatorio, $encaminhamento, $memorando, $oficio, $processo, $assunto, $observacoes, $areaAfetada,
			$tipoConstrucao, $tipoTalude, $vegetacao, $situacaoVitimas, $interdicao, $danosMateriais, $dataGeracao, $dataAtendimento) {
			// Tenta inserir os dados fornecidos no banco de dados
			$insertion = $this->pdo->prepare("insert into Relatorio (id_ocorrencia, id_casa, enfermos, gravidade, relatorio, encaminhamento, memorando, oficio, processo, assunto, observacoes, area_afetada, tipo_construcao, tipo_talude, vegetacao, situacao_vitimas, interdicao, danos_materiais, data_geracao, data_atendimento) values (:ocorrencia, :casa, :enfermos, :gravidade, :relatorio, :encaminhamento, :memorando, :oficio, :processo, :assunto, :observacoes, :area_afetada, :tipo_construcao, :tipo_talude, :vegetacao, :situacao_vitimas, :interdicao, :danos_materiais, :data_geracao, :data_atendimento)");
			$insertion->bindValue(":ocorrencia", $ocorrencia->getId());
			$insertion->bindValue(":casa", $casa->getId());
			$insertion->bindValue(":enfermos", $enfermos);
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

			// Tenta inserir, se for um sucesso, retorna o modelo correspondente
			if ($insertion->execute()){
				// Resgata a id da última instância inserida, e retorna um modelo correspondente á ela
				$last_id = intval($this->pdo->lastInsertId());
				return new Relatorio($last_id, $ocorrencia->getId(), $casa->getId(), $enfermos, $gravidade, $relatorio, $encaminhamento, $memorando, $oficio, $processo, $assunto, $observacoes, $areaAfetada,
					$tipoConstrucao, $tipoTalude, $vegetacao, $situacaoVitimas, $interdicao, $danosMateriais, $dataGeracao, $dataAtendimento);
			}

			// Do contrário retorna nulo
			return null;
		}
		
		// Remove a entrada de modelo Relatorio da tabela
		// Retorna true se for realizado com sucesso, do contrário retorna false
		public function remove($relatorio) {
			$insertion = $this->pdo->prepare("delete from Relatorio where id = :id");
			$insertion->bindValue(":id", $relatorio->getId());
			return $insertion->execute();
		}
		
		// Procura uma única entrada na tabela Relatorio
		// Retorna um modelo se for encontrado, retorna null do contrário
		public function findById($id) {
			$statement = $this->pdo->query("select * from Relatorio where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Apenas uma entrada será necessária, no caso, a primeira
			if ($queries){
				$query = $queries[0];
				return new Relatorio($id, $query['id_ocorrencia'], $query['id_casa'], $query['enfermos'], $query['gravidade'], $query['relatorio'], $query['encaminhamento'], $query['memorando'], $query['oficio'], $query['processo'],
					$query['assunto'], $query['observacoes'], $query['area_afetada'], $query['tipo_construcao'], $query['tipo_talude'], $query['vegetacao'], $query['situacao_vitimas'], $query['interdicao'], $query['danos_materiais'], $query['data_geracao'], $query['data_atendimento']);
			}
			return null;
		}
		
		// Retorna todos os cadastros de Relatorio
		// Retorna um array com todos os modelos encontrados, retorna null em caso de erro
		public function listAll() {
			$statement = $this->pdo->query("select * from Relatorio");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// Todas as entradas serão percorridas
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new Relatorio($query['id'], $query['id_ocorrencia'], $query['id_casa'], $query['enfermos'], $query['gravidade'], $query['relatorio'], $query['encaminhamento'], $query['memorando'], $query['oficio'], $query['processo'],
					$query['assunto'], $query['observacoes'], $query['area_afetada'], $query['tipo_construcao'], $query['tipo_talude'], $query['vegetacao'], $query['situacao_vitimas'], $query['interdicao'], $query['danos_materiais'], $query['data_geracao'], $query['data_atendimento']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Atualiza a entrada de Relatorio na tabela
		// Retorna true se for realizado com sucesso, do contrário retorna false
		public function update($relatorio) {
			$insertion = $this->pdo->prepare("update Relatorio set id_ocorrencia = :id_ocorrencia, id_casa = :id_casa, enfermos = :enfermos, gravidade = :gravidade, relatorio = :relatorio, encaminhamento = :encaminhamento, memorando = :memorando, oficio = :oficio, processo = :processo, assunto = :assunto, observacoes = :observacoes, area_afetada = :area_afetada, tipo_construcao = :tipo_construcao, tipo_talude = :tipo_talude, vegetacao = :vegetacao, situacao_vitimas = :situacao_vitimas, interdicao = :interdicao, danos_materiais = :danos_materiais, data_geracao = :data_geracao, data_atendimento = :data_atendimento where id = :id");
			$insertion->bindValue(":id", $relatorio->getId());
			$insertion->bindValue(":ocorrencia", $relatorio->getIdOcorrencia());
			$insertion->bindValue(":casa", $relatorio->getIdCasa());
			$insertion->bindValue(":enfermos", $relatorio->getEnfermos());
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