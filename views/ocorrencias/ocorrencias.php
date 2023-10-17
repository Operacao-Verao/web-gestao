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
			<input type="search" oninput="searchOcorrencias(this.value)" id="search_ocorrencia" placeholder="Procurar Ocorrencias..." />
			<i class="ph ph-magnifying-glass"></i>
		</div>
	</section>
	<section class="wrapper">
		<div class="status">
			<button class="btnStatus" onclick="trocarAba(false)">Desaprovado</button>
			<button class="btnStatus" onclick="trocarAba(true)">Aprovado</button>
		</div>
		<div class="ocorrencias" id="lista_ocorrencias">
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
			?>
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
				<p class="item-content" id="view_civil"></p>
			</div>
			<div class="item-column grid-acionamento">
				<p class="item-title">Acionamento</p>
				<p class="item-content" id="view_acionamento"></p>
			</div>
			<div class="item-column grid-relato">
				<p class="item-title">Descrição</p>
				<p class="item-content" id="view_relato"></p>
			</div>
			<div class="item-column grid-endereço">
				<p class="item-title">Endereço</p>
				<p class="item-content" id="view_endereco"></p>
			</div>
			<div class="item-column grid-casas">
				<p class="item-title">Casas Envolvidas</p>
				<p class="item-content" id="view_casas_envolvidas"></p>
			</div>
		</div>
		<div class="ocorrencias-content">
			<div class="topRow">
				<div class="item-column">
					<label for="inputTecnico" class="item-title">Técnico Responsável</label>
					<select name="inputTecnico" class="inputTecnico" id="alter_tecnico">
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
					<option value="1">Aprovado</option>
					<option value="0">Desaprovado</option>
						</select>
			</div>
		</div>
		<button class="btnTrancar" id="btnTrancar" onclick="trancarOcorrencia()">Trancar</button>
	</section>
</div>
</main>
<script>
	let aba_status_aprovado = false; // Seleciona entre aprovados e não aprovados
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
			console.log(json);
			document.getElementById(id).classList.add('open');
			
			view_civil.textContent = json.civil;
			view_acionamento.textContent = json.acionamento;
			view_relato.textContent = json.relato;
			view_endereco.textContent = json.rua+" - "+json.numero+" ("+json.bairro+")";
			view_casas_envolvidas.textContent = json.numCasas;
			alter_tecnico.value = json.tecnicoId;
			alter_aprovado.value = json.aprovado;
			
			if (aba_status_aprovado != json.aprovado){
				trocarAba(json.aprovado);
			}
			if (json.encerrado){
				alter_tecnico.disabled = true;
	    		alter_aprovado.disabled = true;
	    		btnTrancar.hidden = true;
			}
			else {
				alter_tecnico.disabled = null;
	    		alter_aprovado.disabled = null;
	    		btnTrancar.hidden = null;
			}
	      });
	    }, function(){}, {"id":ocorrencia_id});
	    ocorrencia_atual = ocorrencia_id;
	}
	
	// Procura por ocorrencias
	function searchOcorrencias(text) {
		requestFromAction("../../actions/fetch/search_ocorrencia.php", function(r){
	      r.json().then(function(json){
	      	let content = "";
	      	
	      	for (let i=0; i<json.length; i++){
	      		let oe = json[i]; // Entrada de ocorrência
	      		content += `<div class="ocorrencia-item">
				<div class="ocorrencia-date">
					<p>`+oe.data+`</p>
					<p>`+oe.hora+`</p>
				</div>
				<div class="ocorrencia-info">
					<div class="ocorrencia-title">
						<p>`+oe.rua+` - `+oe.numero+` (`+oe.bairro+`)</p>
						<button onclick="openModal(\'viewOcorrencia\', `+oe.id+`)"><i class="ph-bold ph-eye"></i></button>
					</div>
					<div class="ocorrencia-subtitle">
						<p>`+oe.relato+`</p>
					</div>
				</div>
			</div>`
	      	}
			lista_ocorrencias.innerHTML = content+'<a href="./cad_ocorrencia/cad_ocorrencia.php"><button class="btnCriar">Criar Ocorrencia</button></a>';
	      });
	    }, function(){}, {"text": text, "aprovado": aba_status_aprovado});
	}
	searchOcorrencias("");
	
	function trocarAba(status_aprovado=aba_status_aprovado){
		aba_status_aprovado = status_aprovado;
		searchOcorrencias(search_ocorrencia.value);
	}
	
	function closeModal() {
		document.querySelector('.viewOcorrencia.open').classList.remove('open');
	}
	
	alter_tecnico.onchange = alter_aprovado.onchange = function() {
		
	}
	
	function trancarOcorrencia() {
		if (!confirm("Deseja mesmo trancar esta ocorrência? Isto significa que não poderá ser alterada novamente.")){
			return;
		}
		
		requestFromAction("../../actions/fetch/tranca_ocorrencia.php", function(r){
	      r.text().then(function(r){
	      	console.log(r);
	      });
	      trocarAba();
	    }, function(){}, {"id":ocorrencia_atual, "idTecnico":isNaN(Number(alter_tecnico.value))||alter_tecnico.value==""?null:Number(alter_tecnico.value), "aprovado":(alter_aprovado.value=="1"?1:0)});
	    alter_tecnico.disabled = true;
	    alter_aprovado.disabled = true;
	    btnTrancar.hidden = true;
	}
</script>

<?php
	if (isset($_GET['id'])){
		echo '<script>openModal("viewOcorrencia", '.$_GET['id'].')</script>';
		$_GET['id'] = null;
	}
?>

</html>