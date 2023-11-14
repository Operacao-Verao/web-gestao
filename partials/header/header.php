<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="https://unpkg.com/@phosphor-icons/web"></script>
	<link rel="stylesheet" href="../../partials/header/styles.css" />
</head>
<?php
	require '../../actions/conn.php';
	require '../../actions/session_auth.php';

	authenticateSession(TIPO_USUARIO::GUEST);
?>
<body>
	<nav>
		<div class="logo-name">
			<span>
				<a href=<?php
					if($_SESSION["usuario_tipo"] == TIPO_USUARIO::GESTOR) {
						echo "../../views/home/home.php";
					}
					else {
						echo "../../views/niveis_chuva/niveis_chuva.php";
					}
				?> class="logo_name">Defesa Civil</a>
			</span>
		</div>
		<div class="menu-items">
			<?php
				if($_SESSION["usuario_tipo"] == TIPO_USUARIO::GESTOR) {
					require 'header_gestao.php';
				}
				else {
					require 'header_civil.php';
				}
			?>
		</div>
	</nav>
	<main class="dashboard">
</body>

</html>