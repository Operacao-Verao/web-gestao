<?php
    session_start();
    
    include_once("../actions/conn.php");
    include_once("../models/Funcionario.php");
    include_once("../daos/DAOFuncionario.php");
    include_once("../models/Gestor.php");
    include_once("../daos/DAOGestor.php");
    
    class LoginAction {
        private $pdo;
        private $daoFuncionario;
        private $daoGestor;

        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
            $this->daoFuncionario = new DAOFuncionario($this->pdo);
            $this->daoGestor = new DAOGestor($this->pdo);
        }

        public function execute() {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST["edtemail"];
                $senha = $_POST["edtsenha"];

                if (empty($email) || empty($senha)) {
                    header("Location: login.php?error=Campos não preenchidos");
                    exit();
                }

                $acesso_permitido = true;

                $funcionario = $this->daoFuncionario->findWithLogin($email, $senha);
                $acesso_permitido = $funcionario != null;
                /*
                $gestor = null;
                
                if ($funcionario == null){
                    $acesso_permitido = false;
                }
                else {
                    $gestor = $this->daoGestor->findByFuncionario($funcionario);
                    if ($gestor == null){
                        $acesso_permitido = false;
                    }
                }
                */
                if ($acesso_permitido) {
                    $_SESSION["usuario_id"] = $funcionario->getId();
                    $_SESSION["usuario_nome"] = $funcionario->getNome();
                    $_SESSION["usuario_tipo"] = $funcionario->getTipoUsuario();

                    header("Location: ../views/home/home.php");
                    exit();
                } else {
                    $_SESSION['erro'] = "E-mail e/ou senha incorretos";
                    header("Location: ../views/login/login.php");
                    exit();
                }
            }
        }
    }
    
    $loginAction = new LoginAction($pdo);
    $loginAction->execute();
?>
