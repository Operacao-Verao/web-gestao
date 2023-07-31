<?php 
    class Gestor {
        private $id;
        private $funcionarioId;
    
        public function __construct($id, $funcionarioId) {
            $this->id = $id;
            $this->funcionarioId = $funcionarioId;
        }
    
        public function getId() {
            return $this->id;
        }
    
        public function getFuncionarioId() {
            return $this->funcionarioId;
        }
        
        public function setFuncionario($funcionario) {
            $this->funcionarioId = $funcionario->getId();
        }
    }
    
?>