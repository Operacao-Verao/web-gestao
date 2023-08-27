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
            $nome = $_POST["nome"];
            $email = $_POST["email"];
            $senha = $_POST["senha"];
            $cpf = $_POST["cpf"];
            $celular = $_POST["celular"];
            $telefone = $_POST["telefone"];

            $cepCasa = $_POST["cep"];
            $numeroCasa = $_POST["numero"];
            $complementoCasa = $_POST["complemento"];


            $novaCasa = new Casa(0, $cepCasa, $numeroCasa, $complementoCasa); // O ID é 0 pois ainda não foi inserida

            $idCasa = $daoCasa->insert($novaCasa);

            if ($idCasa) {
                $novoCivil = $this->daoCivil->insert($idCasa, $nome, $email, $senha, $cpf, $celular, $telefone);

                if ($novoCivil) {
                    header("Location: ../views/visualizar_civis.php");
                    exit();
                } else {
                    header("Location: ../views/cadastrar_civil.php?error=cadastrofalhou");
                    exit();
                }
            } else {
                header("Location: ../views/cadastrar_civil.php?error=cadastrocasafalhou");
                exit();
            }
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
