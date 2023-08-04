<?php
    class NivelChuva {
        private int $id;
        private int $idPluviometro;
        private float $chuvaEmMm;
        private string $dataChuva;
        
        public function __construct(int $id, int $idPluviometro, float $chuvaEmMm, string $dataChuva) {
            $this->id = $id;
            $this->idPluviometro = $idPluviometro;
            $this->chuvaEmMm = $chuvaEmMm;
            $this->dataChuva = $dataChuva;
        }
        
        public function getId(): int {
            return $this->id;
        }
        
        public function getIdPluviometro(): int {
            return $this->idPluviometro;
        }
        
        public function setPluviometro(Pluviometro $pluviometro): void {
            $this->idPluviometro = $pluviometro->getId();
        }
        
        public function getChuvaEmMm(): float {
            return $this->chuvaEmMm;
        }
        
        public function setChuvaEmMm(float $chuvaEmMm): void {
            $this->chuvaEmMm = $chuvaEmMm;
        }
        
        public function getDataChuva(): string {
            return $this->dataChuva;
        }
        
        public function setDataChuva(string $dataChuva): void {
            $this->dataChuva = $dataChuva;
        }
    }
?>