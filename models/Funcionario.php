<?php 
    enum TIPO_USUARIO{
        const GESTOR = 0;
        const FUNCIONARIO = 1;
    };
    
    class Funcionario {
        private int $id;
        private string $nome;
        private string $email;
        private string $senha;
        private int $tipoUsuario;
    
        public function __construct(int $id, string $nome, string $email, string $senha, int $tipoUsuario) {
            $this->id = $id;
            $this->nome = $nome;
            $this->email = $email;
            $this->senha = $senha;
            $this->tipoUsuario = $tipoUsuario;
        }
    
        public function getId(): int{
            return $this->id;
        }
    
        public function getNome(): string{
            return $this->nome;
        }
        
        public function setNome(string $nome): void{
            $this->nome = $nome;
        }
    
        public function getEmail(): string{
            return $this->email;
        }
        
        public function setEmail(string $email): void{
            $this->email = $email;
        }
    
        public function getSenha(): string{
            return $this->senha;
        }
        
        public function setSenha(string $senha): void{
            $this->senha = $senha;
        }
    
        public function getTipoUsuario(): int{
            return $this->tipoUsuario;
        }
        
        public function setTipoUsuario(int $tipo): void{
            $this->tipo = $tipo;
        }
    }
    
?>