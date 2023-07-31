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

    public function getConteudo() {
        return $this->conteudo;
    }
}

?>