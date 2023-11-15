<?php 
    class Tecnico {
        private int $id;
        private int $idFuncionario;
        private bool $ativo;
        private ?string $token = null;
        
        public function __construct(int $id, int $idFuncionario, bool $ativo, ?string $token) {
            $this->id = $id;
            $this->idFuncionario = $idFuncionario;
            $this->ativo = $ativo;
            if($token) { $this->token = $token; }
        }
        
        public function getId(): int {
            return $this->id;
        }
        
        public function getIdFuncionario(): int {
            return $this->idFuncionario;
        }
            
        public function setFuncionario(Funcionario $funcionario): void {
            $this->idFuncionario = $funcionario->getId();
        }
        
        public function getAtivo(): bool {
            return $this->ativo;
        }
            
        public function setAtivo(bool $ativo): void {
            $this->ativo = $ativo;
        }
        
        public function getToken(): ?string {
            return $this->token;
        }
        
        public function setToken(?string $token): void {
            $this->token = $token;
        }
    }
?>
