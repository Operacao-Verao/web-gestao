<?php 
    class Tecnico {
        private int $id;
        private int $idFuncionario;
        private bool $ativo;
        
        public function __construct(int $id, int $idFuncionario, bool $ativo) {
            $this->id = $id;
            $this->idFuncionario = $idFuncionario;
            $this->ativo = $ativo;
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
            
        public function setAtivo(bool $ativo): bool {
            $this->ativo = $ativo;
        }
    }
?>
