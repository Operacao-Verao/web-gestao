<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="https://unpkg.com/@phosphor-icons/web"></script>
	<link rel="stylesheet" href="./assets/home.css" />
	<title>Defesa Civil - Home</title>
</head>

<body>
	<nav>
		<div class="logo-name">
			<span>
				<a href="home.php" class="logo_name">Defesa Civil</a>
			</span>
		</div>
		<div class="menu-items">
			<ul class="nav-links">
				<li>
					<a href="home.php"><i class="ph-bold ph-house"></i><span class="link-name">Home</span></a>
				</li>
				<li>
					<a href="tecnico.php"><i class="ph-bold ph-files"></i><span class="link-name">Técnicos</span></a>
				</li>
				<li>
					<a href="ocorrencias.php"><i class="ph-bold ph-users"></i><span
							class="link-name">Ocorrências</span></a>
				</li>
				<li>
					<a href="#"><i class="ph-bold ph-warning-octagon"></i><span class="link-name">Relatórios</span></a>
				</li>
				<li>
					<a href="#"><i class="ph-bold ph-user-list"></i><span class="link-name">Secretários</span></a>
				</li>
				<li>
					<a href="#"><i class="ph-bold ph-users-three"></i><span class="link-name">Civil</span></a>
				</li>
				<li></li>
				<li>
					<a href="#"><i class="ph-bold ph-cloud-rain"></i><span
							class="link-name">Pluviômetro/Fluviômetro</span></a>
				</li>
			</ul>
			<ul class="logout-mode">
				<li>
					<a href="#">
						<i class="ph-bold ph-sign-out"></i>
						<span class="link-name">Logout</span>
					</a>
				</li>
			</ul>
		</div>
	</nav>
	<section class="dashboard">
		<div class="dash-content">
			<div class="overview">
				<div class="title">
					<i class="ph-bold ph-gauge"></i>
					<span class="text">Dashboard</span>
				</div>
				<div class="boxes">
					<div class="box box1">
						<i class="ph-bold ph-basket"></i>
						<div class="box-info">
							<span class="text">Ocorrências</span>
							<span class="number">32</span>
						</div>
					</div>
					<div class="box box2">
						<i class="ph-bold ph-chart-line-up"></i>
						<div class="box-info">
							<span class="text">Relatórios</span>
							<span class="number">126</span>
						</div>
					</div>
					<div class="box box3">
						<i class="ph ph-coins"></i>
						<div class="box-info">
							<span class="text">Técnicos</span>
							<span class="number">8</span>
						</div>
					</div>
					<div class="box box4">
						<i class="ph ph-coins"></i>
						<div class="box-info">
							<span class="text">Fluviômetro</span>
							<span class="number">75%</span>
						</div>
					</div>
				</div>
			</div>

			<div>
				<div class="title">
					<i class="ph-bold ph-gauge"></i>
					<span class="text">Gráficos</span>
				</div>
				<div class="graph">
					<div class="big-graph">
					</div>
					<div class="small-graph"></div>
				</div>
			</div>

			<div class="activity">
				<div class="title">
					<i class="ph-bold ph-clock"></i>
					<span class="text">Ocorrências Recentes</span>
				</div>

				<div class="activity-data">
					<div class="data address">
						<span class="data-title">Endereço</span>
						<span class="data-list">R. Heloísa Gomes Batista</span>
						<span class="data-list">R. Heloísa Gomes Batista</span>
						<span class="data-list">R. Heloísa Gomes Batista</span>
						<span class="data-list">R. Heloísa Gomes Batista</span>
						<span class="data-list">R. Heloísa Gomes Batista</span>
					</div>
					<div class="data names">
						<span class="data-title">Técnico</span>
						<span class="data-list">Malcolm Lima</span>
						<span class="data-list">Malcolm Lima</span>
						<span class="data-list">Malcolm Lima</span>
						<span class="data-list">Malcolm Lima</span>
						<span class="data-list">Malcolm Lima</span>
					</div>
					<div class="data request">
						<span class="data-title">Data</span>
						<span class="data-list">07/04/2021</span>
						<span class="data-list">07/04/2021</span>
						<span class="data-list">07/04/2021</span>
						<span class="data-list">07/04/2021</span>
						<span class="data-list">07/04/2021</span>
					</div>
					<div class="data status">
						<span class="data-title">Status</span>
						<span class="data-list">Pendente</span>
						<span class="data-list">Pendente</span>
						<span class="data-list">Pendente</span>
						<span class="data-list">Finalizado</span>
						<span class="data-list">Finalizado</span>
					</div>
					<div class="data ver">
						<span class="data-title">Ver</span>
						<span class="data-list"><i class="ph-bold ph-eye"></i></span>
						<span class="data-list"><i class="ph-bold ph-eye"></i></span>
						<span class="data-list"><i class="ph-bold ph-eye"></i></span>
						<span class="data-list"><i class="ph-bold ph-eye"></i></span>
						<span class="data-list"><i class="ph-bold ph-eye"></i></span>
					</div>
				</div>
			</div>
		</div>
		</div>
	</section>

	<script src="barChart.js"></script>
</body>

</html>