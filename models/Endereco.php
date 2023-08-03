<?php
	class Endereco{
		private $cep;
		private $rua;
		private $bairro;
		private $cidade;
		
		public function __construct($cep, $rua, $bairro, $cidade) {
			$this->cep = $cep;
			$this->rua = $rua;
			$this->bairro = $bairro;
			$this->cidade = $cidade;
		}
		
		public function getCep() {
			return $this->cep;
		}
		
		public function getRua() {
			return $this->rua;
		}
		
		public function setRua($rua) {
			$this->rua = $rua;
		}
		
		public function getBairro() {
			return $this->bairro;
		}
		
		public function setBairro($bairro) {
			$this->bairro = $bairro;
		}
		
		public function getCidade() {
			return $this->cidade;
		}
		
		public function setCidade($cidade) {
			$this->cidade = $cidade;
		}
	}
?>