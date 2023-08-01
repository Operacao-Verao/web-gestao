<?php
	class Secretaria{
		private $id;
		private $nomeSecretaria;
		
		public function __construct($id, $nomeSecretaria) {
			$this->id = $id;
			$this->nomeSecretaria = $nomeSecretaria;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getNomeSecretaria() {
			return $this->nomeSecretaria;
		}
		
		public function setNomeSecretaria($nomeSecretaria) {
			$this->nomeSecretaria = $nomeSecretaria;
		}
	}
?>