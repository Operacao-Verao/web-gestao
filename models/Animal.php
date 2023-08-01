<?php 
    class Animal {
        private $id;
        private $idRelatorio;
        private $caes;
        private $gatos;
        private $aves;
        private $equinos;
    
        public function __construct($id, $idRelatorio, $caes, $gatos, $aves, $equinos) {
            $this->id = $id;
            $this->idRelatorio = $idRelatorio;
            $this->caes = $caes;
            $this->gatos = $gatos;
            $this->aves = $aves;
            $this->equinos = $equinos;
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
    
        public function getCaes() {
            return $this->caes;
        }
        
        public function setCaes($caes) {
            $this->caes = $caes;
        }
    
        public function getGatos() {
            return $this->gatos;
        }
        
        public function setGatos($gatos) {
            $this->gatos = $gatos;
        }
    
        public function getAves() {
            return $this->aves;
        }
        
        public function setAves($aves) {
            $this->aves = $aves;
        }
    
        public function getEquinos() {
            return $this->equinos;
        }
        
        public function setEquinos($equinos) {
            $this->equinos = $equinos;
        }
    }
    
?>