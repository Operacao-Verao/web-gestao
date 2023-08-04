<?php 
    class Tecnico {
        private int $id;
        private int $idFuncionario;
        
        public function __construct(int $id, int $idFuncionario) {
            $this->id = $id;
            $this->idFuncionario = $idFuncionario;
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
    }
?>
