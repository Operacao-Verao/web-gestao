<?php
    class Memo {
        private int $id;
        private int $idRelatorio;
        private int $idSecretaria;
        private string $dataMemo;
        private string $statusMemo;
        private string $setor;
        private string $memorando;
        private string $oficio;
        private string $processo;
        
        public function __construct(int $id, int $idRelatorio, int $idSecretaria, string $dataMemo, string $statusMemo, string $setor, string $memorando, string $oficio, string $processo) {
            $this->id = $id;
            $this->idRelatorio = $idRelatorio;
            $this->idSecretaria = $idSecretaria;
            $this->dataMemo = $dataMemo;
            $this->statusMemo = $statusMemo;
            $this->setor = $setor;
            $this->memorando = $memorando;
            $this->oficio = $oficio;
            $this->processo = $processo;
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
        
        public function getIdSecretaria(): int {
            return $this->idSecretaria;
        }
        
        public function setSecretaria(Secretaria $secretaria): void {
            $this->idSecretaria = $secretaria->getId();
        }
        
        public function getDataMemo(): string {
            return $this->dataMemo;
        }
        
        public function setDataMemo(string $dataMemo): void {
            $this->dataMemo = $dataMemo;
        }
        
        public function getStatusMemo(): string {
            return $this->statusMemo;
        }
        
        public function setStatusMemo(string $statusMemo): void {
            $this->statusMemo = $statusMemo;
        }
        
        public function getSetor(): string {
            return $this->setor;
        }
        
        public function setSetor(string $setor): void {
            $this->setor = $setor;
        }
        
        public function getMemorando(): string {
            return $this->memorando;
        }
        
        public function setMemorando(string $memorando): void {
            $this->memorando = $memorando;
        }
        
        public function getOficio(): string {
            return $this->oficio;
        }
        
        public function setOficio(string $oficio): void {
            $this->oficio = $oficio;
        }
        
        public function getProcesso(): string {
            return $this->processo;
        }
        
        public function setProcesso(string $processo): void {
            $this->processo = $processo;
        }
    }
?>