<!DOCTYPE html>

<head>
	<link rel="stylesheet" href="./styles.css" />
	<title>Defesa Civil - Ocorrências</title>
</head>

<?php
require '../../partials/header/header.php';
?>
<div class="wrapper-main">
	<section class="search-space">
		<div class="search-div">
			<input type="search" placeholder="Procurar Ocorrencias..." />
			<i class="ph ph-magnifying-glass"></i>
		</div>
	</section>
	<section class="wrapper">
		<div class="status">
			<button class="btnStatus">Desaprovado</button>
			<button class="btnStatus">Aprovado</button>
		</div>
		<div class="ocorrencias">

			<?php
			require '../../actions/conn.php';

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

			$relatorios = $daoRelatorio->listAll();

			foreach ($relatorios as $relatorio) {
				$ocorrencia = $daoOcorrencia->findById($relatorio->getIdOcorrencia());
				$casa = $daoCasa->findById($relatorio->getIdCasa());
				$endereco = $daoEndereco->findByCep($casa->getCep());
				echo '<div class="ocorrencia-item">
				<div class="ocorrencia-date">
					<p>' . $ocorrencia->getDataOcorrencia() . '</p>
					<p>00:00</p>
				</div>
				<div class="ocorrencia-info">
					<div class="ocorrencia-title">
						<p>' . $endereco->getRua() . ' - ' . $casa->getNumero() . ' (' . $endereco->getBairro() . ')</p>
						<i class="ph ph-eye"></i>
					</div>
					<div class="ocorrencia-subtitle">
						<p>' . $ocorrencia->getRelatoCivil() . '</p>
					</div>
				</div>
			</div>';
			}

			?>

			<div class="ocorrencia-item">
				<div class="ocorrencia-date">
					<p>20/05</p>
					<p>14:20</p>
				</div>
				<div class="ocorrencia-info">
					<div class="ocorrencia-title">
						<p>Rua - Número da Casa (Bairro)</p>
						<button onclick="openModal('viewOcorrencia')"><i class="ph-bold ph-eye"></i></button>
					</div>
					<div class="ocorrencia-subtitle">
						<p>Observação da ocorrência</p>
					</div>
				</div>
			</div>
			<div class="ocorrencia-item">
				<div class="ocorrencia-date">
					<p>20/05</p>
					<p>14:20</p>
				</div>
				<div class="ocorrencia-info">
					<div class="ocorrencia-title">
						<p>Rua - Número da Casa (Bairro)</p>
						<button onclick="openModal('viewOcorrencia')"><i class="ph-bold ph-eye"></i></button>
					</div>
					<div class="ocorrencia-subtitle">
						<p>Observação da ocorrência</p>
					</div>
				</div>
			</div>

			<a href="./cad_ocorrencia/cad_ocorrencia.php"><button class="btnCriar">Criar Ocorrencia</button></a>
		</div>
	</section>
	<!--MODAL VISUALIZAR OCORRÊNCIA-->
	<section id="viewOcorrencia" class="viewOcorrencia">
		<div class="topRow">
			<h2>Visualizar Ocorrência</h1>
				<button onclick="closeModal()"><i class="ph-bold ph-x"></i></button>
		</div>
		<div class="civil-content">
			<div class="item-column grid-civil">
				<p class="item-title">Civil</p>
				<p class="item-content">Samantha Zduniak</p>
			</div>
			<div class="item-column grid-acionamento">
				<p class="item-title">Acionamento</p>
				<p class="item-content">07851-120</p>
			</div>
			<div class="item-column grid-relato">
				<p class="item-title">Relato do Civil</p>
				<p class="item-content">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium, tenetur
					doloremque laboriosam sed soluta fugit facere consequuntur optio distinctio animi dolorem quaerat
					ipsa vel reiciendis repelle</p>
			</div>
			<div class="item-column grid-endereço">
				<p class="item-title">Endereço</p>
				<p class="item-content">samanthazduniak@gmail.com</p>
			</div>
			<div class="item-column grid-casas">
				<p class="item-title">Casas Envolvidas</p>
				<p class="item-content">642.024.030-10</p>
			</div>
		</div>
		<div class="ocorrencias-content">
			<div class="topRow">
				<div class="item-column">
					<label for="inputTecnico" class="item-title">Técnico Responsável - <span>Samantha Zduniak</span></label>
					<select name="inputTecnico" class="inputTecnico">
						<option selected disabled hidden>Selecionar...</option>
						<option value="Jonas">Jonas</option>
						<option value="Jonas">Jonas</option>
						<option value="Jonas">Jonas</option>
						<option value="Jonas">Jonas</option>
					</select>
				</div>
				<select name="inputAprovar" class="inputAprovar">
					<option selected disabled hidden>Aprovar</option>
					<option value="1">Aprovado</option>
					<option value="0">Desaprovado</option>
				</select>
			</div>
		</div>
	</section>
</div>
<!--MODAL VISUALIZAR OCORRÊNCIA-->
</main>
<script src="script.js"></script>

</html>