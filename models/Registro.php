<?php
class Registro {
    private int $id;
    private int $idFuncionario;
    private string $acao;
    private string $descricao;
    private string $momento;
    
    public function __construct(int $id, int $idFuncionario, string $acao, string $descricao, string $momento) {
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
    
    public function getAcao(): string {
        return $this->acao;
    }
    
    public function getDescricao(): string {
        return $this->descricao;
    }
    
    public function getMomento(): string {
        return $this->momento;
    }
}
