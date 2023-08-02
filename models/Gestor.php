<?php 
    class Gestor {
        private $id;
        private $idFuncionario;
    
        public function __construct($id, $idFuncionario) {
            $this->id = $id;
            $this->idFuncionario = $idFuncionario;
        }
    
        public function getId() {
            return $this->id;
        }
    
        public function getIdFuncionario() {
            return $this->idFuncionario;
        }
        
        public function setFuncionario($funcionario) {
            $this->idFuncionario = $funcionario->getId();
        }
    }
    
?>