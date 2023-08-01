<?php
	class Registro{
		private $id;
		private $idFuncionario;
		private $acao;
		private $descricao;
		private $momento;
		
		public function __construct($id, $idFuncionario, $cao, $descricao, $momento) {
			$this->id = $id;
			$this->idFuncionario = $idFuncionario;
			$this->acao = $acao;
			$this->descricao = $descricao;
			$this->momento = $momento;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getIdFuncionario() {
			return $this->idFuncionario;
		}
		
		public function getAcao() {
			return $this->acao;
		}
		
		public function getDescricao() {
			return $descricao;
		}
		
		public function getMomento() {
			return $momento;
		}
	}
?>