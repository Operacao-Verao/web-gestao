<?php
	const GRAVIDADE_NENHUM = 0;
	const GRAVIDADE_RISCO = 1;
	const GRAVIDADE_DESASTRE = 2;
	
	const AREA_AFETADA_INESPECIFICADO = 0;
	const AREA_AFETADA_PUBLICA = 1;
	const AREA_AFETADA_PARTICULAR = 2;
	
	const TIPO_CONSTRUCAO_INESPECIFICADO = 0;
	const TIPO_CONSTRUCAO_ALVENARIA = 1;
	const TIPO_CONSTRUCAO_MADEIRA = 2;
	const TIPO_CONSTRUCAO_MISTA = 3;
	
	const TIPO_TALUDE_INESPECIFICADO = 0;
	const TIPO_TALUDE_NATURAL = 1;
	const TIPO_TALUDE_DECORTE = 2;
	const TIPO_TALUDE_ATERRO = 3;
	
	const VEGETACAO_NENHUMA = 0;
	const VEGETACAO_RASTEIRA = 1;
	const VEGETACAO_ARVORES = 2;
	
	const SITUACAO_VITIMAS_INESPECIFICADO = 0;
	const SITUACAO_VITIMAS_DESABRIGADAS = 1;
	const SITUACAO_VITIMAS_DESALOJADAS = 2;
	
	const INTERDICAO_NAO = 0;
	const INTERDICAO_PARCIAL = 1;
	const INTERDICAO_TOTAL = 2;
	
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
		private $situacaoVitimas;
		private $interdicao;
		private $danosMateriais;
		private $dataGeracao;
		private $dataAtendimento;
		
		public function __construct($id, $idOcorrencia, $idCasa, $enfermos, $gravidade, $relatorio, $encaminhamento, $memorando, $oficio, $processo, $assunto, $observacoes, $areaAfetada, $tipoConstrucao, $tipoTalude, $vegetacao, $situacaoVitimas, $interdicao, $danosMateriais, $dataGeracao, $dataAtendimento) {
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
			$this->situacaoVitimas = $situacaoVitimas;
			$this->interdicao = $interdicao;
			$this->danosMateriais = $danosMateriais;
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
		
		public function getSituacaoVitimas() {
			return $this->situacaoVitimas;
		}
		
		public function setSituacaoVitimas($situacaoVitimas) {
			$this->situacaoVitimas = $situacaoVitimas;
		}
		
		public function getInterdicao() {
			return $this->interdicao;
		}
		
		public function setInterdicao($interdicao) {
			$this->interdicao = $interdicao;
		}
		
		public function getDanosMateriais() {
			return $this->situacaoVitimas;
		}
		
		public function setDanosMateriais($danosMateriais) {
			$this->danosMateriais = $danosMateriais;
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