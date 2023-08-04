<?php
    class Endereco {
        private string $cep;
        private string $rua;
        private string $bairro;
        private string $cidade;
        
        public function __construct(string $cep, string $rua, string $bairro, string $cidade) {
            $this->cep = $cep;
            $this->rua = $rua;
            $this->bairro = $bairro;
            $this->cidade = $cidade;
        }
        
        public function getCep(): string {
            return $this->cep;
        }
        
        public function getRua(): string {
            return $this->rua;
        }
        
        public function setRua(string $rua): void {
            $this->rua = $rua;
        }
        
        public function getBairro(): string {
            return $this->bairro;
        }
        
        public function setBairro(string $bairro): void {
            $this->bairro = $bairro;
        }
        
        public function getCidade(): string {
            return $this->cidade;
        }
        
        public function setCidade(string $cidade): void {
            $this->cidade = $cidade;
        }
    }
?>