<?php
    class Fluviometro {
        private int $id;
        private string $cep;
        private string $authKey;
        private string $authToken;
        private float $latitude;
        private float $longitude;
        
        public function __construct(int $id, string $cep, string $authKey, string $authToken, float $latitude, float $longitude) {
            $this->id = $id;
            $this->cep = $cep;
            $this->authKey = $authKey;
            $this->authToken = $authToken;
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
        
        public function getAuthKey(): string {
            return $this->authKey;
        }
        
        public function setAuthKey(string $authKey): void {
            $this->authKey = $authKey;
        }
        
        public function getAuthToken(): string {
            return $this->authToken;
        }
        
        public function setAuthToken(string $authToken): void {
            $this->authToken = $authToken;
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
?>