<?php
	enum GRAVIDADE{
		const NENHUM = 0;
		const RISCO = 1;
		const DESASTRE = 2;
	};
	
	enum AREA_AFETADA{
		const INESPECIFICADO = 0;
		const PUBLICA = 1;
		const PARTICULAR = 2;
	};
	
	enum TIPO_CONSTRUCAO{
		const INESPECIFICADO = 0;
		const ALVENARIA = 1;
		const MADEIRA = 2;
		const MISTA = 3;
	};
	
	enum TIPO_TALUDE{
		const INESPECIFICADO = 0;
		const NATURAL = 1;
		const DE_CORTE = 2;
		const ATERRO = 3;
	};
	
	enum VEGETACAO{
		const NENHUMA = 0;
		const RASTEIRA = 1;
		const ARVORES = 2;
	};
	
	enum SITUACAO_VITIMAS{
		const INESPECIFICADO = 0;
		const DESABRIGADOS = 1;
		const DESALOJADOS = 2;
	};
	
	enum INTERDICAO{
		const NAO = 0;
		const PARCIAL = 1;
		const TOTAL = 2;
	};
	
	class Relatorio{
		private $id;
		private $idOcorrencia;
		private $idCasa;
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
		
		public function __construct($id, $idOcorrencia, $idCasa, $gravidade, $relatorio, $encaminhamento, $memorando, $oficio, $processo, $assunto, $observacoes, $areaAfetada,
			$tipoConstrucao, $tipoTalude, $vegetacao, $situacaoVitimas, $interdicao, $danosMateriais, $dataGeracao, $dataAtendimento) {
			$this->id = $id;
			$this->idOcorrencia = $idOcorrencia;
			$this->idCasa = $idCasa;
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