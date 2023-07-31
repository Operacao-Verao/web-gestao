<?php
	class AlertaChuva{
		private id;
		private idPluv;
		private status;
		private data;
		
		public function __construct($id, $idPluv, $status, $data) {
			$this->id = $id;
			$this->idPluv = $idPluv;
			$this->status = $status;
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
		
		public function getStatus() {
			return $this->status;
		}
		
		public function setStatus($status) {
			$this->status = $status;
		}
		
		public function getData() {
			return $this->data;
		}
		
		public function setData($data) {
			$this->data = $data;
		}
	}
?>