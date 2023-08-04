<?php
class Animal {
    private int $id;
    private int $idRelatorio;
    private int $caes;
    private int $gatos;
    private int $aves;
    private int $equinos;

    public function __construct(int $id, int $idRelatorio, int $caes, int $gatos, int $aves, int $equinos) {
        $this->id = $id;
        $this->idRelatorio = $idRelatorio;
        $this->caes = $caes;
        $this->gatos = $gatos;
        $this->aves = $aves;
        $this->equinos = $equinos;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getIdRelatorio(): int {
        return $this->idRelatorio;
    }

    public function setRelatorio(ModelRelatorio $model_relatorio): void {
        $this->idRelatorio = $model_relatorio->getId();
    }

    public function getCaes(): int {
        return $this->caes;
    }

    public function setCaes(int $caes): void {
        $this->caes = $caes;
    }

    public function getGatos(): int {
        return $this->gatos;
    }

    public function setGatos(int $gatos): void {
        $this->gatos = $gatos;
    }

    public function getAves(): int {
        return $this->aves;
    }

    public function setAves(int $aves): void {
        $this->aves = $aves;
    }

    public function getEquinos(): int {
        return $this->equinos;
    }

    public function setEquinos(int $equinos): void {
        $this->equinos = $equinos;
    }
}
