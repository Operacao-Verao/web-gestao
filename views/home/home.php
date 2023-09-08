<!DOCTYPE html>

<head>
	<link rel="stylesheet" href="./styles.css" />
	<title>Defesa Civil - Home</title>
</head>

<?php
require '../../partials/header/header.php';
require '../../actions/conn.php';

session_start();
if(empty($_SESSION['usuario_id']) || empty($_SESSION['usuario_id']) || empty($_SESSION['usuario_id'])) {
	session_destroy();
	header("Location: ../login/login.php");
};
?>
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
					<span class="number">
						<?php
							require '../../models/Ocorrencia.php';
							require '../../daos/DAOOcorrencia.php';
							
							$daoOcorrencia = new DAOOcorrencia($pdo);
							
							echo count($daoOcorrencia->listAll());
						?>
					</span>
				</div>
			</div>
			<div class="box box2">
				<i class="ph-bold ph-chart-line-up"></i>
				<div class="box-info">
					<span class="text">Relatórios</span>
					<span class="number">
						<?php
							require '../../models/Relatorio.php';
							require '../../daos/DAORelatorio.php';
							
							$daoRelatorio = new DAORelatorio($pdo);
							
							echo count($daoRelatorio->listAll());
						?>
					</span>
				</div>
			</div>
			<div class="box box3">
				<i class="ph ph-coins"></i>
				<div class="box-info">
					<span class="text">Técnicos</span>
					<span class="number">
						<?php
							require '../../models/Tecnico.php';
							require '../../daos/DAOTecnico.php';
							
							$daoTecnico = new DAOTecnico($pdo);
							
							echo count($daoTecnico->listAll());
						?>
					</span>
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

		<div class="activity-data" id="lista_ocorrencias">
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
<script type="text/javascript"> 
	function requestFromAction(action, onSuccess=function(r){}, onError=function(r){}, data={}, method){
		fetch(action, {
			"method": method,
			"headers": {"Content-Type": "application/json"},
			"body": JSON.stringify(data)
		}).then(
			onSuccess, onError
		);
	}

	navigator.serviceWorker.register("sw.js");

	function enableNotif() {
		Notification.requestPermission().then((permission) => {
			if(permission === 'granted') {
				navigator.serviceWorker.ready.then((sw) => {
					sw.pushManager.subscribe({
						userVisibleOnly: true,
						applicationServerKey: "BPwL7jbII3foRiJ180O05ZKwOo7AlAY7on_DLg5p_OuWMOPSDuD4716aWYtqNzIDwpDlONY0tH-hj2dJIktk_0s"
					}).then((subscription) => {
						registerNotificationOnDatabase(JSON.stringify(subscription));
					});
				});
			}
		})
	}

	enableNotif();

	function registerNotificationOnDatabase(subscription) {
		requestFromAction("../../actions/fetch/registrar_service_worker.php", function(r){
	      r.json().then(function(json){
				});
	    }, function(){
				console.log('deu erro')
			}, JSON.parse(subscription), "POST")
	}
	
	function goToAction(action, values={}){
		let form = document.createElement('form');
		form.method = 'post';
		form.action = action;
		let submit = document.createElement('input');
		submit.type = 'submit';
		form.appendChild(submit);
		for (let name in values){
			let value = document.createElement('input');
			value.name = name;
			value.type = values[name].type || 'text';
			value.value = values[name].value;
			form.appendChild(value);
		}
		document.body.appendChild(form);
		submit.click();
		form.remove();
	}
	
	function goToOcorrencia(id) {
		goToAction('../ocorrencias/ocorrencias.php', {
			'id_ocorrencia': {
				'value':id
			}
		});
	}
	
	// Rebuscar ocorrências
	function refreshOcorrencias() {
		requestFromAction("../../actions/fetch/search_ocorrencia.php", function(r){
	      r.json().then(function(json){
	      	//console.log(json);
	      	let content_endereco = '<div class="data address"><span class="data-title">Endereço</span>';
	      	let content_tecnico = '<div class="data names"><span class="data-title">Técnico</span>';
	      	let content_data = '<div class="data request"><span class="data-title">Data</span>';
	      	let content_status = '<div class="data status"><span class="data-title">Status</span>';
	      	let content_ver = '<div class="data ver"><span class="data-title">Ver</span>';
	      	
	      	for (let i=0; i<json.length; i++){
	      		let oe = json[i]; // Entrada de ocorrência
	      		
		      	content_endereco += '<span class="data-list">'+oe.rua+' - '+oe.numero+' ('+oe.bairro+')</span>';
		      	content_tecnico += '<span class="data-list">'+(oe.tecnico==null?"-Não atribuído-":oe.tecnico)+'</span>';
		      	content_data += '<span class="data-list">'+oe.data+'</span>';
		      	content_status += '<span class="data-list">'+'Pendente'+'</span>';
		      	content_ver += '<span class="data-list" onclick="goToOcorrencia('+oe.id+')"><i class="ph-bold ph-eye"></i></span>';
	      	}
	      	content_endereco += '</div>';
	      	content_tecnico += '</div>';
	      	content_data += '</div>';
	      	content_status += '</div>';
	      	content_ver += '</div>';
			lista_ocorrencias.innerHTML = content_endereco+content_tecnico+content_data+content_status+content_ver;
	      });
	    }, function(){}, {"text": "", "aprovado": true}, "PUT");
	}
	refreshOcorrencias();
	
</script>
</main>

</html>