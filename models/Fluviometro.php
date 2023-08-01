<?php
	class Fluviometro{	
		private $id;
		private $cep;
		private $latitude;
		private $longitude;
		
		public function __construct($id, $cep, $latitude, $longitude){
			$this->id = $id;
			$this->cep = $cep;
			$this->latitude = $latitude;
			$this->longitude = $longitude;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getCep() {
			return $this->cep;
		}
		
		public function setCep($cep) {
			$this->cep = $cep;
		}
		
		public function getLatitude() {
			return $this->latitude;
		}
		
		public function setLatitude($latitude) {
			$this->latitude = $latitude;
		}
		
		public function getLongitude() {
			return $this->longitude;
		}
		
		public function setLongitude($longitude) {
			$this->longitude = $longitude;
		}
	}
?>