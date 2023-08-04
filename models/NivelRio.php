<?php
    class NivelRio {
        private int $id;
        private int $idFluviometro;
        private float $nivelRio;
        private string $dataDiario;
        
        public function __construct(int $id, int $idFluviometro, float $nivelRio, string $dataDiario) {
            $this->id = $id;
            $this->idFluviometro = $idFluviometro;
            $this->nivelRio = $nivelRio;
            $this->dataDiario = $dataDiario;
        }
        
        public function getId(): int {
            return $this->id;
        }
        
        public function getIdFluviometro(): int {
            return $this->idFluviometro;
        }
        
        public function setFluviometro(Fluviometro $fluviometro): void {
            $this->idFluviometro = $fluviometro->getId();
        }
        
        public function getNivelRio(): float {
            return $this->nivelRio;
        }
        
        public function setNivelRio(float $nivelRio): void {
            $this->nivelRio = $nivelRio;
        }
        
        public function getDataDiario(): string {
            return $this->dataDiario;
        }
        
        public function setDataDiario(string $dataDiario): void {
            $this->dataDiario = $dataDiario;
        }
    }
?>