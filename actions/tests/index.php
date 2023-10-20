<?php
    include_once('../conn.php');
    
    // Only allowed in DEV version
    if (DEV_LEVEL != DEV_LEVEL::DEV_MODE){
        header("Location: ../../views/login/login.php");
    }
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
			<li><a href="old.php">old.php</a></li>
			<li><a href="search_ocorrencia.php">search_ocorrencia.php</a></li>
		</ul>
		
	</body>
</html>
