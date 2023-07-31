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
    
        public function getAdultos() {
            return $this->adultos;
        }
    
        public function getCriancas() {
            return $this->criancas;
        }
    
        public function getIdosos() {
            return $this->idosos;
        }
    
        public function getEspeciais() {
            return $this->especiais;
        }
    
        public function getMortos() {
            return $this->mortos;
        }
    
        public function getFeridos() {
            return $this->feridos;
        }
    
        public function getEnfermos() {
            return $this->enfermos;
        }
    }
    
?>