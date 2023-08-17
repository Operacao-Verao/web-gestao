<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<script src="https://unpkg.com/@phosphor-icons/web"></script>
		<link rel="stylesheet" href="./assets/ocorrencias.css" />
		<title>Defesa Civil - Ocorrências</title>
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
						<a href="home.php"
							><i class="ph-bold ph-house"></i
							><span class="link-name">Home</span></a
						>
					</li>
					<li>
						<a href="tecnico.php"
							><i class="ph-bold ph-files"></i
							><span class="link-name">Técnicos</span></a
						>
					</li>
					<li>
						<a href="ocorrencias.php"
							><i class="ph-bold ph-users"></i
							><span class="link-name">Ocorrências</span></a
						>
					</li>
					<li>
						<a href="#"
							><i class="ph-bold ph-warning-octagon"></i
							><span class="link-name">Relatórios</span></a
						>
					</li>
					<li>
						<a href="#"
							><i class="ph-bold ph-user-list"></i
							><span class="link-name">Secretários</span></a
						>
					</li>
					<li>
						<a href="#"
							><i class="ph-bold ph-users-three"></i
							><span class="link-name">Civil</span></a
						>
					</li>
					<li></li>
					<li>
						<a href="#"
							><i class="ph-bold ph-cloud-rain"></i
							><span class="link-name">Pluviômetro/Fluviômetro</span></a
						>
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
		<main class="dashboard">
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
		</main>
	</body>
</html>
