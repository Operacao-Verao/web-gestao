<?php
	class NivelChuva{
		private id;
		private idPluv;
		private chuva_em_mm;
		private data;
		
		public function __construct($id, $idPluv, $chuva_em_mm, $data){
			$this->id = $id;
			$this->idPluv = $idPluv;
			$this->chuva_em_mm = $chuva_em_mm;
			$this->data = $data;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getIdPluv() {
			return $this->idPluv;
		}
		
		public function setPluviometro($pluviometro) {
			$this->idPluv = $pluviometro->getId();
		}
		
		public function getChuvaEmMM() {
			return $this->chuva_em_mm;
		}
		
		public function setChuvaEmMM($chuva_em_mm) {
			$this->chuva_em_mm = $chuva_em_mm;
		}
		
		public function getData() {
			return $this->data;
		}
		
		public function setData($data) {
			$this->data = $data;
		}
	}
?>