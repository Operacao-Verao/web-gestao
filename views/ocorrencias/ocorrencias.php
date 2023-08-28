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
			<button>Desaprovado</button>
			<button>Aprovado</button>
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
				
				foreach ($relatorios as $relatorio){
					$ocorrencia = $daoOcorrencia->findById($relatorio->getIdOcorrencia());
					$casa = $daoCasa->findById($relatorio->getIdCasa());
					$endereco = $daoEndereco->findByCep($casa->getCep());
					echo '<div class="ocorrencia-item">
				<div class="ocorrencia-date">
					<p>'.$ocorrencia->getDataOcorrencia().'</p>
					<p>00:00</p>
				</div>
				<div class="ocorrencia-info">
					<div class="ocorrencia-title">
						<p>'.$endereco->getRua().' - '.$casa->getNumero().' ('.$endereco->getBairro().')</p>
						<i class="ph ph-eye"></i>
					</div>
					<div class="ocorrencia-subtitle">
						<p>'.$ocorrencia->getRelatoCivil().'</p>
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
						<i class="ph ph-eye"></i>
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
						<i class="ph ph-eye"></i>
					</div>
					<div class="ocorrencia-subtitle">
						<p>Observação da ocorrência</p>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
</main>

</html>