<!DOCTYPE html>

<head>
	<link rel="stylesheet" href="./styles.css" />
	<title>Defesa Civil - Níveis</title>
</head>

<?php
	require '../../partials/header/header.php';
?>
<div class="wrapper-main">
	<section class="wrapper" id="container">
		<div id="main-graph"></div>
	</section>
</div>
</main>

<?php
  echoError();
?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
	
	function requestFromAction(action, onSuccess=function(r){}, onError=function(r){}, data={}){
		fetch(action, {
			"method": "PUT",
			"headers": {"Content-Type": "application/json"},
			"body": JSON.stringify(data)
		}).then(
			onSuccess, onError
		);
	}
	// Procura por ocorrencias
	function searchOcorrencias(text) {
		requestFromAction("../../actions/fetch/search_niveis_fluviometro.php", function(r){
	      r.json().then(function(json){

					let grafico_geral = {
						colors: ['#38BDF8', '#E879F9', '#FF3980', '#38BE28', '#E80399', '#ee1980'],
						chart: {
							type: 'column',
						},
						title: {
							text: 'Nível do Rio por Região',
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
						series: []
					};

					for(let k = 0; k < json[0].registros.length; k++) {
						grafico_geral.xAxis.categories.push(`${json[0].registros[k].data}  ${json[0].registros[k].hora}`);
					}

	      	for (let i=0; i<json.length; i++){
						let oe = json[i]; // Entrada de rio

						let registros = [];

						oe.registros.map((item) => {
							registros.push(item.nivel);
						});

						grafico_geral.series.push({
							name: `${oe.bairro} - ${oe.cidade}`,
							data: registros
						});

						let section = document.getElementById('container');
						let graph = document.createElement('div');
						graph.setAttribute('id', `graph-${i}`);
						section.appendChild(graph);

						let rio_grafico = {
							chart: {
								type: 'line'
							},
							title: {
								text: ''
							},
							xAxis: {
								categories: []
							},
							yAxis: {
								title: {
									text: 'Nível Rio (%)'
								}
							},
							plotOptions: {
								line: {
									dataLabels: {
										enabled: true
									},
									enableMouseTracking: false
								}
							},
							series: []
						};

						rio_grafico.title.text = `${oe.cidade} - ${oe.bairro} - ${oe.rua}`;

						for(let j = 0; j < oe.registros.length; j++) {
							rio_grafico.xAxis.categories.push(`${oe.registros[j].data}  ${oe.registros[j].hora}`);

							let registerExist = rio_grafico.series.findIndex((item) => item.name === `${oe.cidade} - ${oe.bairro} - ${oe.rua}`);
							
							if(registerExist !== -1) {
								rio_grafico.series[registerExist].data.push(oe.registros[j].nivel);
							} else {
								rio_grafico.series.push({
									name: `${oe.cidade} - ${oe.bairro} - ${oe.rua}`,
									data: [oe.registros[j].nivel]
								});
							}
						}

						Highcharts.chart(`graph-${i}`, rio_grafico);
					}

					Highcharts.chart(`main-graph`, grafico_geral);
	      });
	    }, function(){}, {"text": text, "nivel": true});
	}
	searchOcorrencias("");
</script>
</html>