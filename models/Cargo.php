<?php
class Cargo {
    private int $id;
    private string $nomeCargo;
    
    public function __construct(int $id, string $nomeCargo) {
        $this->id = $id;
        $this->nomeCargo = $nomeCargo;
    }
    
    public function getId(): int {
        return $this->id;
    }
    
    public function getNomeCargo(): string {
        return $this->nomeCargo;
    }
    
    public function setNomeCargo(string $nomeCargo): void {
        $this->nomeCargo = $nomeCargo;
    }
}
