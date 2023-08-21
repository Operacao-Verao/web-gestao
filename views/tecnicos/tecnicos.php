<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="https://unpkg.com/@phosphor-icons/web"></script>
	<link rel="stylesheet" href="./styles.css" />
	<title>Defesa Civil - Técnicos</title>
</head>

	<?php
		require '../../partials/header/header.php';
		
		require '../../daos/DAOTecnico.php';
		require '../../daos/DAOFuncionario.php';
		
		$daoFuncionario = new DAOFuncionario($pdo);
		$daoTecnico = new DAOTecnico($pdo);
		$tecnicos = $daoTecnico->listAll();
		
		$tecnicos_funcionarios = [];
		foreach ($tecnicos as $tecnico){
			$tecnicos_funcionarios[] = $daoFuncionario->findById($tecnico->getIdFuncionario());
		}
	?>
	
	<div class="dash-content">
		<div class="activity">
			<div class="activity-data">
				
				<div class="data names">
					<span class="data-title">Nome</span>
					<?php
						// Print Names
						foreach ($tecnicos_funcionarios as $tecnico){
							echo '<span class="data-list">'.$tecnico->getNome().'</span>';
						}
					?>
				</div>
				<div class="data names">
					<span class="data-title">Email</span>
					<?php
						// Print Emails
						foreach ($tecnicos_funcionarios as $tecnico){
							echo '<span class="data-list">'.$tecnico->getEmail().'</span>';
						}
					?>
				</div>
				<div class="data status">
					<span class="data-title">Status</span>
					<?php
						// Print Actives
						foreach ($tecnicos as $tecnico){
							echo '<span class="data-list">'.($tecnico->getAtivo()? 'Ativo': 'Inativo').'</span>';
						}
					?>
				</div>
				<div class="data ver">
					<span class="data-title">Editar</span>
					<?php
						// Print Edits
						foreach ($tecnicos_funcionarios as $tecnico){
							echo '<span class="data-list"><i class="ph-bold ph-pencil"></i></span>';
						}
					?>
				</div>
			</div>
			<a href="../cad_tecnico/cad_tecnico.php">
				<button>Cadastrar Técnico</button>
			</a>
		</div>
	</div>

	<script src="barChart.js"></script>
	<script src="header.js"></script>
</body>
</html>
