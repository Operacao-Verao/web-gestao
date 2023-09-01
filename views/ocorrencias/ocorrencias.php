<!DOCTYPE html>

<head>
	<link rel="stylesheet" href="./styles.css" />
	<title>Defesa Civil - Ocorrências</title>
</head>

<?php
require '../../partials/header/header.php';

session_start();
if(empty($_SESSION['usuario_id']) || empty($_SESSION['usuario_id']) || empty($_SESSION['usuario_id'])) {
	session_destroy();
	header("Location: ../login/login.php");
};
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
						<button onclick="openModal(\'viewOcorrencia\', '.$ocorrencia->getId().')"><i class="ph-bold ph-eye"></i></button>
					</div>
					<div class="ocorrencia-subtitle">
						<p>' . $ocorrencia->getRelatoCivil() . '</p>
					</div>
				</div>
			</div>';
			}

			?>
			
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
				<p class="item-content" id="view_civil">Samantha Zduniak</p>
			</div>
			<div class="item-column grid-acionamento">
				<p class="item-title">Acionamento</p>
				<p class="item-content" id="view_acionamento">07851-120</p>
			</div>
			<div class="item-column grid-relato">
				<p class="item-title">Relato do Civil</p>
				<p class="item-content" id="view_relato">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium, tenetur
					doloremque laboriosam sed soluta fugit facere consequuntur optio distinctio animi dolorem quaerat
					ipsa vel reiciendis repelle</p>
			</div>
			<div class="item-column grid-endereço">
				<p class="item-title">Endereço</p>
				<p class="item-content" id="view_endereco">samanthazduniak@gmail.com</p>
			</div>
			<div class="item-column grid-casas">
				<p class="item-title">Casas Envolvidas</p>
				<p class="item-content" id="view_casas_envolvidas">642.024.030-10</p>
			</div>
		</div>
		<div class="ocorrencias-content">
			<div class="topRow">
				<div class="item-column">
					<label for="inputTecnico" class="item-title">Técnico Responsável - <span>Samantha Zduniak</span></label>
					<select name="inputTecnico" class="inputTecnico" id="alter_tecnico">
						<option selected disabled hidden>Selecionar...</option>
						<?php
							require '../../models/Tecnico.php';
							require '../../daos/DAOTecnico.php';
							require '../../models/Funcionario.php';
							require '../../daos/DAOFuncionario.php';

							$daoFuncionario = new DAOFuncionario($pdo);
							$daoTecnico = new DAOTecnico($pdo);
							$tecnicos = $daoTecnico->listAll();

							$tecnicos_funcionarios = [];
							foreach ($tecnicos as $tecnico) {
								$funcionario = $daoFuncionario->findById($tecnico->getIdFuncionario());
								if ($funcionario){
									echo '<option value="'.$tecnico->getId().'">'.$funcionario->getNome().'</option>';
								}
							}
						?>
					</select>
				</div>
				<select name="inputAprovar" class="inputAprovar" id="alter_aprovado">
					<option selected disabled hidden>Aprovar</option>
					<option value="true">Aprovado</option>
					<option value="false">Desaprovado</option>
				</select>
			</div>
		</div>
	</section>
</div>
<!--MODAL VISUALIZAR OCORRÊNCIA-->
</main>
<script>
	let ocorrencia_atual = null;
	
	function requestFromAction(action, onSuccess=function(r){}, onError=function(r){}, data={}){
		fetch(action, {
			"method": "PUT",
			"headers": {"Content-Type": "application/json"},
			"body": JSON.stringify(data)
		}).then(
			onSuccess, onError
		);
	}

	function openModal(id, ocorrencia_id) {
		requestFromAction("../../actions/fetch/get_ocorrencia.php", function(r){
	      r.json().then(function(json){
			document.getElementById(id).classList.add('open');
			
			view_civil.textContent = json.civil;
			view_acionamento.textContent = json.acionamento;
			view_relato.textContent = json.relato;
			view_endereco.textContent = json.rua+" - "+json.numero+" ("+json.bairro+")";
			view_casas_envolvidas.textContent = json.numCasas;
			alter_tecnico.value = json.tecnicoId;
			alter_aprovado.value = json.aprovado;
			//console.log(json);
	      });
	    }, function(){}, {"id":ocorrencia_id});
	    ocorrencia_atual = ocorrencia_id;
	}

	function closeModal() {
		document.querySelector('.viewOcorrencia.open').classList.remove('open');
	}
	
	alter_tecnico.onchange = alter_aprovado.onchange = function() {
		requestFromAction("../../actions/fetch/alter_ocorrencia.php", function(r){
	      r.text().then(function(r){
	      	console.log(r);
	      });
	    }, function(){}, {"id":ocorrencia_atual, "idTecnico":isNaN(Number(alter_tecnico.value))||alter_tecnico.value==""?null:Number(alter_tecnico.value), "aprovado":(alter_aprovado.value=="true"?true:false)});
	}
</script>

</html>