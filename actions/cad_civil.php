<?php
    require 'conn.php';
    require 'session_auth.php';
    authenticateSession(TIPO_USUARIO::GESTOR, '', '../login/login.php');
    
    include_once("../models/Casa.php"); 
    include_once("../daos/DAOCasa.php");
    include_once("../models/Civil.php");
    include_once("../daos/DAOCivil.php"); 
    
    require '../models/Funcionario.php';
    require '../daos/DAOFuncionario.php';
    require '../models/Registro.php';
    require '../daos/DAORegistro.php';
    
    try {
        $daoCivil = new DAOCivil($pdo);
        
        $nome = $_POST["inputName"];
        $email = $_POST["inputEmail"];
        $senha = $_POST["inputPassword"];
        $cpf = $_POST["inputCpf"];
        $celular = $_POST["inputCelular"];
        $telefone = $_POST["inputTelefone"];

        $cepCasa = $_POST["inputCep"];
        
        $senha_criptografada = hash('sha256', $senha);
        //$numeroCasa = $_POST["numero"];
        //$complementoCasa = $_POST["complemento"];
        
        //$novaCasa = new Casa(0, $cepCasa, $numeroCasa, $complementoCasa); // O ID é 0 pois ainda não foi inserida
        
        //$idCasa = $daoCasa->insert($novaCasa);
        
        //if ($idCasa) {
            $novoCivil = $daoCivil->findByCpf($cpf);
            if ($novoCivil != null){
                header("Location: ../views/civil/cad_civil/cad_civil.php?error=cadastrofalhou");
                exit();
            }
            
            $novoCivil = $daoCivil->insert(null, $nome, $email, $senha_criptografada, $cpf, $celular, $telefone);

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
    catch (Throwable $error){
        regError($error);
        header("Location: ../views/civil/civil.php?error=500");
    }
?>
