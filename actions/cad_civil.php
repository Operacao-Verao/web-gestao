<?php
    class CivilCadastroAction {
        private $pdo;
        private $daoCivil;

        public function __construct(PDO $pdo) {
            $this->pdo = $pdo;
            $this->daoCivil = new DAOCivil($this->pdo);
        }

        public function execute() {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nome = $_POST["inputName"];
                $email = $_POST["inputEmail"];
                $senha = $_POST["inputPassword"];
                $cpf = $_POST["inputCpf"];
                $celular = $_POST["inputCelular"];
                $telefone = $_POST["inputTelefone"];

                $cepCasa = $_POST["inputCep"];

                $options = [
                    'cost' => 12
                ];

                $senha_criptografada = password_hash($senha, PASSWORD_BCRYPT, $options);
                //$numeroCasa = $_POST["numero"];
                //$complementoCasa = $_POST["complemento"];


                //$novaCasa = new Casa(0, $cepCasa, $numeroCasa, $complementoCasa); // O ID é 0 pois ainda não foi inserida

                //$idCasa = $daoCasa->insert($novaCasa);

                //if ($idCasa) {
                    $novoCivil = $this->daoCivil->insert(null, $nome, $email, $senha_criptografada, $cpf, $celular, $telefone);

                    if ($novoCivil) {
                        header("Location: ../views/civil/civil.php");
                        exit();
                    } else {
                        header("Location: ../views/civil/cad_civil/cad_civil.php?error=cadastrofalhou");
                        exit();
                    }
                //} else {
                //    header("Location: ../views/cadastrar_civil.php?error=cadastrocasafalhou");
                //    exit();
                //}
            }
        }
    }

    include_once("../actions/conn.php");

    include_once("../models/Casa.php"); 
    include_once("../daos/DAOCasa.php");
    include_once("../models/Civil.php");
    include_once("../daos/DAOCivil.php"); 

    $civilCadastroAction = new CivilCadastroAction($pdo);
    $civilCadastroAction->execute();
?>
