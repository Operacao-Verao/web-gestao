<?php
    class LocalAjuda {
        private int $id;
        private string $cep;
        private string $tipo;
        private string $conteudo;
        
        public function __construct(int $id, string $cep, string $tipo, string $conteudo) {
            $this->id = $id;
            $this->cep = $cep;
            $this->tipo = $tipo;
            $this->conteudo = $conteudo;
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
        
        public function getTipo(): string {
            return $this->tipo;
        }
        
        public function setTipo(string $tipo): void {
            $this->tipo = $tipo;
        }
        
        public function getConteudo(): string {
            return $this->conteudo;
        }
        
        public function setConteudo(string $conteudo): void {
            $this->conteudo = $conteudo;
        }
    }
?>