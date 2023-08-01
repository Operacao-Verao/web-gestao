<?php
	class AlertaRio{
		private $id;
		private $idFluviometro;
		private $statusRio;
		private $dataAlertaRio;
		
		public function __construct($id, $idFluviometro, $statusRio, $dataAlertaRio) {
			$this->id = $id;
			$this->idFluviometro = $idFluviometro;
			$this->statusRio = $statusRio;
			$this->dataAlertaRio = $dataAlertaRio;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getIdFluviometro() {
			return $this->idFluviometro;
		}
		
		public function setFluviometro($fluviometro) {
			$this->idFluviometro = $fluviometro->getId();
		}
		
		public function getStatusRio() {
			return $this->statusRio;
		}
		
		public function setStatusRio($statusRio) {
			$this->statusRio = $statusRio;
		}
		
		public function getDataAlertaRio() {
			return $this->dataAlertaRio;
		}
		
		public function setDataAlertaRio($dataAlertaRio) {
			$this->dataAlertaRio = $dataAlertaRio;
		}
	}
?>