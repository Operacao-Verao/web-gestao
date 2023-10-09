<?php
    include_once('conn.php');
    
    // Only allowed in DEV version
    if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
        header("Location: ../views/login/login.php");
    }
    
    include_once("../models/Funcionario.php");
    include_once("../daos/DAOFuncionario.php");
    include_once("../models/Gestor.php");
    include_once("../daos/DAOGestor.php");
    include_once("../models/Tecnico.php");
    include_once("../daos/DAOTecnico.php");
    
    $daoFuncionario = new DAOFuncionario($pdo);
    $daoGestor = new DAOGestor($pdo);
    $daoTecnico = new DAOTecnico($pdo);
    
    $funcionario = null;
    if (!($funcionario = $daoFuncionario->findByEmail("admin"))){
        $funcionario = $daoFuncionario->insert("Administrador", "admin", "", TIPO_USUARIO::GESTOR);
    }
    $gestor = null;
    if (!($gestor = $daoGestor->findByFuncionario($funcionario))){
        $gestor = $daoGestor->insert($funcionario);
    }
    $tecnico = null;
    if (!($tecnico = $daoTecnico->findByFuncionario($funcionario))){
        $tecnico = $daoTecnico->insert($funcionario, true);
    }
    
	session_start();
	$_SESSION["usuario_id"] = $funcionario->getId();
    $_SESSION["usuario_nome"] = $funcionario->getNome();
    $_SESSION["usuario_tipo"] = $funcionario->getTipoUsuario();

    header("Location: ../views/home/home.php");
?>