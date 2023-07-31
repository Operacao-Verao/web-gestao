<?php
	class DadosDaVistoria{
		private $id;
		private $idRelatorio;
		private $desmoronamento;
		private $escorregamento;
		private $esgoto_escoamento;
		private $erosao;
		private $inundacao;
		private $incendio;
		private $arvores;
		private $infiltracao_trinca;
		private $judicial;
		private $monitoramento;
		private $transito;
		private $outros;
		
		public function __construct($id, $idRelatorio, $desmoronamento, $escorregamento, $esgoto_escoamento, $erosao, $inundacao, $incendio, $arvores, $infiltracao_trinca, $judicial, $monitoramento, $transito, $outros){
			$this->id = $id;
			$this->idRelatorio = $idRelatorio;
			$this->desmoronamento = $desmoronamento;
			$this->escorregamento = $escorregamento;
			$this->esgoto_escoamento = $esgoto_escoamento;
			$this->erosao = $erosao;
			$this->inundacao = $inundacao;
			$this->incendio = $incendio;
			$this->arvores = $arvores;
			$this->infiltracao_trinca = $infiltracao_trinca;
			$this->judicial = $judicial;
			$this->monitoramento = $monitoramento;
			$this->transito = $transito;
			$this->outros = $outros;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getIdRelatorio() {
			return $this->idRelatorio;
		}
		
		public function setRelatorio($relatorio) {
			$this->relatorio = $relatorio->getId();
		}
		
		public function getDesmoronamento() {
			return $this->desmoronamento;
		}
		
		public function setDesmoronamento($desmoronamento) {
			$this->desmoronamento = $desmoronamento;
		}
		
		public function getEscorregamento() {
			return $this->escorregamento;
		}
		
		public function setEscorregamento($escorregamento) {
			$this->escorregamento = $escorregamento;
		}
		
		public function getEsgotoEscoamento() {
			return $this->esgoto_escoamento;
		}
		
		public function setEsgotoEscoamento($esgoto_escoamento) {
			$this->esgoto_escoamento = $esgoto_escoamento;
		}
		
		public function getErosao() {
			return $this->erosao;
		}
		
		public function setErosao($erosao) {
			$this->erosao = $erosao;
		}
		
		public function getInundacao() {
			return $this->inundacao;
		}
		
		public function setInundacao($inundacao) {
			$this->inundacao = $inundacao;
		}
		
		public function getIncendio() {
			return $this->incendio;
		}
		
		public function setIncendio($incendio) {
			$this->incendio = $incendio;
		}
		
		public function getArvores() {
			return $this->arvores;
		}
		
		public function setArvores($arvores) {
			$this->arvores = $arvores;
		}
		
		public function getInfiltracaoTrinca() {
			return $this->infiltracao_trinca;
		}
		
		public function setInfiltracaoTrinca($infiltracao_trinca) {
			$this->infiltracao_trinca = $infiltracao_trinca;
		}
		
		public function getJudicial() {
			return $this->judicial;
		}
		
		public function setJudicial($judicial) {
			$this->judicial = $judicial;
		}
		
		public function getMonitoramento() {
			return $this->monitoramento;
		}
		
		public function setMonitoramento($monitoramento) {
			$this->monitoramento = $monitoramento;
		}
		
		public function getTransito() {
			return $this->transito;
		}
		
		public function setTransito($transito) {
			$this->transito = $transito;
		}
		
		public function getOutros() {
			return $this->outros;
		}
		
		public function setOutros($outros) {
			$this->outros = $outros;
		}
	}
?>