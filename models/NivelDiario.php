<?php
	class NivelDiario{
		private id;
		private idFluv;
		private nivel_rio;
		private data;
		
		public function __construct($id, $idFluv, $nivel_rio, $data){
			$this->id = $id;
			$this->idFluv = $idFluv;
			$this->nivel_rio = $nivel_rio;
			$this->data = $data;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getIdFluv() {
			return $this->idFluv;
		}
		
		public function setFluviometro($fluviometro) {
			$this->idFluv = $fluviometro->getId();
		}
		
		public function getNivelRio() {
			return $this->nivel_rio;
		}
		
		public function setNivelRio($nivel_rio) {
			$this->nivel_rio = $nivel_rio;
		}
		
		public function getData() {
			return $this->data;
		}
		
		public function setData($data) {
			$this->data = $data;
		}
	}
?>