<?php
class Afetados {
    private int $id;
    private int $idRelatorio;
    private int $adultos;
    private int $criancas;
    private int $idosos;
    private int $especiais;
    private int $mortos;
    private int $feridos;
    private int $enfermos;

    public function __construct(
        int $id, int $idRelatorio, int $adultos, int $criancas, int $idosos,
        int $especiais, int $mortos, int $feridos, int $enfermos
    ) {
        $this->id = $id;
        $this->idRelatorio = $idRelatorio;
        $this->adultos = $adultos;
        $this->criancas = $criancas;
        $this->idosos = $idosos;
        $this->especiais = $especiais;
        $this->mortos = $mortos;
        $this->feridos = $feridos;
        $this->enfermos = $enfermos;
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

    public function getAdultos(): int {
        return $this->adultos;
    }

    public function setAdultos(int $adultos): void {
        $this->adultos = $adultos;
    }

    public function getCriancas(): int {
        return $this->criancas;
    }

    public function setCriancas(int $criancas): void {
        $this->criancas = $criancas;
    }

    public function getIdosos(): int {
        return $this->idosos;
    }

    public function setIdosos(int $idosos): void {
        $this->idosos = $idosos;
    }

    public function getEspeciais(): int {
        return $this->especiais;
    }

    public function setEspeciais(int $especiais): void {
        $this->especiais = $especiais;
    }

    public function getMortos(): int {
        return $this->mortos;
    }

    public function setMortos(int $mortos): void {
        $this->mortos = $mortos;
    }

    public function getFeridos(): int {
        return $this->feridos;
    }

    public function setFeridos(int $feridos): void {
        $this->feridos = $feridos;
    }

    public function getEnfermos(): int {
        return $this->enfermos;
    }

    public function setEnfermos(int $enfermos): void {
        $this->enfermos = $enfermos;
    }
}
