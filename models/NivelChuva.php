<?php
	class NivelChuva{
		private $id;
		private $idPluviometro;
		private $chuvaEmMm;
		private $dataChuva;
		
		public function __construct($id, $idPluviometro, $chuvaEmMm, $dataChuva){
			$this->id = $id;
			$this->idPluviometro = $idPluviometro;
			$this->chuvaEmMm = $chuvaEmMm;
			$this->dataChuva = $dataChuva;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getIdPluviometro() {
			return $this->idPluviometro;
		}
		
		public function setPluviometro($pluviometro) {
			$this->idPluviometro = $pluviometro->getId();
		}
		
		public function getChuvaEmMm() {
			return $this->chuvaEmMm;
		}
		
		public function setChuvaEmMm($chuvaEmMm) {
			$this->chuvaEmMm = $chuvaEmMm;
		}
		
		public function getDataChuva() {
			return $this->dataChuva;
		}
		
		public function setDataChuva($dataChuva) {
			$this->dataChuva = $dataChuva;
		}
	}
?>