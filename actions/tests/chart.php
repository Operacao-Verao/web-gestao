<?php
    include_once('../conn.php');
    
    // Only allowed in DEV version
    if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
        header("Location: ../../views/login/login.php");
    }
    
	include_once("../../models/Ocorrencia.php");
	include_once("../../daos/DAOOcorrencia.php");
	include_once("../../models/Relatorio.php");
	include_once("../../daos/DAORelatorio.php");
	
	$daoOcorrencia = new DAOOcorrencia($pdo);
	$daoRelatorio = new DAORelatorio($pdo);
	echo getCurrentDate();
	echo '<br/>';
	echo 10;
	echo '<br/>';
	echo 3;
	echo '<br/>';
	
	$json = json_encode($daoOcorrencia->statisticsGreaterByBairro(getCurrentDate(), 10, 3, 3, true), true);
	echo $daoRelatorio->statisticsTotal(true);
?>