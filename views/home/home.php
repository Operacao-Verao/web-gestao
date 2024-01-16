<!DOCTYPE html>

<head>
	<link rel="stylesheet" href="./styles.css" />
	<title>Defesa Civil - Home</title>
</head>

<?php
	require '../../partials/header/header.php';
	authenticateSession(TIPO_USUARIO::GESTOR, '', '../login/login.php');
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
					<span class="text">Ocorrências<br/>(em aberto)</span>
					<span class="number" id="countOcorrencias">Infinity</span>
				</div>
			</div>
			<div class="box box2">
				<i class="ph-bold ph-chart-line-up"></i>
				<div class="box-info">
					<span class="text">Relatórios</span>
					<span class="number" id="countRelatorios">Infinity</span>
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
		</div>
	</div>

	<div>
		<div class="title">
			<i class="ph-bold ph-gauge"></i>
			<span class="text">Gráficos</span>
		</div>
		<div class="graph">
			<div class="big-graph">
				<div id="graph-1"></div>
				<div id="graph-2"></div>
			</div>
			<div class="small-graph">
				<div id="graph-3"></div>
			</div>
		</div>
	</div>

	<div class="activity">
		<div class="title">
			<i class="ph-bold ph-clock"></i>
			<span class="text">Ocorrências não dispensadas Recentes</span>
		</div>

		<div class="activity-data" id="lista_ocorrencias">
			<div class="data address">
				<span class="data-title">Endereço</span>
			</div>
			<div class="data names">
				<span class="data-title">Técnico</span>
			</div>
			<div class="data request">
				<span class="data-title">Data</span>
			</div>
			<div class="data status">
				<span class="data-title">Status</span>
			</div>
			<div class="data ver">
				<span class="data-title">Ver</span>
			</div>
		</div>
	</div>
</div>
</div>

<?php
  echoError();
?>
<script type="text/javascript">
	function requestFromAction(action, onSuccess = function (r) { }, onError = function (r) { }, data = {}, method) {
		fetch(action, {
			"method": method,
			"headers": { "Content-Type": "application/json" },
			"body": JSON.stringify(data)
		}).then(
			onSuccess, onError
		);
	}

	/*
	navigator.serviceWorker.register("sw.js");

	function enableNotif() {
		Notification.requestPermission().then((permission) => {
			if (permission === 'granted') {
				navigator.serviceWorker.ready.then((sw) => {
					sw.pushManager.subscribe({
						userVisibleOnly: true,
						applicationServerKey: ""
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
				//console.log('deu erro')
			}, JSON.parse(subscription), "POST")
	}
	*/
	
	function goToAction(action, values={}){
		let form = document.createElement('form');
		form.method = 'post';
		form.action = action;
		let submit = document.createElement('input');
		submit.type = 'submit';
		form.appendChild(submit);
		for (let name in values) {
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
	      	
	      	for (let i=0; i<json.entries.length; i++){
	      		let oe = json.entries[i]; // Entrada de ocorrência
	      		if (oe.encerrado && !oe.aprovado){
	      			continue;
	      		}
	      		
		      	content_endereco += '<span class="data-list">'+oe.rua+' - '+oe.numero+' ('+oe.bairro+')</span>';
		      	content_tecnico += '<span class="data-list">'+(oe.tecnico==null?"-Não atribuído-":oe.tecnico)+'</span>';
		      	content_data += '<span class="data-list">'+oe.data+'</span>';
		      	content_status += '<span class="data-list">'+(oe.encerrado? oe.aprovado? oe.relatorio_id==null? 'Pendente': 'Relatado': 'Desaprovado': 'Em Aberto')+'</span>';
		      	content_ver += '<span class="data-list" onclick="location = \'../ocorrencias/ocorrencias.php?id=\'+'+oe.id+';"><i class="ph-bold ph-eye"></i></span>';
	      	}
	      	content_endereco += '</div>';
	      	content_tecnico += '</div>';
	      	content_data += '</div>';
	      	content_status += '</div>';
	      	content_ver += '</div>';
			lista_ocorrencias.innerHTML = content_endereco+content_tecnico+content_data+content_status+content_ver;
	      });
	    }, function(){}, {"text": "", "recente": 5, "tipo": 0x01|0x04, "entries": 5}, "PUT");
	}
	refreshOcorrencias();
	
	// Rebuscar estatísticas
	function refreshStatistics() {
		requestFromAction("../../actions/fetch/get_ocorrencia_estatisticas.php", function(r){
	      r.json().then(function(json){
	      	//console.log(json);
	      	
	      	let ranges = json.ranges;
	      	let ocorrencia_bairro_graph = {
				colors: ['#38BDF8', '#E879F9', '#FF3980', '#38BE28', '#E80399', '#ee1980'],
				chart: {
					type: 'column',
				},
				title: {
					text: 'Ocorrências - Bairros',
				},
				xAxis: {
					categories: [],
					crosshair: true,
				},
				tooltip: {
					headerFormat: '<span style="font-size:14px">{point.key}</span><table>',
					pointFormat:
						'<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						'<td style="padding:0"><b>{point.y}</b></td></tr>',
					footerFormat: '</table>',
					shared: true,
					useHTML: true,
				},
				plotOptions: {
					column: {
						pointPadding: 0.2,
						borderWidth: 0,
					},
				},
				series: [],
			};
			const MAX_PERIODS = 4;
			let bairros = {};
	      	for (let i=0; i<MAX_PERIODS; i++){
	      		ocorrencia_bairro_graph.xAxis.categories[MAX_PERIODS-i-1] = ranges[i].data;
	      		for (bairro in ranges[i].rank){
	      			if (typeof bairros[bairro] === 'undefined'){
	      				bairros[bairro] = (new Array(MAX_PERIODS)).fill(null);
	      				ocorrencia_bairro_graph.series.push({
	      					"name": bairro,
	      					"data": bairros[bairro]
	      				});
	      			}
	      			bairros[bairro][MAX_PERIODS-i-1] = ranges[i].rank[bairro].total;
	      		}
	      	}
	      	Highcharts.chart('graph-1', ocorrencia_bairro_graph);
			
			// Gráfico 2 (Small Graph)
			let aprovacao_ratio = (json.aprovados/((json.aprovados+json.desaprovados)||1))*100;
			Highcharts.chart('graph-2', {
			  colors: ['#38BDF8', '#E879F9'],
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie',
				},
				title: {
					text: '',
					align: 'left',
				},
				tooltip: {
					pointFormat: '<span style="font-size:12px">{series.name}: <b>{point.percentage:.1f}%</b></span>',
				},
				accessibility: {
					point: {
						valueSuffix: '%',
					},
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: false,
						},
						showInLegend: true,
					},
				},
				series: [
					{
						name: 'Porcentagem',
						colorByPoint: true,
						data: [
							{
								name: 'Aprovadas',
								y: aprovacao_ratio,
								sliced: true,
								selected: true,
							},
							{
								name: 'Desaprovadas',
								y: 100-aprovacao_ratio,
							},
						],
					},
				],
			});

			// Gráfico 3 (Small Graph)
			let interdicao_ratio = (json.interditados/((json.interditados+json.nao_interditados)||1))*100;
			Highcharts.chart('graph-3', {
			  colors: ['#38BDF8', '#E879F9'],
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie',
				},
				title: {
					text: 'Casas - Interditadas/Não Interditadas',
					align: 'center',
				},
				tooltip: {
					pointFormat: '<span style="font-size:12px">{series.name}: <b>{point.percentage:.1f}%</b></span>',
				},
				accessibility: {
					point: {
						valueSuffix: '%',
					},
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: false,
						},
						showInLegend: true,
					},
				},
				series: [
					{
						name: 'Porcentagem',
						colorByPoint: true,
						data: [
							{
								name: 'Interdidado',
								y: interdicao_ratio,
								sliced: true,
								selected: true,
							},
							{
								name: 'Não Interditado',
								y: 100-interdicao_ratio,
							},
						],
					},
				],
			});
			
			countOcorrencias.textContent = json.ocorrencias_abertas;
			countRelatorios.textContent = json.relatorios;
	      });
	    }, function(){}, {"rank": 3}, "POST");
	}
	refreshStatistics();
	
	let update = setInterval(function(){
		refreshStatistics();
		refreshOcorrencias();
	}, 30 * 1000);
</script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
</main>

</html>