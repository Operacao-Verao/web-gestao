<?php
    class Memo {
        private int $id;
        private int $idRelatorio;
        private int $idSecretaria;
        private string $dataMemo;
        private string $statusMemo;
        private string $processo;
        
        public function __construct(int $id, int $idRelatorio, int $idSecretaria, string $dataMemo, string $statusMemo, string $processo) {
            $this->id = $id;
            $this->idRelatorio = $idRelatorio;
            $this->idSecretaria = $idSecretaria;
            $this->dataMemo = $dataMemo;
            $this->statusMemo = $statusMemo;
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
        
        public function getProcesso(): string {
            return $this->processo;
        }
        
        public function setProcesso(string $processo): void {
            $this->processo = $processo;
        }
    }
?>