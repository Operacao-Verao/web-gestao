<?php
class Pluviometro {    
    private int $id;
    private string $cep;
    private float $latitude;
    private float $longitude;
    
    public function __construct(int $id, string $cep, float $latitude, float $longitude) {
        $this->id = $id;
        $this->cep = $cep;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
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
    
    public function getLatitude(): float {
        return $this->latitude;
    }
    
    public function setLatitude(float $latitude): void {
        $this->latitude = $latitude;
    }
    
    public function getLongitude(): float {
        return $this->longitude;
    }
    
    public function setLongitude(float $longitude): void {
        $this->longitude = $longitude;
    }
}
