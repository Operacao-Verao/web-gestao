<?php
    enum REG_ACAO {
        const ERRO = 1;
        const ALT_SECRETARIO = 2;
        const ALT_TECNICO = 3;
        const ALT_CASA = 4;
        const TRANCA_OCORRENCIA = 5;
        const CAD_CIVIL = 6;
        const CAD_OCORRENCIA = 7;
        const CAD_SECRETARIO = 8;
        const CAD_TECNICO = 9;
        const GEN_MEMO = 10;
    }
    
    class Registro {
        private int $id;
        private int $idFuncionario;
        private int $acao;
        private string $descricao;
        private string $momento;
        
        public function __construct(int $id, int $idFuncionario, int $acao, string $descricao, string $momento) {
            $this->id = $id;
            $this->idFuncionario = $idFuncionario;
            $this->acao = $acao;
            $this->descricao = $descricao;
            $this->momento = $momento;
        }
        
        public function getId(): int {
            return $this->id;
        }
        
        public function getIdFuncionario(): int {
            return $this->idFuncionario;
        }
        
        public function getAcao(): int {
            return $this->acao;
        }
        
        public function getDescricao(): string {
            return $this->descricao;
        }
        
        public function getMomento(): string {
            return $this->momento;
        }
    }
?>