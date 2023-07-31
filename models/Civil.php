<?php
	class Civil{
		private $id;
		private $cep;
		private $nome;
		private $email;
		private $senha;
		private $cpf;
		private $celular;
		private $telefone;
		
		public function __construct($id, $cep, $nome, $email, $senha, $cpf, $celular, $telefone){
			$this->id = $id;
			$this->cep = $cep;
			$this->nome = $nome;
			$this->email = $email;
			$this->senha = $senha;
			$this->cpf = $cpf;
			$this->celular = $celular;
			$this->telefone = $telefone;
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
		
		public function getNome() {
			return $this->nome;
		}
		
		public function setNome($nome) {
			$this->nome = $nome;
		}
		
		public function getEmail() {
			return $this->email;
		}
		
		public function setEmail($email) {
			$this->email = $email;
		}
		
		public function getSenha() {
			return $this->senha;
		}
		
		public function setSenha($senha) {
			$this->senha = $senha;
		}
		
		public function getCpf() {
			return $this->cpf;
		}
		
		public function setCpf($cpf) {
			$this->cpf = $cpf;
		}
		
		public function getCelular() {
			return $this->celular;
		}
		
		public function setCelular($celular) {
			$this->celular = $celular;
		}
		
		public function getTelefone() {
			return $this->telefone;
		}
		
		public function setTelefone($telefone) {
			$this->telefone = $telefone;
		}
	}
?>