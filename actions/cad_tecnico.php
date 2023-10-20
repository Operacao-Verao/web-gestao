<?php
    require 'conn.php';
    require 'session_auth.php';
    authenticateSession(TIPO_USUARIO::GESTOR, '', '../login/login.php');
    
    include_once("../models/Funcionario.php");
    include_once("../daos/DAOFuncionario.php");
    include_once("../models/Tecnico.php");
    include_once("../daos/DAOTecnico.php");
    
    require '../models/Registro.php';
    require '../daos/DAORegistro.php';
    
    try {
        $daoFuncionario = new DAOFuncionario($pdo);
        $daoTecnico = new DAOTecnico($pdo);
        $nome = $_POST["edtnome"];
        $email = $_POST["edtemail"];
        $senha = $_POST["edtsenha"];
        $senhaconfirm = $_POST["edtsenhaconfirm"];
        
        $senha_criptografada = hash('sha256', $senha);

        if (empty($nome) || empty($email) || empty($senha) || empty($senha) || empty($senhaconfirm)) {
            header("Location: ../views/cad_tecnico/cad_tecnico.php");
            exit();
        }

        if ($senha != $senhaconfirm){
            header("Location: ../views/cad_tecnico/cad_tecnico.php");
            exit();
        }
        
        $funcionario = $daoFuncionario->findWithLogin($email, $senha);

        if ($funcionario == null){
            $funcionario = $daoFuncionario->insert($nome, $email, $senha_criptografada, TIPO_USUARIO::FUNCIONARIO);
        }
        
        $tecnico = $daoTecnico->insert($funcionario, true);
        
        header("Location: ../views/tecnicos/tecnicos.php");
    }
    catch (Throwable $error){
        regError($error);
        header("Location: ../views/tecnicos/tecnicos.php?error=500");
    }
?>
