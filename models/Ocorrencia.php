<?php
	class Ocorrencia{
		private $id;
		private $idTecnico;
		private $idCivil;
		private $acionamento;
		private $relatoCivil;
		private $numCasas;
		private $aprovado;
		private $dataOcorrencia;
		
		public function __construct($id, $idTecnico, $idCivil, $acionamento, $relatoCivil, $numCasas, $aprovado, $dataOcorrencia) {
			$this->id = $id;
			$this->idTecnico = $idTecnico;
			$this->idCivil = $idCivil;
			$this->acionamento = $acionamento;
			$this->relatoCivil = $relatoCivil;
			$this->numCasas = $numCasas;
			$this->aprovado = $aprovado;
			$this->dataOcorrencia = $dataOcorrencia;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getIdTecnico() {
			return $this->idTecnico;
		}
		
		public function setTecnico($tecnico) {
			$this->idTecnico = $tecnico->getId();
		}
		
		public function getIdCivil() {
			return $this->idCivil;
		}
		
		public function setCivil($civil) {
			$this->idCivil = $civil->getId();
		}
		
		public function getAcionamento() {
			return $this->acionamento;
		}
		
		public function setAcionamento($acionamento) {
			$this->acionamento = $acionamento;
		}
		
		public function getRelatoCivil() {
			return $this->relatoCivil;
		}
		
		public function setRelatoCivil($relatoCivil) {
			$this->relatoCivil = $relatoCivil;
		}
		
		public function getNumCasas() {
			return $this->numCasas;
		}
		
		public function setNumCasas($numCasas) {
			$this->numCasas = $numCasas;
		}
		
		public function getAprovado() {
			return $this->aprovado;
		}
		
		public function setAprovado($aprovado) {
			$this->aprovado = $aprovado;
		}
		
		public function getDataOcorrencia() {
			return $this->dataOcorrencia;
		}
		
		public function setDataOcorrencia($dataOcorrencia) {
			$this->dataOcorrencia = $dataOcorrencia;
		}
	}
?>