<?php 
    class TecnicoSuspenderAction {

        include_once("../actions/conn.php");
        include_once("../models/Funcionario.php");
        include_once("../daos/DAOFuncionario.php");
        include_once("../models/Tecnico.php");
        include_once("../daos/DAOTecnico.php");

        private $pdo;
        private $daoTecnico;
    
        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
            $this->daoTecnico = new DAOTecnico($this->pdo);
        }
    
        public function execute() {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $tecnicoId = $_POST["tecnico_id"];
    
                // Suspender o técnico
                $tecnico = $this->daoTecnico->findById($tecnicoId);
                if ($tecnico) {
                    $tecnico->setAtivo(false); // Definir o status como suspenso
    
                    if ($this->daoTecnico->update($tecnico)) {
                        header("Location: ../views/tecnicos/tecnicos.php");
                        exit();
                    } else {
                        header("Location: ../views/edit_tecnico.php?id=$tecnicoId&error=suspensaofalhou");
                        exit();
                    }
                } else {
                    header("Location: ../views/edit_tecnico.php?id=$tecnicoId&error=naoencontrado");
                    exit();
                }
            }
        }
    }
    
    $tecnicoSuspenderAction = new TecnicoSuspenderAction($pdo);
    $tecnicoSuspenderAction->execute();    
?>