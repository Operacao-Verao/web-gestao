<?php
    class AlertaRio {
        private int $id;
        private int $idFluviometro;
        private string $statusRio;
        private string $dataAlertaRio;

        public function __construct(int $id, int $idFluviometro, string $statusRio, string $dataAlertaRio) {
            $this->id = $id;
            $this->idFluviometro = $idFluviometro;
            $this->statusRio = $statusRio;
            $this->dataAlertaRio = $dataAlertaRio;
        }

        public function getId(): int {
            return $this->id;
        }

        public function getIdFluviometro(): int {
            return $this->idFluviometro;
        }

        public function setFluviometro(Fluviometro $fluviometro): void {
            $this->idFluviometro = $fluviometro->getId();
        }

        public function getStatusRio(): string {
            return $this->statusRio;
        }

        public function setStatusRio(string $statusRio): void {
            $this->statusRio = $statusRio;
        }

        public function getDataAlertaRio(): string {
            return $this->dataAlertaRio;
        }

        public function setDataAlertaRio(string $dataAlertaRio): void {
            $this->dataAlertaRio = $dataAlertaRio;
        }
    }
?>