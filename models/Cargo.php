<?php
	class Cargo{
		private $id;
		private $nomeCargo;
		
		public function __construct($id, $nomeCargo) {
			$this->id = $id;
			$this->nomeCargo = $nomeCargo;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getNomeCargo() {
			return $this->nomeCargo;
		}
		
		public function setNomeCargo($nomeCargo) {
			$this->nomeCargo = $nomeCargo;
		}
	}
?>