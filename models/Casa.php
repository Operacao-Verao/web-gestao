<?php
    class Casa {
        private int $id;
        private string $cep;
        private string $numero;
        private string $complemento;
        
        public function __construct(int $id, string $cep, string $numero, string $complemento) {
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
        
        public function getNumero(): string {
            return $this->numero;
        }
        
        public function setNumero(string $numero): void {
            $this->numero = $numero;
        }
        
        public function getComplemento(): string {
            return $this->complemento;
        }
        
        public function setComplemento(string $complemento): void {
            $this->complemento = $complemento;
        }
    }
?>