<!DOCTYPE html>
<html lang="pt-br">

<head>
	<link rel="stylesheet" href="./styles.css" />
	<title>Defesa Civil - Técnicos</title>
</head>

<?php
	require '../../partials/header/header.php';
	require '../../actions/conn.php';
	
	require '../../actions/session_auth.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '', '../login/login.php');
	
	require '../../models/Tecnico.php';
	require '../../daos/DAOTecnico.php';
	require '../../models/Funcionario.php';
	require '../../daos/DAOFuncionario.php';
	
	$daoFuncionario = new DAOFuncionario($pdo);
	$daoTecnico = new DAOTecnico($pdo);
	$tecnicos = $daoTecnico->listAll();

	$tecnicos_funcionarios = [];
	foreach ($tecnicos as $tecnico) {
		$tecnicos_funcionarios[] = $daoFuncionario->findById($tecnico->getIdFuncionario());
	}
?>

<div class="dash-content">
		<div class="activity-data">

			<div class="data names">
				<span class="data-title">Nome</span>
				<?php
					// Print Names
					foreach ($tecnicos_funcionarios as $tecnico) {
						echo '<span class="data-list">' . $tecnico->getNome() . '</span>';
					}
				?>
			</div>
			<div class="data names">
				<span class="data-title">Email</span>
				<?php
					// Print Emails
					foreach ($tecnicos_funcionarios as $tecnico) {
						echo '<span class="data-list">' . $tecnico->getEmail() . '</span>';
					}
				?>
			</div>
			<div class="data status">
				<span class="data-title">Status</span>
				<?php
					// Print Actives
					foreach ($tecnicos as $tecnico) {
						echo '<span class="data-list ' . ($tecnico->getAtivo() ? 'ativo' : 'inativo') . '">' . ($tecnico->getAtivo() ? 'Ativo' : 'Inativo') . '</span>';
					}

				?>
			</div>
			<div class="data ver">
				<span class="data-title">Editar</span>
				<?php
					// Print Edits
					foreach ($tecnicos as $tecnico) {
						echo '<span class="data-list"><a href="cad_tecnico/cad_tecnico.php?tecnico_id=' . $tecnico->getId() . '"><i class="ph-bold ph-pencil"></i></a></span>';
					}
				?>
			</div>
		</div>
		<a href="cad_tecnico/cad_tecnico.php">
			<button>Cadastrar Técnico</button>
		</a>
	</div>
</main>

</html>