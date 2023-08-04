<?php
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