<?php
    class Ocorrencia {
        private int $id;
        private ?int $idAtendente;
        private ?int $idTecnico;
        private int $idCivil;
        private int $idResidencial;
        private string $acionamento;
        private string $relatoCivil;
        private int $numCasas;
        private bool $aprovado;
        private bool $encerrado;
        private string $dataOcorrencia;
        
        public function __construct(int $id, ?int $idAtendente, ?int $idTecnico, int $idCivil, int $idResidencial, string $acionamento, string $relatoCivil, int $numCasas, bool $aprovado, bool $encerrado, string $dataOcorrencia) {
            $this->id = $id;
            $this->idAtendente = $idAtendente;
            $this->idTecnico = $idTecnico;
            $this->idCivil = $idCivil;
            $this->idResidencial = $idResidencial;
            $this->acionamento = $acionamento;
            $this->relatoCivil = $relatoCivil;
            $this->numCasas = $numCasas;
            $this->aprovado = $aprovado;
            $this->encerrado = $encerrado;
            $this->dataOcorrencia = $dataOcorrencia;
        }
        
        public function getId(): int {
            return $this->id;
        }
        
        public function getIdAtendente(): int|null {
            return $this->idAtendente;
        }
        
        public function setAtendente(?Funcionario $atendente): void {
            $this->idAtendente = $atendente? $atendente->getId(): null;
        }
        
        public function setIdAtendente(?int $id): void {
            $this->idAtendente = $id;
        }
        
        public function getIdTecnico(): int|null {
            return $this->idTecnico;
        }
        
        public function setTecnico(?Tecnico $tecnico): void {
            $this->idTecnico = $tecnico? $tecnico->getId(): null;
        }
        
        public function setIdTecnico(?int $id): void {
            $this->idTecnico = $id;
        }
        
        public function getIdCivil(): ?int {
            return $this->idCivil;
        }
        
        public function setCivil(Civil $civil): void {
            $this->idCivil = $civil->getId();
        }
        
        public function getIdResidencial(): int {
            return $this->idResidencial;
        }
        
        public function setResidencial(Residencial $residencial): void {
            $this->idResidencial = $residencial->getId();
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
        
        public function getEncerrado(): bool {
            return $this->encerrado;
        }
        
        public function setEncerrado(bool $encerrado): void {
            $this->encerrado = $encerrado;
        }
        
        public function getDataOcorrencia(): string {
            return $this->dataOcorrencia;
        }
        
        public function setDataOcorrencia(string $dataOcorrencia): void {
            $this->dataOcorrencia = $dataOcorrencia;
        }
    }
?>