<?php
    enum REG_ACAO {
        const ERRO = 1;
        const ALT_SECRETARIA = 2;
        const ALT_SECRETARIO = 3;
        const ALT_TECNICO = 4;
        const ALT_CASA = 5;
        const TRANCA_OCORRENCIA = 6;
        const CAD_CIVIL = 7;
        const CAD_OCORRENCIA = 8;
        const CAD_SECRETARIA = 9;
        const CAD_SECRETARIO = 10;
        const CAD_TECNICO = 11;
        const GERACAO_MEMO = 12;
        const GEN_MEMO = 13;
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