<?php
class Secretaria{
    private int $id;
    private string $nomeSecretaria;
    
    public function __construct(int $id, string $nomeSecretaria) {
        $this->id = $id;
        $this->nomeSecretaria = $nomeSecretaria;
    }
    
    public function getId(): int {
        return $this->id;
    }
    
    public function getNomeSecretaria(): string {
        return $this->nomeSecretaria;
    }
    
    public function setNomeSecretaria(string $nomeSecretaria): void {
        $this->nomeSecretaria = $nomeSecretaria;
    }
}
