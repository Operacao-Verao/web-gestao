<?php
	class Relatorio{
		private $id;
		private $idOcorrencia;
		private $idCasa;
		private $enfermos;
		private $gravidade;
		private $relatorio;
		private $encaminhamento;
		private $memorando;
		private $oficio;
		private $processo;
		private $assunto;
		private $observacoes;
		private $areaAfetada;
		private $tipoConstrucao;
		private $tipoTalude;
		private $vegetacao;
		private $danos_materiais;
		private $dataGeracao;
		private $dataAtendimento;
		
		public function __construct($id, $idOcorrencia, $idCasa, $enfermos, $gravidade, $relatorio, $encaminhamento, $memorando, $oficio, $processo, $assunto, $observacoes, $areaAfetada, $tipoConstrucao, $tipoTalude, $vegetacao, $danos_materiais, $dataGeracao, $dataAtendimento) {
			$this->id = $id;
			$this->idOcorrencia = $idOcorrencia;
			$this->idCasa = $idCasa;
			$this->enfermos = $enfermos;
			$this->gravidade = $gravidade;
			$this->relatorio = $relatorio;
			$this->encaminhamento = $encaminhamento;
			$this->memorando = $memorando;
			$this->oficio = $oficio;
			$this->processo = $processo;
			$this->assunto = $assunto;
			$this->observacoes = $observacoes;
			$this->areaAfetada = $areaAfetada;
			$this->tipoConstrucao = $tipoConstrucao;
			$this->tipoTalude = $tipoTalude;
			$this->vegetacao = $vegetacao;
			$this->danos_materiais = $danos_materiais;
			$this->dataGeracao = $dataGeracao;
			$this->dataAtendimento = $dataAtendimento;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getIdOcorrencia() {
			return $this->idOcorrencia;
		}
		
		public function setOcorrencia($ocorrencia) {
			$this->idOcorrencia = $ocorrencia->getId();
		}
		
		public function getIdCasa() {
			return $this->idCasa;
		}
		
		public function setCasa($casa) {
			$this->idCasa = $casa->getId();
		}
		
		public function getEnfermos() {
			return $this->enfermos;
		}
		
		public function setEnfermos($enfermos) {
			$this->enfermos = $enfermos;
		}
		
		public function getGravidade() {
			return $this->gravidade;
		}
		
		public function setGravidade($gravidade) {
			$this->gravidade = $gravidade;
		}
		
		public function getRelatorio() {
			return $this->relatorio;
		}
		
		public function setRelatorio($relatorio) {
			$this->relatorio = $relatorio;
		}
		
		public function getEncaminhamento() {
			return $this->encaminhamento;
		}
		
		public function setEncaminhamento($encaminhamento) {
			$this->encaminhamento = $encaminhamento;
		}
		
		public function getMemorando() {
			return $this->memorando;
		}
		
		public function setMemorando($memorando) {
			$this->memorando = $memorando;
		}
		
		public function getOficio() {
			return $this->oficio;
		}
		
		public function setOficio($oficio) {
			$this->oficio = $oficio;
		}
		
		public function getProcesso() {
			return $this->processo;
		}
		
		public function setProcesso($processo) {
			$this->processo = $processo;
		}
		
		public function getAssunto() {
			return $this->assunto;
		}
		
		public function setAssunto($assunto) {
			$this->assunto = $assunto;
		}
		
		public function getObservacoes() {
			return $this->observacoes;
		}
		
		public function setObservacoes($observacoes) {
			$this->observacoes = $observacoes;
		}
		
		public function getAreaAfetada() {
			return $this->areaAfetada;
		}
		
		public function setAreaAfetada($areaAfetada) {
			$this->areaAfetada = $areaAfetada;
		}
		
		public function getTipoConstrucao() {
			return $this->tipoConstrucao;
		}
		
		public function setTipoConstrucao($tipoConstrucao) {
			$this->tipoConstrucao = $tipoConstrucao;
		}
		
		public function getTipoTalude() {
			return $this->tipoTalude;
		}
		
		public function setTipoTalude($tipoTalude) {
			$this->tipoTalude = $tipoTalude;
		}
		
		public function getVegetacao() {
			return $this->vegetacao;
		}
		
		public function setVegetacao($vegetacao) {
			$this->vegetacao = $vegetacao;
		}
		
		public function getDanosMateriais() {
			return $this->danos_materiais;
		}
		
		public function setDanosMateriais($danos_materiais) {
			$this->danos_materiais = $danos_materiais;
		}
		
		public function getDataGeracao() {
			return $this->dataGeracao;
		}
		
		public function setDataGeracao($dataGeracao) {
			$this->dataGeracao = $dataGeracao;
		}
		
		public function getDataAtendimento() {
			return $this->dataAtendimento;
		}
		
		public function setDataAtendimento($dataAtendimento) {
			$this->dataAtendimento = $dataAtendimento;
		}
	}
?>