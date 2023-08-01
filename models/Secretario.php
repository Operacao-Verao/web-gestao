<?php
	class Secretario{
		private $id;
		private $idSecretaria;
		private $idCargo;
		private $nomeSecretario;
		
		public function __construct($id, $idSecretaria, $idCargo, $nomeSecretario) {
			$this->id = $id;
			$this->idSecretaria = $idSecretaria;
			$this->idCargo = $idCargo;
			$this->nomeSecretario = $nomeSecretario;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getIdSecretaria() {
			return $this->idSecretaria;
		}
		
		public function setSecretaria($secretaria) {
			$this->secretaria = $secretaria->getId();
		}
		
		public function getIdCargo() {
			return $this->idCargo;
		}
		
		public function setCargo($cargo) {
			$this->idCargo = $cargo->getId();
		}
		
		public function getNomeSecretario() {
			return $this->nomeSecretario;
		}
		
		public function setNomeSecretario($nomeSecretario) {
			$this->nomeSecretario = $nomeSecretario;
		}
	}
?>