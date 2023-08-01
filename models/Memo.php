<?php
	class Memo{
		private $id;
		private $idRelatorio;
		private $idSecretaria;
		private $dataMemo;
		private $statusMemo;
		private $processo;
		
		public function __construct($id, $idRelatorio, $idSecretaria, $dataMemo, $statusMemo, $processo){
			$this->id = $id;
			$this->idRelatorio = $idRelatorio;
			$this->idSecretaria = $idSecretaria;
			$this->dataMemo = $dataMemo;
			$this->statusMemo = $statusMemo;
			$this->processo = $processo;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getIdRelatorio() {
			return $this->idRelatorio;
		}
		
		public function setRelatorio($relatorio) {
			$this->idRelatorio = $relatorio->getId();
		}
		
		public function getIdSecretaria() {
			return $this->idSecretaria;
		}
		
		public function setSecretaria($secretaria) {
			$this->idSecretaria = $secretaria->getId();
		}
		
		public function getDataMemo() {
			return $this->dataMemo;
		}
		
		public function setDataMemo($dataMemo) {
			$this->dataMemo = $dataMemo;
		}
		
		public function getStatusMemo() {
			return $this->statusMemo;
		}
		
		public function setStatusMemo($statusMemo) {
			$this->statusMemo = $statusMemo;
		}
		
		public function getProcesso() {
			return $this->processo;
		}
		
		public function setProcesso($processo) {
			$this->processo = $processo;
		}
	}
?>