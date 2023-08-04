<?php
    class Foto {
        private int $id;
        private int $idRelatorio;
        private string $codificado;
        
        public function __construct(int $id, int $idRelatorio, string $codificado) {
            $this->id = $id;
            $this->idRelatorio = $idRelatorio;
            $this->codificado = $codificado;
        }
        
        public function getId(): int {
            return $this->id;
        }
        
        public function getIdRelatorio(): int {
            return $this->idRelatorio;
        }
        
        public function setRelatorio(Relatorio $model_relatorio): void {
            $this->idRelatorio = $model_relatorio->getId();
        }
        
        public function getCodificado(): string {
            return $this->codificado;
        }
        
        public function setCodificado(string $codificado): void {
            $this->codificado = $codificado;
        }
    }
?>