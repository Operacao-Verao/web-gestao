<?php 
    class Funcionario {
        private $id;
        private $nome;
        private $email;
        private $senha;
        private $tipoUsuario;
    
        public function __construct($id, $nome, $email, $senha, $tipoUsuario) {
            $this->id = $id;
            $this->nome = $nome;
            $this->email = $email;
            $this->senha = $senha;
            $this->tipoUsuario = $tipoUsuario;
        }
    
        public function getId() {
            return $this->id;
        }
    
        public function getNome() {
            return $this->nome;
        }
    
        public function getEmail() {
            return $this->email;
        }
    
        public function getSenha() {
            return $this->senha;
        }
    
        public function getTipoUsuario() {
            return $this->tipoUsuario;
        }
    }
    
?>