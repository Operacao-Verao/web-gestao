<?php 
    class Comunicado {
    private $id;
    private $idGestor;
    private $conteudo;

    public function __construct($id, $idGestor, $conteudo) {
        $this->id = $id;
        $this->idGestor = $idGestor;
        $this->conteudo = $conteudo;
    }

    public function getId() {
        return $this->id;
    }

    public function getIdGestor() {
        return $this->idGestor;
    }
    
    public function setGestor($gestor) {
        $this->idGestor = $gestor->getId();
    }

    public function getConteudo() {
        return $this->conteudo;
    }
    
    public function setCounteudo($conteudo) {
        $this->conteudo = $conteudo;
    }
}

?>