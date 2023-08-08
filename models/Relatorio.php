<?php
    enum GRAVIDADE {
        const NENHUM = 0;
        const RISCO = 1;
        const DESASTRE = 2;
    };

    enum AREA_AFETADA {
        const INESPECIFICADO = 0;
        const PUBLICA = 1;
        const PARTICULAR = 2;
    };

    enum TIPO_CONSTRUCAO {
        const INESPECIFICADO = 0;
        const ALVENARIA = 1;
        const MADEIRA = 2;
        const MISTA = 3;
    };

    enum TIPO_TALUDE {
        const INESPECIFICADO = 0;
        const NATURAL = 1;
        const DE_CORTE = 2;
        const ATERRO = 3;
    };

    enum VEGETACAO {
        const NENHUMA = 0;
        const RASTEIRA = 1;
        const ARVORES = 2;
    };

    enum SITUACAO_VITIMAS {
        const INESPECIFICADO = 0;
        const DESABRIGADOS = 1;
        const DESALOJADOS = 2;
    };

    enum INTERDICAO {
        const NAO = 0;
        const PARCIAL = 1;
        const TOTAL = 2;
    };

    class Relatorio {
        private int $id;
        private int $idOcorrencia;
        private int $idCasa;
        private int $gravidade;
        private string $relatorio;
        private string $encaminhamento;
        private string $memorando;
        private string $oficio;
        private string $processo;
        private string $assunto;
        private string $observacoes;
        private int $areaAfetada;
        private int $tipoConstrucao;
        private int $tipoTalude;
        private int $vegetacao;
        private int $situacaoVitimas;
        private int $interdicao;
        private bool $danosMateriais;
        private string $dataGeracao;
        private string $dataAtendimento;

        public function __construct(int $id, int $idOcorrencia, int $idCasa, int $gravidade, string $relatorio, string $encaminhamento, string $memorando, string $oficio, string $processo, string $assunto, string $observacoes, int $areaAfetada, int
            $tipoConstrucao, int $tipoTalude, int $vegetacao, int $situacaoVitimas, int $interdicao, bool $danosMateriais, string $dataGeracao, string $dataAtendimento) {
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
        
        public function getId(): int{
            return $this->id;
        }
        
        public function getIdOcorrencia(): int{
            return $this->idOcorrencia;
        }
        
        public function setOcorrencia(int $ocorrencia): void{
            $this->idOcorrencia = $ocorrencia->getId();
        }
        
        public function getIdCasa(): int{
            return $this->idCasa;
        }
        
        public function setCasa(int $casa): void{
            $this->idCasa = $casa->getId();
        }
        
        public function getGravidade(): int{
            return $this->gravidade;
        }
        
        public function setGravidade(int $gravidade): void{
            $this->gravidade = $gravidade;
        }
        
        public function getRelatorio(): string{
            return $this->relatorio;
        }
        
        public function setRelatorio(string $relatorio): void{
            $this->relatorio = $relatorio;
        }
        
        public function getEncaminhamento(): string{
            return $this->encaminhamento;
        }
        
        public function setEncaminhamento(string $encaminhamento): void{
            $this->encaminhamento = $encaminhamento;
        }
        
        public function getMemorando(): string{
            return $this->memorando;
        }
        
        public function setMemorando(string $memorando): void{
            $this->memorando = $memorando;
        }
        
        public function getOficio(): string{
            return $this->oficio;
        }
        
        public function setOficio(string $oficio): void{
            $this->oficio = $oficio;
        }
        
        public function getProcesso(): string{
            return $this->processo;
        }
        
        public function setProcesso(string $processo): void{
            $this->processo = $processo;
        }
        
        public function getAssunto(): string{
            return $this->assunto;
        }
        
        public function setAssunto(string $assunto): void{
            $this->assunto = $assunto;
        }
        
        public function getObservacoes(): string{
            return $this->observacoes;
        }
        
        public function setObservacoes(string $observacoes): void{
            $this->observacoes = $observacoes;
        }
        
        public function getAreaAfetada(): int{
            return $this->areaAfetada;
        }
        
        public function setAreaAfetada(int $areaAfetada): void{
            $this->areaAfetada = $areaAfetada;
        }
        
        public function getTipoConstrucao(): int{
            return $this->tipoConstrucao;
        }
        
        public function setTipoConstrucao(int $tipoConstrucao): void{
            $this->tipoConstrucao = $tipoConstrucao;
        }
        
        public function getTipoTalude(): int{
            return $this->tipoTalude;
        }
        
        public function setTipoTalude(int $tipoTalude): void{
            $this->tipoTalude = $tipoTalude;
        }
        
        public function getVegetacao(): int{
            return $this->vegetacao;
        }
        
        public function setVegetacao(int $vegetacao): void{
            $this->vegetacao = $vegetacao;
        }
        
        public function getSituacaoVitimas(): int{
            return $this->situacaoVitimas;
        }
        
        public function setSituacaoVitimas(int $situacaoVitimas): void{
            $this->situacaoVitimas = $situacaoVitimas;
        }
        
        public function getInterdicao(): int{
            return $this->interdicao;
        }
        
        public function setInterdicao(int $interdicao): void{
            $this->interdicao = $interdicao;
        }
        
        public function getDanosMateriais(): bool{
            return $this->situacaoVitimas;
        }
        
        public function setDanosMateriais(bool $danosMateriais): void{
            $this->danosMateriais = $danosMateriais;
        }
        
        public function getDataGeracao(): string{
            return $this->dataGeracao;
        }
        
        public function setDataGeracao(string $dataGeracao): void{
            $this->dataGeracao = $dataGeracao;
        }
        
        public function getDataAtendimento(): string{
            return $this->dataAtendimento;
        }
        
        public function setDataAtendimento(string $dataAtendimento): void{
            $this->dataAtendimento = $dataAtendimento;
        }
    }
?>