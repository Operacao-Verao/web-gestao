<?php
    class Comunicado {
        private int $id;
        private int $idGestor;
        private string $conteudo;

        public function __construct(int $id, int $idGestor, string $conteudo) {
            $this->id = $id;
            $this->idGestor = $idGestor;
            $this->conteudo = $conteudo;
        }

        public function getId(): int {
            return $this->id;
        }

        public function getIdGestor(): int {
            return $this->idGestor;
        }
        
        public function setGestor(Gestor $gestor): void {
            $this->idGestor = $gestor->getId();
        }

        public function getConteudo(): string {
            return $this->conteudo;
        }
        
        public function setConteudo(string $conteudo): void {
            $this->conteudo = $conteudo;
        }
    }
?>