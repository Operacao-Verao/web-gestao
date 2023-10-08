<?php
    enum INTERDICAO {
        const NAO = 0;
        const PARCIAL = 1;
        const TOTAL = 2;
    };
    
    class Casa {
        private int $id;
        private int $idResidencial;
        private int $interdicao;
        private string $complemento;
        
        public function __construct(int $id, int $idResidencial, int $interdicao, string $complemento) {
            $this->id = $id;
            $this->idResidencial = $idResidencial;
            $this->interdicao = $interdicao;
            $this->complemento = $complemento;
        }
        
        public function getId(): int {
            return $this->id;
        }
        
        public function getIdResidencial(): int {
            return $this->idResidencial;
        }
        
        public function setResidencial(Residencial $residencial): void {
            $this->idResidencial = $residencial->getId();
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