<?php
	include_once("../actions/conn.php");
	include_once("../models/DadosDaVistoria.php");
	
	class DAODadosDaVistoria{
		private $pdo;
		
		public function __construct($pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "DadosDaVistoria" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert($relatorio, $desmoronamento, $deslizamento, $esgotoEscoamento, $erosao, $inundacao, $incendio, $arvores, $infiltracaoTrinca, $judicial, $monitoramento, $transito, $outros) {
			// Try to insert the provided data into the database
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

			// Try to insert, if successful, return the corresponding model
			if ($insertion->execute()){
				// Retrieve the ID of the last inserted instance and return a corresponding model for it
				$last_id = intval($this->pdo->lastInsertId());
				return new DadosDaVistoria($last_id, $relatorio->getId(), $desmoronamento, $deslizamento, $esgotoEscoamento, $erosao, $inundacao, $incendio, $arvores, $infiltracaoTrinca, $judicial, $monitoramento, $transito, $outros);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "DadosDaVistoria" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove($dadosDaVistoria) {
			$insertion = $this->pdo->prepare("delete from DadosDaVistoria where id = :id");
			$insertion->bindValue(":id", $dadosDaVistoria->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "DadosDaVistoria" table
		// Returns a model if found, returns null otherwise
		public function findById($id) {
			$statement = $this->pdo->query("select * from DadosDaVistoria where id = ".$id);
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);

			// Only one entry is needed, in this case, the first one
			if ($queries){
				$query = $queries[0];
				return new DadosDaVistoria($id, $query['id_relatorio'], $query['desmoronamento'], $query['deslizamento'], $query['esgoto_escoamento'], $query['erosao'], $query['inundacao'], $query['incendio'], $query['arvores'], $query['infiltracao_trinca'], $query['judicial'], $query['monitoramento'], $query['transito'], $query['outros']);
			}
			return null;
		}
		
		// Return all records of "DadosDaVistoria"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll() {
			$statement = $this->pdo->query("select * from DadosDaVistoria");
			$queries = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			// All entries will be traversed
			if ($queries){
				$modelos = [];
				foreach ($queries as $query){
					$modelos[] = new DadosDaVistoria($query['id'], $query['id_relatorio'], $query['desmoronamento'], $query['deslizamento'], $query['esgoto_escoamento'], $query['erosao'], $query['inundacao'], $query['incendio'], $query['arvores'], $query['infiltracao_trinca'], $query['judicial'], $query['monitoramento'], $query['transito'], $query['outros']);
				}
				return $modelos;
			}
			return [];
		}
		
		// Update the "DadosDaVistoria" entry in the table
		// Returns true if the update is successful, otherwise returns false
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