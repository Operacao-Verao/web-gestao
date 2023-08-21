<?php
    session_start();
    
    include_once("../actions/conn.php");
    include_once("../models/Funcionario.php");
    include_once("../daos/DAOFuncionario.php");
    
    class LoginAction {
        private $pdo;
        private $daoFuncionario;

        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
            $this->daoFuncionario = new DAOFuncionario($this->pdo);
        }

        public function execute() {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST["edtemail"];
                $senha = $_POST["edtsenha"];

                if (empty($email) || empty($senha)) {
                    header("Location: login.php?error=Campos não preenchidos");
                    exit();
                }

                $funcionario = $this->daoFuncionario->findWithLogin($email, $senha);

                if ($funcionario) {
                    $_SESSION["usuario_id"] = $funcionario->getId();
                    $_SESSION["usuario_nome"] = $funcionario->getNome();
                    $_SESSION["usuario_tipo"] = $funcionario->getTipoUsuario();

                    header("Location: ../views/home/home.php");
                    exit();
                } else {
                    header("Location: ../views/login/login.php?error=Login incorreto");
                    exit();
                }
            }
        }
    }
    
    $loginAction = new LoginAction($pdo);
    $loginAction->execute();
?>
