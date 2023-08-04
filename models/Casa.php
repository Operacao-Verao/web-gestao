<?php
class Casa {
    private int $id;
    private string $cep;
    private int $numero;
    private string $complemento;
    
    public function __construct(int $id, string $cep, int $numero, string $complemento) {
        $this->id = $id;
        $this->cep = $cep;
        $this->numero = $numero;
        $this->complemento = $complemento;
    }
    
    public function getId(): int {
        return $this->id;
    }
    
    public function getCep(): string {
        return $this->cep;
    }
    
    public function setCep(string $cep): void {
        $this->cep = $cep;
    }
    
    public function getNumero(): int {
        return $this->numero;
    }
    
    public function setNumero(int $numero): void {
        $this->numero = $numero;
    }
    
    public function getComplemento(): string {
        return $this->complemento;
    }
    
    public function setComplemento(string $complemento): void {
        $this->complemento = $complemento;
    }
}
