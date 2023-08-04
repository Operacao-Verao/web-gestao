<?php
class Ocorrencia {
    private int $id;
    private int $idTecnico;
    private int $idCivil;
    private bool $acionamento;
    private string $relatoCivil;
    private int $numCasas;
    private bool $aprovado;
    private string $dataOcorrencia;
    
    public function __construct(int $id, int $idTecnico, int $idCivil, bool $acionamento, string $relatoCivil, int $numCasas, bool $aprovado, string $dataOcorrencia) {
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
    
    public function getIdTecnico(): int {
        return $this->idTecnico;
    }
    
    public function setTecnico(Tecnico $tecnico): void {
        $this->idTecnico = $tecnico->getId();
    }
    
    public function getIdCivil(): int {
        return $this->idCivil;
    }
    
    public function setCivil(Civil $civil): void {
        $this->idCivil = $civil->getId();
    }
    
    public function getAcionamento(): bool {
        return $this->acionamento;
    }
    
    public function setAcionamento(bool $acionamento): void {
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
