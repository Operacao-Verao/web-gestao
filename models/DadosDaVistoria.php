<?php
    class DadosDaVistoria {
        private int $id;
        private int $idRelatorio;
        private bool $desmoronamento;
        private bool $deslizamento;
        private bool $esgotoEscoamento;
        private bool $erosao;
        private bool $inundacao;
        private bool $incendio;
        private bool $arvores;
        private bool $infiltracaoTrinca;
        private bool $judicial;
        private bool $monitoramento;
        private bool $transito;
        private ?string $outros;
        
        public function __construct(
            int $id, int $idRelatorio, bool $desmoronamento, bool $deslizamento, bool $esgotoEscoamento,
            bool $erosao, bool $inundacao, bool $incendio, bool $arvores, bool $infiltracaoTrinca,
            bool $judicial, bool $monitoramento, bool $transito, ?string $outros
        ) {
            $this->id = $id;
            $this->idRelatorio = $idRelatorio;
            $this->desmoronamento = $desmoronamento;
            $this->deslizamento = $deslizamento;
            $this->esgotoEscoamento = $esgotoEscoamento;
            $this->erosao = $erosao;
            $this->inundacao = $inundacao;
            $this->incendio = $incendio;
            $this->arvores = $arvores;
            $this->infiltracaoTrinca = $infiltracaoTrinca;
            $this->judicial = $judicial;
            $this->monitoramento = $monitoramento;
            $this->transito = $transito;
            $this->outros = $outros;
        }
        
        public function getId(): int {
            return $this->id;
        }
        
        public function getIdRelatorio(): int {
            return $this->idRelatorio;
        }
        
        public function setRelatorio(Relatorio $relatorio): void {
            $this->idRelatorio = $relatorio->getId();
        }
        
        public function getDesmoronamento(): bool {
            return $this->desmoronamento;
        }
        
        public function setDesmoronamento(bool $desmoronamento): void {
            $this->desmoronamento = $desmoronamento;
        }
        
        public function getDeslizamento(): bool {
            return $this->deslizamento;
        }
        
        public function setDeslizamento(bool $deslizamento): void {
            $this->deslizamento = $deslizamento;
        }
        
        public function getEsgotoEscoamento(): bool {
            return $this->esgotoEscoamento;
        }
        
        public function setEsgotoEscoamento(bool $esgotoEscoamento): void {
            $this->esgotoEscoamento = $esgotoEscoamento;
        }
        
        public function getErosao(): bool {
            return $this->erosao;
        }
        
        public function setErosao(bool $erosao): void {
            $this->erosao = $erosao;
        }
        
        public function getInundacao(): bool {
            return $this->inundacao;
        }
        
        public function setInundacao(bool $inundacao): void {
            $this->inundacao = $inundacao;
        }
        
        public function getIncendio(): bool {
            return $this->incendio;
        }
        
        public function setIncendio(bool $incendio): void {
            $this->incendio = $incendio;
        }
        
        public function getArvores(): bool {
            return $this->arvores;
        }
        
        public function setArvores(bool $arvores): void {
            $this->arvores = $arvores;
        }
        
        public function getInfiltracaoTrinca(): bool {
            return $this->infiltracaoTrinca;
        }
        
        public function setInfiltracaoTrinca(bool $infiltracaoTrinca): void {
            $this->infiltracaoTrinca = $infiltracaoTrinca;
        }
        
        public function getJudicial(): bool {
            return $this->judicial;
        }
        
        public function setJudicial(bool $judicial): void {
            $this->judicial = $judicial;
        }
        
        public function getMonitoramento(): bool {
            return $this->monitoramento;
        }
        
        public function setMonitoramento(bool $monitoramento): void {
            $this->monitoramento = $monitoramento;
        }
        
        public function getTransito(): bool {
            return $this->transito;
        }
        
        public function setTransito(bool $transito): void {
            $this->transito = $transito;
        }
        
        public function getOutros(): ?string {
            return $this->outros;
        }
        
        public function setOutros(?string $outros): void {
            $this->outros = $outros;
        }
    }
?>