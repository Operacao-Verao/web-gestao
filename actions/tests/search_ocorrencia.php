<?php
    include_once('../conn.php');
    
    // Only allowed in DEV version
    if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
        header("Location: ../../views/login/login.php");
    }
    
	require '../../models/Ocorrencia.php';
	require '../../daos/DAOOcorrencia.php';
	require '../../models/Relatorio.php';
	require '../../daos/DAORelatorio.php';
	require '../../models/Casa.php';
	require '../../daos/DAOCasa.php';
	require '../../models/Endereco.php';
	require '../../daos/DAOEndereco.php';
	
	$daoOcorrencia = new DAOOcorrencia($pdo);
	$daoRelatorio = new DAORelatorio($pdo);
	$daoCasa = new DAOCasa($pdo);
	$daoEndereco = new DAOEndereco($pdo);
	
	$ocorrencias = $daoOcorrencia->searchByText('', false);
	
	var_dump($ocorrencias);
?>