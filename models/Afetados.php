<?php 
    class Afetados {
        private $id;
        private $idRelatorio;
        private $adultos;
        private $criancas;
        private $idosos;
        private $especiais;
        private $mortos;
        private $feridos;
        private $enfermos;
    
        public function __construct($id, $idRelatorio, $adultos, $criancas, $idosos, $especiais, $mortos, $feridos, $enfermos) {
            $this->id = $id;
            $this->idRelatorio = $idRelatorio;
            $this->adultos = $adultos;
            $this->criancas = $criancas;
            $this->idosos = $idosos;
            $this->especiais = $especiais;
            $this->mortos = $mortos;
            $this->feridos = $feridos;
            $this->enfermos = $enfermos;
        }
    
        public function getId() {
            return $this->id;
        }
    
        public function getIdRelatorio() {
            return $this->idRelatorio;
        }
        
        public function setRelatorio($model_relatorio) {
            $this->idRelatorio = $model_relatorio->getId();
        }
    
        public function getAdultos() {
            return $this->adultos;
        }
        
        public function setAdultos($adultos) {
            $this->adultos = $adultos;
        }
    
        public function getCriancas() {
            return $this->criancas;
        }
        
        public function setCriancas($criancas) {
            $this->criancas = $criancas;
        }
        
        public function getIdosos() {
            return $this->idosos;
        }
        
        public function setIdosos($idosos) {
            $this->idosos = $idosos;
        }
    
        public function getEspeciais() {
            return $this->especiais;
        }
        
        public function setEspeciais($especiais) {
            $this->especiais = $especiais;
        }
    
        public function getMortos() {
            return $this->mortos;
        }
        
        public function setMortos($mortos) {
            $this->mortos = $mortos;
        }
    
        public function getFeridos() {
            return $this->feridos;
        }
        
        public function setFeridos($feridos){
            $this->feridos = $feridos;
        }
    
        public function getEnfermos() {
            return $this->enfermos;
        }
        
        public function setEnfermos($enfermos){
            $this->enfermos = $enfermos;
        }
    }
    
?>