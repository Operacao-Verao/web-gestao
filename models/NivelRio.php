<?php
	class NivelRio{
		private $id;
		private $idFluviomatro;
		private $nivelRio;
		private $dataDiario;
		
		public function __construct($id, $idFluviomatro, $nivelRio, $dataDiario){
			$this->id = $id;
			$this->idFluviomatro = $idFluviomatro;
			$this->nivelRio = $nivelRio;
			$this->dataDiario = $dataDiario;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getIdFluviometro() {
			return $this->idFluviomatro;
		}
		
		public function setFluviometro($fluviometro) {
			$this->idFluviomatro = $fluviometro->getId();
		}
		
		public function getNivelRio() {
			return $this->nivelRio;
		}
		
		public function setNivelRio($nivelRio) {
			$this->nivelRio = $nivelRio;
		}
		
		public function getDataDiario() {
			return $this->dataDiario;
		}
		
		public function setDataDiario($dataDiario) {
			$this->dataDiario = $dataDiario;
		}
	}
?>