<?php
	include_once("../actions/conn.php");
	include_once("../models/DadosDaVistoria.php");
	
	class DAODadosDaVistoria{
		private $pdo;
		
		public function __construct($pdo) {
			$this->pdo = $pdo;
		}
		
		// Insere dados de funcionário na tabela
		// Retorna um modelo se for realizado com sucesso, retona null do contrário
		public function insert($relatorio, $desmoronamento, $deslizamento, $esgotoEscoamento, $erosao, $inundacao, $incendio, $arvores, $infiltracaoTrinca, $judicial, $monitoramento, $transito, $outros) {
			// Tenta inserir os dados fornecidos no banco de dados
			$insertion = $this->pdo->prepare("insert into DadosDaVistoria (id_relatorio, desmoronamento, deslizamento, esgoto_escoamento, erosao, inundacao, incendio, arvores, infiltracao_trinca, judicial, monitoramento, transito, outros) values (:relatorio, :desmoronamento, :deslizamento, :esgoto_escoamento, :erosao, :inundacao, :incendio, :arvores, :infiltracao_trinca, :judicial, :monitoramento, :transito, :outros)");
			$insertion->bindValue(":relatorio", $relatorio->getId());
			$insertion->bindValue(":desmoronamento", $desmoronamento);
			$insertion->bindValue(":deslizamento", $deslizamento);
			$insertion->bindValue(":esgoto_escoamento", $esgotoEscoamento);
			$insertion->bindValue(":erosao", $erosao);
			$insertion->bindValue(":inundacao", $inundacao);
			$insertion->bindValue(":incendio", $incendio);
			$insertion->bindValue(":arvores", $arvores);
			$insertion->bindValue(":infiltracao_trinca", $infiltracaoTrinca);
			$insertion->bindValue(":judicial", $judicial);
			$insertion->bindValue(":monitoramento", $monitoramento);
			$insertion->bindValue(":transito", $transito);
			$insertion->bindValue(":outros", $outros);

			// Tenta inserir, se for um sucesso, retorna o modelo correspondente
			if ($insertion->execute()){
				// Resgata a id da última instância inserida, e retorna um modelo correspondente á ela
				$last_id = intval($this->pdo->lastInsertId());
				return new DadosDaVistoria($last_id, $relatorio->getId(), $desmoronamento, $deslizamento, $esgotoEscoamento, $erosao, $inundacao, $incendio, $arvores, $infiltracaoTrinca, $judicial, $monitoramento, $transito, $outros);
			}

			// Do contrário retorna nulo
			return null;
		}
		
		// Remove a entrada de modelo DadosDaVistoria da tabela
		// Retorna true se for realizado com sucesso, do contrário retorna false
		public function remove($dadosDaVistoria) {
			$insertion = $this->pdo->prepare("delete from DadosDaVistoria where id = :id");
			$insertion->bindValue(":id", $dadosDaVistoria->getId());
			return $insertion->execute();
		}
		
		// Procura uma única entrada na tabela DadosDaVistoria
		// Retorna um modelo se for encontrado, retorna null do contrário
		public function findById($id) {
			$statement = $this->pdo->query("select * from DadosDaVistoria where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Apenas uma entrada será necessária, no caso, a primeira
			if ($queries){
				$query = $queries[0];
				return new DadosDaVistoria($id, $query['id_relatorio'], $query['desmoronamento'], $query['deslizamento'], $query['esgoto_escoamento'], $query['erosao'], $query['inundacao'], $query['incendio'], $query['arvores'], $query['infiltracao_trinca'], $query['judicial'], $query['monitoramento'], $query['transito'], $query['outros']);
			}
			return null;
		}
		
		// Retorna todos os cadastros de DadosDaVistoria
		// Retorna um array com todos os modelos encontrados, retorna null em caso de erro
		public function listAll() {
			$statement = $this->pdo->query("select * from DadosDaVistoria");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// Todas as entradas serão percorridas
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new DadosDaVistoria(, $query['id'], $query['id_relatorio'], $query['desmoronamento'], $query['deslizamento'], $query['esgoto_escoamento'], $query['erosao'], $query['inundacao'], $query['incendio'], $query['arvores'], $query['infiltracao_trinca'], $query['judicial'], $query['monitoramento'], $query['transito'], $query['outros']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Atualiza a entrada de DadosDaVistoria na tabela
		// Retorna true se for realizado com sucesso, do contrário retorna false
		public function update($dadosDaVistoria) {
			$insertion = $this->pdo->prepare("update DadosDaVistoria set id_relatorio = :id_relatorio, desmoronamento = :desmoronamento, deslizamento = :deslizamento, esgoto_escoamento = :esgoto_escoamento, erosao = :erosao, inundacao = :inundacao, incendio = :incendio, arvores = :arvores, infiltracao_trinca = :infiltracao_trinca, judicial = :judicial, monitoramento = :monitoramento, transito = :transito, outros = :outros where id = :id");
			$insertion->bindValue(":id", $dadosDaVistoria->getId());
			$insertion->bindValue(":id_relatorio", $dadosDaVistoria->getIdRelatorio());
			$insertion->bindValue(":desmoronamento", $dadosDaVistoria->getDesmoronamento());
			$insertion->bindValue(":deslizamento", $dadosDaVistoria->getDeslizamento());
			$insertion->bindValue(":esgoto_escoamento", $dadosDaVistoria->getEsgotoEscoamento());
			$insertion->bindValue(":erosao", $dadosDaVistoria->getErosao());
			$insertion->bindValue(":inundacao", $dadosDaVistoria->getInundacao());
			$insertion->bindValue(":incendio", $dadosDaVistoria->getIncendio());
			$insertion->bindValue(":arvores", $dadosDaVistoria->getArvores());
			$insertion->bindValue(":infiltracao_trinca", $dadosDaVistoria->getInfiltracaoTrinca());
			$insertion->bindValue(":judicial", $dadosDaVistoria->getJudicial());
			$insertion->bindValue(":monitoramento", $dadosDaVistoria->getMonitoramento());
			$insertion->bindValue(":transito", $dadosDaVistoria->getTransito());
			$insertion->bindValue(":outros", $dadosDaVistoria->getOutros());
			return $insertion->execute();
		}
	}
?>