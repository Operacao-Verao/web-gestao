// Gráfico 1 (Big Graph)
Highcharts.chart('graph-1', {
	colors: ['#38BDF8', '#E879F9', '#FF3980', '#38BE28', '#E80399', '#ee1980'],
	chart: {
		type: 'column',
	},
	title: {
		text: 'Ocorrências - Bairros',
	},
	xAxis: {
		categories: ['20/05', '25/05', '01/06'],
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
	series: [
		{
			name: 'Vila Humbelinda',
			data: [50 , 60, 80],
		},
		{
			name: 'Vila Santista',
			data: [83 , 60, 80],
		},
		{
			name: 'Jd União',
			data: [50 , 60, 80],
		},
	],
});
// Gráfico 2 (Small Graph)
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
					y: 45,
					sliced: true,
					selected: true,
				},
				{
					name: 'Desaprovadas',
					y: 55,
				},
			],
		},
	],
});

// Gráfico 3 (Small Graph)
Highcharts.chart('graph-3', {
  colors: ['#38BDF8', '#E879F9'],
	chart: {
		plotBackgroundColor: null,
		plotBorderWidth: null,
		plotShadow: false,
		type: 'pie',
	},
	title: {
		text: 'Relatórios - Interditados/Não Interditados',
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
					y: 45,
					sliced: true,
					selected: true,
				},
				{
					name: 'Não Interditado',
					y: 55,
				},
			],
		},
	],
});
