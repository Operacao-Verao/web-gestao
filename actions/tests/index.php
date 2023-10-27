<?php
    include_once('../conn.php');
    
    // Only allowed in DEV version
    if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
        header("Location: ../../views/login/login.php");
    }
    
    include_once("../../models/Funcionario.php");
    include_once("../../daos/DAOFuncionario.php");
    include_once("../../models/Gestor.php");
    include_once("../../daos/DAOGestor.php");
    include_once("../../models/Tecnico.php");
    include_once("../../daos/DAOTecnico.php");
    
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
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
	</head>
	<body>
		
		<ul>
			<li><a href="chart.php">chart.php</a></li>
			<li><a href="daos.php">daos.php</a></li>
			<li><a href="formats.php">formats.php</a></li>
			<li><a href="list_ocorrencia.php">list_ocorrencia.php</a></li>
			<li><a href="listas.php">listas.php</a></li>
			<li><a href="old.php">old.php</a></li>
            <li><a href="populate.php?base=100">populate.php</a></li>
			<li><a href="search_ocorrencia.php">search_ocorrencia.php</a></li>
		</ul>
		
	</body>
</html>
