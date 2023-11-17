<!DOCTYPE html>

<head>
	<link rel="stylesheet" href="./styles.css" />
	<title>Defesa Civil - Ocorrências</title>
</head>
	<?php
		require '../../partials/header/header.php';
		authenticateSession(TIPO_USUARIO::GESTOR, '', 'cad_ocorrencia/cad_ocorrencia.php');
	?>
	<div class="wrapper-main">
		<section class="search-space">
			<div class="search-div">
				<input type="search" oninput="pageIndex = 0; searchOcorrencias(this.value);" id="search_ocorrencia" placeholder="Procurar Ocorrencias..." />
				<i class="ph ph-magnifying-glass"></i>
			</div>
		</section>
		<section class="wrapper">
			<div class="status">
				<button class="btnStatus" id="abaAberto" onclick="trocarAba(null)">Aberto</button>
				<button class="btnStatus" id="abaDesaprovado" onclick="trocarAba(false)">Desaprovado</button>
				<button class="btnStatus" id="abaAprovado" onclick="trocarAba(true)">Aprovado</button>
			</div>
			<div class="ocorrencias" id="lista_ocorrencias">
				<?php
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
									if ($funcionario && $tecnico->getAtivo()){
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
	
	<?php
	  echoError();
	?>
    <script src="../../assets/js/pagination.js"></script>
	<script>
		pageIndex = 0;
		pageCount = 1;
		pageEntries = 4;
		
		pageChangeCallback = function(idx){
			searchOcorrencias(search_ocorrencia.value);
		};
		
		let aba_status_aprovado = -1; // Seleciona entre aprovados e não aprovados
		let ocorrencia_atual = null;
		
		function requestFromAction(action, onSuccess=function(r){}, onError=function(r){}, data={}, method){
			fetch(action, {
				"method": method,
				"headers": {"Content-Type": "application/json"},
				"body": JSON.stringify(data)
			}).then(
				onSuccess, onError
			);
		}

		function openModal(id, ocorrencia_id) {
			requestFromAction("../../actions/fetch/get_ocorrencia.php", function(r){
		      r.json().then(function(json){
				//console.log(json);
				document.getElementById(id).classList.add('open');
				
				view_civil.textContent = json.civil;
				view_acionamento.textContent = json.acionamento;
				view_relato.textContent = json.relato;
				view_endereco.textContent = json.rua+" - "+json.numero+" ("+json.bairro+")";
				view_casas_envolvidas.textContent = json.numCasas;
				alter_tecnico.value = json.tecnicoId;
				alter_aprovado.value = json.aprovado;
				
				if (json.encerrado? aba_status_aprovado != json.aprovado: aba_status_aprovado != null){
					trocarAba(json.encerrado? json.aprovado: null);
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
		    }, function(){}, {"id":ocorrencia_id}, "PUT");
		    ocorrencia_atual = ocorrencia_id;
		}
		
		// Procura por ocorrencias
		function searchOcorrencias(text) {
			requestFromAction("../../actions/fetch/search_ocorrencia.php", function(r){
		      r.json().then(function(json){
		      	//console.log(json);
		      	let content = "";
		      	
		      	for (let i=0; i<json.entries.length; i++){
		      		let oe = json.entries[i]; // Entrada de ocorrência
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
		      	
		      	pageCount = Math.ceil(json.limit/pageEntries)||1;
				lista_ocorrencias.innerHTML = `<div class="all-ocorrencias">`+content+`</div><div class="pagination-button"><div class="pagination" id="pagination_footer"></div><a href="./cad_ocorrencia/cad_ocorrencia.php"><button class="btnCriar">Criar Ocorrencia</button></a></div>`;
				createPaginationFooter(pagination_footer);
		      });
		    }, function(){}, {"text": text, "aprovado": aba_status_aprovado==null?'null':aba_status_aprovado?'true':'false', "offset": pageIndex*pageEntries, "entries": pageEntries}, "PUT");
		}
		
		function trocarAba(status_aprovado){
			pageIndex = 0;
			let stAba = abaAberto, ustAba1 = abaDesaprovado, ustAba2 = abaAprovado;
			if (status_aprovado != null){
				if (status_aprovado){
					stAba = abaAprovado;
					ustAba2 = abaAberto;
				}
				else {
					stAba = abaDesaprovado;
					ustAba1 = abaAberto;
				}
			}
			stAba.style.backgroundColor = '#023b7e';
			stAba.style.color = '#fff';
			ustAba1.style.backgroundColor = '#FFF';
			ustAba1.style.color = '#000';
			ustAba2.style.backgroundColor = '#FFF';
			ustAba2.style.color = '#000';
			aba_status_aprovado = status_aprovado;
			searchOcorrencias(search_ocorrencia.value);
		}
		
		function closeModal() {
			document.querySelector('.viewOcorrencia.open').classList.remove('open');
		}
		
		function trancarOcorrencia() {
			if (alter_tecnico.value=="" && alter_aprovado.value=="1"){
				alert("Para realizar a aprovação é exigido que atribua um técnico á ocorrência!");
				return;
			}
			
			if (!confirm("Deseja mesmo trancar esta ocorrência? Isto significa que não poderá ser alterada novamente.")){
				return;
			}
			
			requestFromAction("../../actions/fetch/tranca_ocorrencia.php", function(r){
				r.json().then(function(json){
					if (typeof json.error !== 'undefined'){
						return;
					}
					
					// envia notificação ao técnico no mobile
					const data = {
						ids: [json.token]
					};

					fetch("https://exp.host/--/api/v2/push/getReceipts", {
						method: "POST",
						mode: "no-cors",
						headers: {
							"Content-Type": "application/json"
						},
						body: JSON.stringify(data)
					});
				});
				trocarAba(aba_status_aprovado);
		    }, function(){}, {"id":ocorrencia_atual, "idTecnico":isNaN(Number(alter_tecnico.value))||alter_tecnico.value==""?null:Number(alter_tecnico.value), "aprovado":(alter_aprovado.value=="1"?1:0)}, 'POST');
		    alter_tecnico.disabled = true;
		    alter_aprovado.disabled = true;
		    btnTrancar.hidden = true;
		}
		
		let update = setInterval(function(){
			searchOcorrencias(search_ocorrencia.value);
		}, 30 * 1000);
	</script>
	<?php
		if (isset($_GET['id'])){
			echo '<script>openModal("viewOcorrencia", '.$_GET['id'].');</script>';
			$_GET['id'] = null;
		}
		else {
			echo '<script>trocarAba(null);</script>';
		}
	?>
</html>