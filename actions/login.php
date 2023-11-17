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
            header("Location: ../views/login/login.php?error=empty_entries");
            exit();
        }
        
        $funcionario = $daoFuncionario->findByEmail($email);
        $acesso_permitido = $funcionario != null && verifyPassword($funcionario->getSenha(), $senha);
        
        $gestor = null;
        
        if ($funcionario != null){
            $gestor = $daoGestor->findByFuncionario($funcionario);
            if ($gestor == null || $funcionario->getTipoUsuario()!=TIPO_USUARIO::GESTOR){
                header("Location: ../views/login/login.php?error=gestor_only");
                exit();
            }
        }
        
        if ($acesso_permitido) {
            $_SESSION["usuario_id"] = $funcionario->getId();
            $_SESSION["usuario_nome"] = $funcionario->getNome();
            $_SESSION["usuario_tipo"] = $funcionario->getTipoUsuario();

            header("Location: ../views/home/home.php");
            exit();
        } else {
            header("Location: ../views/login/login.php?error=wrong_login");
            exit();
        }
    }
    catch (Throwable $error){
        header("Location: ../views/login/login.php?error=500");
        regError($error);
    }
?>
