<?php
	class AlertaRio{
		private id;
		private idFluv;
		private status;
		private data;
		
		public function __construct($id, $idFluv, $status, $data) {
			$this->id = $id;
			$this->idFluv = $idFluv;
			$this->status = $status;
			$this->data = $data;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getIdFluv() {
			return $this->idFluv;
		}
		
		public function setFluviometro($fluviometro) {
			$this->idFluv = $fluviometro->getId();
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