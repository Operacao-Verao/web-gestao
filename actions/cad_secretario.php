<?php
    class SecretarioCadastroAction {
        private $pdo;
        private $daoSecretario;

        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
            $this->daoSecretario = new DAOSecretario($this->pdo);
        }

        public function execute() {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $idCargo = $_POST["inputIdCargo"];
                $nome_secretario = $_POST["inputnomeSecretario"];
                $id_secretaria = $_POST["inputIdSecretaria"];
            
                $novoSecretario = $this->daoSecretario->insert(null, $id_cargo, $nome_secretario, $id_secretaria);

                if ($novoSecretario) {
                    header("Location: ../views/secretario/secretario.php");
                    exit();
                } else {
                    header("Location: ../views/secretario/cad_secretario/cad_secretario.php?error=cadastrofalhou");
                    exit();
                }

                include_once("../actions/conn.php");
                include_once("../models/secretario.php"); 
                include_once("../daos/DAOSecretario.php");
                include_once("../models/secretaria.php");
                include_once("../daos/DAOSecretaria.php"); 