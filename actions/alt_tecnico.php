<?php 
    session_start();
    
    include_once("../actions/conn.php");
    include_once("../models/Funcionario.php");
    include_once("../daos/DAOFuncionario.php");
    include_once("../models/Tecnico.php");
    include_once("../daos/DAOTecnico.php");
      

    class TecnicoUpdateAction {
        private $pdo;
        private $daoFuncionario;
        private $daoTecnico;
    
        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
            $this->daoFuncionario = new DAOFuncionario($this->pdo);
            $this->daoTecnico = new DAOTecnico($this->pdo);
        }
    
        public function execute() {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $tecnicoId = $_POST["tecnico_id"];
                $nome = $_POST["edtnome"];
                $email = $_POST["edtemail"];
                $senha = $_POST["edtsenha"];
                $senhaconfirm = $_POST["edtsenhaconfirm"];
    
                if ($senha != $senhaconfirm){
                    header("Location: ../views/edit_tecnico.php?id=$tecnicoId&error=senhaincorreta");
                    exit();
                }
    
                if (empty($email) || empty($senha)) {
                    header("Location: ../views/edit_tecnico.php?id=$tecnicoId&error=camposobrigatorios");
                    exit();
                }
    
                // Atualizar o técnico
                $tecnico = $this->daoTecnico->findById($tecnicoId);
                if ($tecnico) {
                    $funcionario = $this->daoFuncionario->findById($tecnico->getIdFuncionario());
                    if ($funcionario) {
                        // Atualizar os dados do funcionário
                        $funcionario->setNome($nome);
                        $funcionario->setEmail($email);
                        $funcionario->setSenha($senha);
    
                        // Atualizar o técnico
                        $tecnico->setIdFuncionario($funcionario->getId());
    
                        if ($this->daoFuncionario->update($funcionario) && $this->daoTecnico->update($tecnico)) {
                            header("Location: ../views/tecnicos/tecnicos.php");
                            exit();
                        } else {
                            header("Location: ../views/edit_tecnico.php?id=$tecnicoId&error=atualizacaofalhou");
                            exit();
                        }
                    }
                } else {
                    header("Location: ../views/edit_tecnico.php?id=$tecnicoId&error=naoencontrado");
                    exit();
                }
            }
        }
    }
    
    $tecnicoUpdateAction = new TecnicoUpdateAction($pdo);
    $tecnicoUpdateAction->execute();
    
?> 