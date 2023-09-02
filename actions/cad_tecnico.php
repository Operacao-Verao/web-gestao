<?php
    session_start();
    
    include_once("../actions/conn.php");
    include_once("../models/Funcionario.php");
    include_once("../daos/DAOFuncionario.php");
    include_once("../models/Tecnico.php");
    include_once("../daos/DAOTecnico.php");
    
    class TecnicoCadastroAction {
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
                $nome = $_POST["edtnome"];
                $email = $_POST["edtemail"];
                $senha = $_POST["edtsenha"];
                $senhaconfirm = $_POST["edtsenhaconfirm"];
                
                $options = [
                    'cost' => 12
                ];

                $senha_criptografada = password_hash($senha, PASSWORD_BCRYPT, $options);

                if (empty($nome) || empty($email) || empty($senha) || empty($senha) || empty($senhaconfirm)) {
                    header("Location: ../views/cad_tecnico/cad_tecnico.php");
                    exit();
                }

                if ($senha != $senhaconfirm){
                    header("Location: ../views/cad_tecnico/cad_tecnico.php");
                    exit();
                }
                
                $funcionario = $this->daoFuncionario->findWithLogin($email, $senha);

                if ($funcionario == null){
                    $funcionario = $this->daoFuncionario->insert($nome, $email, $senha_criptografada, TIPO_USUARIO::FUNCIONARIO);
                }
                
                $tecnico = $this->daoTecnico->insert($funcionario, true);
                
                header("Location: ../views/tecnicos/tecnicos.php");
            }
        }
    }
    
    $tecnicoCadastroAction = new TecnicoCadastroAction($pdo);
    $tecnicoCadastroAction->execute();
?>
