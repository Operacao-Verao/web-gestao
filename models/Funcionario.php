<?php 
    enum TIPO_USUARIO: int{
        case GESTOR = 0;
        case FUNCIONARIO = 1;
    };
    
    class Funcionario {
        private int $id;
        private string $nome;
        private string $email;
        private string $senha;
        private TIPO_USUARIO $tipoUsuario;
    
        public function __construct(int $id, string $nome, string $email, string $senha, TIPO_USUARIO $tipoUsuario) {
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
    
        public function getTipoUsuario(): TIPO_USUARIO{
            return $this->tipoUsuario;
        }
        
        public function setTipoUsuario(TIPO_USUARIO $tipo): void{
            $this->tipo = $tipo;
        }
    }
    
?>