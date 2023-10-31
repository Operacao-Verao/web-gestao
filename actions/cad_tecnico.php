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
        
        $senha_criptografada = encryptPassword($senha);

        if (empty($nome) || empty($email) || empty($senha) || empty($senha) || empty($senhaconfirm)) {
            header("Location: ../views/tecnicos/cad_tecnico/cad_tecnico.php?error=empty_entries");
            exit();
        }

        if ($senha != $senhaconfirm){
            header("Location: ../views/tecnicos/cad_tecnico/cad_tecnico.php?error=unmatched_password");
            exit();
        }
        
        $funcionario = $daoFuncionario->findByEmail($email);

        if ($funcionario == null){
            $funcionario = $daoFuncionario->insert($nome, $email, $senha_criptografada, TIPO_USUARIO::FUNCIONARIO);
        }
        
        if ($daoTecnico->findByFuncionario($funcionario)){
            header("Location: ../views/tecnicos/cad_tecnico/cad_tecnico.php?error=existing_tecnico");
            exit();
        }
        
        $tecnico = $daoTecnico->insert($funcionario, true);
        
        header("Location: ../views/tecnicos/tecnicos.php");
    }
    catch (Throwable $error){
        regError($error);
        header("Location: ../views/tecnicos/tecnicos.php?error=500");
    }
?>
