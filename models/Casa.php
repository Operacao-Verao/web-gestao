<?php
	class Casa{
		private $id;
		private $cep;
		private $numero;
		private $complemento;
		
		public function __construct($id, $cep, $numero, $complemento){
			$this->id = $id;
			$this->cep = $cep;
			$this->numero = $numero;
			$this->complemento = $complemento;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getCep() {
			return $this->cep;
		}
		
		public function setCep($cep) {
			$this->cep = $cep;
		}
		
		public function getNumero() {
			return $this->numero;
		}
		
		public function setNumero($numero) {
			$this->numero = $numero;
		}
		
		public function getComplemento() {
			return $this->complemento;
		}
		
		public function setComplemento($complemento) {
			$this->complemento = $complemento;
		}
	}
?>