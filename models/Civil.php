<?php
    class Civil {
        private int $id;
        private int $idCasa;
        private string $nome;
        private string $email;
        private string $senha;
        private string $cpf;
        private string $celular;
        private string $telefone;
        
        public function __construct(
            int $id, int $idCasa, string $nome, string $email, string $senha,
            string $cpf, string $celular, string $telefone
        ) {
            $this->id = $id;
            $this->idCasa = $idCasa;
            $this->nome = $nome;
            $this->email = $email;
            $this->senha = $senha;
            $this->cpf = $cpf;
            $this->celular = $celular;
            $this->telefone = $telefone;
        }
        
        public function getId(): int {
            return $this->id;
        }
        
        public function getIdCasa(): int {
            return $this->idCasa;
        }
        
        public function setCasa(Casa $casa): void {
            $this->idCasa = $casa->getId();
        }
        
        public function getNome(): string {
            return $this->nome;
        }
        
        public function setNome(string $nome): void {
            $this->nome = $nome;
        }
        
        public function getEmail(): string {
            return $this->email;
        }
        
        public function setEmail(string $email): void {
            $this->email = $email;
        }
        
        public function getSenha(): string {
            return $this->senha;
        }
        
        public function setSenha(string $senha): void {
            $this->senha = $senha;
        }
        
        public function getCpf(): string {
            return $this->cpf;
        }
        
        public function setCpf(string $cpf): void {
            $this->cpf = $cpf;
        }
        
        public function getCelular(): string {
            return $this->celular;
        }
        
        public function setCelular(string $celular): void {
            $this->celular = $celular;
        }
        
        public function getTelefone(): string {
            return $this->telefone;
        }
        
        public function setTelefone(string $telefone): void {
            $this->telefone = $telefone;
        }
    }
?>