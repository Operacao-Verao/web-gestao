<?php 
    class Animais {
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
    
        public function getCaes() {
            return $this->caes;
        }
    
        public function getGatos() {
            return $this->gatos;
        }
    
        public function getAves() {
            return $this->aves;
        }
    
        public function getEquinos() {
            return $this->equinos;
        }
    }
    
?>