<?php
	class DAODadosDaVistoria{
		private PDO $pdo;
		
		public function __construct(PDO $pdo) {
			$this->pdo = $pdo;
		}
		
		// Insert data of "DadosDaVistoria" into the table
		// Returns a model if the insertion is successful, otherwise returns null
		public function insert(Relatorio $relatorio, bool $desmoronamento, bool $deslizamento, bool $esgotoEscoamento, bool $erosao, bool $inundacao, bool $incendio, bool $arvores, bool $infiltracaoTrinca, bool $judicial, bool $monitoramento, bool $transito, string $outros): ?DadosDaVistoria{
			// Try to insert the provided data into the database
			$insertion = $this->pdo->prepare("INSERT INTO DadosDaVistoria (id_relatorio, desmoronamento, deslizamento, esgoto_escoamento, erosao, inundacao, incendio, arvores, infiltracao_trinca, judicial, monitoramento, transito, outros) VALUES (:relatorio, :desmoronamento, :deslizamento, :esgoto_escoamento, :erosao, :inundacao, :incendio, :arvores, :infiltracao_trinca, :judicial, :monitoramento, :transito, :outros)");
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
				$lastId = intval($this->pdo->lastInsertId());
				return new DadosDaVistoria($lastId, $relatorio->getId(), $desmoronamento, $deslizamento, $esgotoEscoamento, $erosao, $inundacao, $incendio, $arvores, $infiltracaoTrinca, $judicial, $monitoramento, $transito, $outros);
			}

			// Otherwise, return null
			return null;
		}
		
		// Remove the "DadosDaVistoria" model entry from the table
		// Returns true if the removal is successful, otherwise returns false
		public function remove(DadosDaVistoria $dadosDaVistoria): bool{
			$insertion = $this->pdo->prepare("DELETE FROM DadosDaVistoria WHERE id = :id");
			$insertion->bindValue(":id", $dadosDaVistoria->getId());
			return $insertion->execute();
		}
		
		// Find a single entry in the "DadosDaVistoria" table
		// Returns a model if found, returns null otherwise
		public function findById(int $id): ?DadosDaVistoria{
            $select = $this->pdo->prepare('SELECT * FROM DadosDaVistoria WHERE id = :id');
            $select->bindValue(':id', $id);
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new DadosDaVistoria($query['id'], $query['id_relatorio'], $query['desmoronamento'], $query['deslizamento'], $query['esgoto_escoamento'], $query['erosao'], $query['inundacao'], $query['incendio'], $query['arvores'], $query['infiltracao_trinca'], $query['judicial'], $query['monitoramento'], $query['transito'], $query['outros']);
            }
            return null;
		}
		
		// Find a single entry in the "DadosDaVistoria" table by "Relatorio" reference
		// Returns a model if found, returns null otherwise
		public function findByRelatorio(Relatorio $relatorio): ?DadosDaVistoria{
            $select = $this->pdo->prepare('SELECT * FROM DadosDaVistoria WHERE id_relatorio = :id_relatorio');
            $select->bindValue(':id_relatorio', $relatorio->getId());
            $select->execute();
            
            // Only one entry is needed, in this case, the first one
            if ($select->rowCount()>0){
                $query = $select->fetch();
                return new DadosDaVistoria($query['id'], $query['id_relatorio'], $query['desmoronamento'], $query['deslizamento'], $query['esgoto_escoamento'], $query['erosao'], $query['inundacao'], $query['incendio'], $query['arvores'], $query['infiltracao_trinca'], $query['judicial'], $query['monitoramento'], $query['transito'], $query['outros']);
            }
            return null;
		}
		
		// Return all records of "DadosDaVistoria"
		// Returns an array with all the found models, returns an empty array in case of an error
		public function listAll(): array{
            $select = $this->pdo->prepare('SELECT * FROM DadosDaVistoria');
            $select->execute();
            
            // All entries will be traversed
            $models = [];
            while (($query = $select->fetch())) {
                $models[] = new DadosDaVistoria($query['id'], $query['id_relatorio'], $query['desmoronamento'], $query['deslizamento'], $query['esgoto_escoamento'], $query['erosao'], $query['inundacao'], $query['incendio'], $query['arvores'], $query['infiltracao_trinca'], $query['judicial'], $query['monitoramento'], $query['transito'], $query['outros']);
            }
            return $models;
		}
		
		// Update the "DadosDaVistoria" entry in the table
		// Returns true if the update is successful, otherwise returns false
		public function update(DadosDaVistoria $dadosDaVistoria): bool{
			$insertion = $this->pdo->prepare("UPDATE DadosDaVistoria SET id_relatorio = :id_relatorio, desmoronamento = :desmoronamento, deslizamento = :deslizamento, esgoto_escoamento = :esgoto_escoamento, erosao = :erosao, inundacao = :inundacao, incendio = :incendio, arvores = :arvores, infiltracao_trinca = :infiltracao_trinca, judicial = :judicial, monitoramento = :monitoramento, transito = :transito, outros = :outros WHERE id = :id");
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
        
        // Delete all entries from the table and resets all counters
        public function clearEntire(): bool{
            if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
                return false;
            }
            $deletion = $this->pdo->prepare("DELETE FROM DadosDaVistoria; ALTER TABLE DadosDaVistoria AUTO_INCREMENT = 1;");
			return $deletion->execute();
        }
	}
?>