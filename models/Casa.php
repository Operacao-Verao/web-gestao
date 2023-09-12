<?php
    
    enum INTERDICAO {
        const NAO = 0;
        const PARCIAL = 1;
        const TOTAL = 2;
    };
    
    class Casa {
        private int $id;
        private int $id_local;
        private int $interdicao;
        private string $complemento;
        
        public function __construct(int $id, int $id_local, int $interdicao, string $complemento) {
            $this->id = $id;
            $this->id_local = $id_local;
            $this->interdicao = $interdicao;
            $this->complemento = $complemento;
        }
        
        public function getId(): int {
            return $this->id;
        }
        
        public function getIdLocal(): int {
            return $this->id_local;
        }
        
        public function setLocal(Local $local): void {
            $this->id_local = $local->getId();
        }
        
        public function getInterdicao(): int {
            return $this->interdicao;
        }
        
        public function setInterdicao(int $interdicao): void {
            $this->interdicao = $interdicao;
        }
        
        public function getComplemento(): string {
            return $this->complemento;
        }
        
        public function setComplemento(string $complemento): void {
            $this->complemento = $complemento;
        }
    }
?>