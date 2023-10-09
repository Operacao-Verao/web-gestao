<?php
    include_once("../actions/conn.php");
    include_once("../models/Funcionario.php");
    include_once("../daos/DAOFuncionario.php");
    include_once("../models/Gestor.php");
    include_once("../daos/DAOGestor.php");
    
    include_once('../models/Registro.php');
    include_once('../daos/DAORegistro.php');
    
    try {
        session_start();
        $daoFuncionario = new DAOFuncionario($pdo);
        $daoGestor = new DAOGestor($pdo);
        $email = $_POST["edtemail"];
        $senha = $_POST["edtsenha"];

        if (empty($email) || empty($senha)) {
            header("Location: ../views/login/login.php");
            exit();
        }
        
        $senha = hash('sha256', $senha);
        
        $funcionario = $daoFuncionario->findWithLogin($email, $senha);
        $acesso_permitido = $funcionario != null;
        /*
        $gestor = null;
        
        if ($funcionario == null){
            $acesso_permitido = false;
        }
        else {
            $gestor = $daoGestor->findByFuncionario($funcionario);
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
            echo $senha;
            //header("Location: ../views/login/login.php");
            exit();
        }
    }
    catch (Throwable $error){
        header("Location: ../views/login/login.php?error=500");
        regError($error);
    }
?>
