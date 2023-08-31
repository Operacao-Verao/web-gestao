<?php
    class Ocorrencia {
        private int $id;
        private int|null $idTecnico;
        private int $idCivil;
        private string $acionamento;
        private string $relatoCivil;
        private int $numCasas;
        private bool $aprovado;
        private string $dataOcorrencia;
        
        public function __construct(int $id, int|null $idTecnico, int $idCivil, string $acionamento, string $relatoCivil, int $numCasas, bool $aprovado, string $dataOcorrencia) {
            $this->id = $id;
            $this->idTecnico = $idTecnico;
            $this->idCivil = $idCivil;
            $this->acionamento = $acionamento;
            $this->relatoCivil = $relatoCivil;
            $this->numCasas = $numCasas;
            $this->aprovado = $aprovado;
            $this->dataOcorrencia = $dataOcorrencia;
        }
        
        public function getId(): int {
            return $this->id;
        }
        
        public function getIdTecnico(): int|null {
            return $this->idTecnico;
        }
        
        public function setTecnico(Tecnico|null $tecnico): void {
            $this->idTecnico = $tecnico? $tecnico->getId(): null;
        }
        
        public function setIdTecnico(int|null $id): void {
            $this->idTecnico = $id;
        }
        
        public function getIdCivil(): int {
            return $this->idCivil;
        }
        
        public function setCivil(Civil $civil): void {
            $this->idCivil = $civil->getId();
        }
        
        public function getAcionamento(): string {
            return $this->acionamento;
        }
        
        public function setAcionamento(string $acionamento): void {
            $this->acionamento = $acionamento;
        }
        
        public function getRelatoCivil(): string {
            return $this->relatoCivil;
        }
        
        public function setRelatoCivil(string $relatoCivil): void {
            $this->relatoCivil = $relatoCivil;
        }
        
        public function getNumCasas(): int {
            return $this->numCasas;
        }
        
        public function setNumCasas(int $numCasas): void {
            $this->numCasas = $numCasas;
        }
        
        public function getAprovado(): bool {
            return $this->aprovado;
        }
        
        public function setAprovado(bool $aprovado): void {
            $this->aprovado = $aprovado;
        }
        
        public function getDataOcorrencia(): string {
            return $this->dataOcorrencia;
        }
        
        public function setDataOcorrencia(string $dataOcorrencia): void {
            $this->dataOcorrencia = $dataOcorrencia;
        }
    }
?>