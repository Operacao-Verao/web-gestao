<?php
	class LocalAjuda{
		private id;
		private cep;
		private tipo;
		private conteudo;
		
		public function __construct($id, $cep, $tipo, $conteudo) {
			$this->id = $id;
			$this->cep = $cep;
			$this->tipo = $tipo;
			$this->conteudo = $conteudo;
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
		
		public function getTipo() {
			return $this->tipo;
		}
		
		public function setTipo($tipo) {
			$this->tipo = tipo;
		}
		
		public function getConteudo() {
			return $this->conteudo;
		}
		
		public function setConteudo($conteudo) {
			$this->conteudo = conteudo;
		}
	}
?>