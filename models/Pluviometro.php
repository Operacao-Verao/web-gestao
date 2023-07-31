<?php
	class Pluviometro{	
		private id;
		private cep;
		private lat;
		private long;
		
		public function __construct($id, $cep, $lat, $long){
			$this->id = $id;
			$this->cep = $cep;
			$this->lat = $lat;
			$this->long = $long;
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
		
		public function getLat() {
			return $this->lat;
		}
		
		public function setLat($lat) {
			$this->lat = $lat;
		}
		
		public function getLong() {
			return $this->long;
		}
		
		public function setLong($long) {
			$this->long = $long;
		}
	}
?>