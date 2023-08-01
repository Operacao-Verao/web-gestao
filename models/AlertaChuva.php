<?php
	class AlertaChuva{
		private $id;
		private $idPluviometro;
		private $statusChuva;
		private $dataChuva;
		
		public function __construct($id, $idPluviometro, $statusChuva, $dataChuva) {
			$this->id = $id;
			$this->idPluviometro = $idPluviometro;
			$this->statusChuva = $statusChuva;
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
		
		public function getStatusChuva() {
			return $this->statusChuva;
		}
		
		public function setStatusChuva($statusChuva) {
			$this->statusChuva = $statusChuva;
		}
		
		public function getDataChuva() {
			return $this->dataChuva;
		}
		
		public function setDataChuva($dataChuva) {
			$this->dataChuva = $dataChuva;
		}
	}
?>