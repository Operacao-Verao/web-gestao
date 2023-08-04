<?php

class AlertaChuva {
    private int $id;
    private int $idPluviometro;
    private string $statusChuva;
    private string $dataChuva;

    public function __construct(int $id, int $idPluviometro, string $statusChuva, string $dataChuva) {
        $this->id = $id;
        $this->idPluviometro = $idPluviometro;
        $this->statusChuva = $statusChuva;
        $this->dataChuva = $dataChuva;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getIdPluviometro(): int {
        return $this->idPluviometro;
    }

    public function setPluviometro(Pluviometro $pluviometro): void {
        $this->idPluviometro = $pluviometro->getId();
    }

    public function getStatusChuva(): string {
        return $this->statusChuva;
    }

    public function setStatusChuva(string $statusChuva): void {
        $this->statusChuva = $statusChuva;
    }

    public function getDataChuva(): string {
        return $this->dataChuva;
    }

    public function setDataChuva(string $dataChuva): void {
        $this->dataChuva = $dataChuva;
    }
}
