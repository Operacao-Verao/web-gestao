<?php
	class NivelRio{
		private $id;
		private $idFluviometro;
		private $nivelRio;
		private $dataDiario;
		
		public function __construct($id, $idFluviometro, $nivelRio, $dataDiario){
			$this->id = $id;
			$this->idFluviometro = $idFluviometro;
			$this->nivelRio = $nivelRio;
			$this->dataDiario = $dataDiario;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getIdFluviometro() {
			return $this->idFluviometro;
		}
		
		public function setFluviometro($fluviometro) {
			$this->idFluviometro = $fluviometro->getId();
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