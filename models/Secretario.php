<?php
class Secretario {
    private int $id;
    private int $idSecretaria;
    private int $idCargo;
    private string $nomeSecretario;
    
    public function __construct(int $id, int $idSecretaria, int $idCargo, string $nomeSecretario) {
        $this->id = $id;
        $this->idSecretaria = $idSecretaria;
        $this->idCargo = $idCargo;
        $this->nomeSecretario = $nomeSecretario;
    }
    
    public function getId(): int {
        return $this->id;
    }
    
    public function getIdSecretaria(): int {
        return $this->idSecretaria;
    }
    
    public function setSecretaria(Secretaria $secretaria): void {
        $this->idSecretaria = $secretaria->getId();
    }
    
    public function getIdCargo(): int {
        return $this->idCargo;
    }
    
    public function setCargo(Cargo $cargo): void {
        $this->idCargo = $cargo->getId();
    }
    
    public function getNomeSecretario(): string {
        return $this->nomeSecretario;
    }
    
    public function setNomeSecretario(string $nomeSecretario): void {
        $this->nomeSecretario = $nomeSecretario;
    }
}
?>
