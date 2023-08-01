<?php
	class Foto{
		private $id;
		private $idRelatorio;
		private $codificado;
		
		public function __construct($id, $idRelatorio, $codificado) {
			$this->id = $id;
			$this->idRelatorio = $idRelatorio;
			$this->codificado = $codificado;
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
    	
    	public function getCodificado() {
    		return $this->codificado;
    	}
    	
    	public function setCodificado($codificado) {
    		$this->codificado = $codificado;
    	}
	}
?>