// Gráfico 1 (Big Graph)
Highcharts.chart('graph-1', {
	colors: ['#38BDF8', '#E879F9'],
	chart: {
		type: 'column',
	},
	title: {
		text: 'Ocorrências - Aprovadas/Desaprovadas',
	},
	xAxis: {
		categories: ['20/05', '21/05', '22/05', '23/05'],
		crosshair: true,
	},
	tooltip: {
		headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
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
			name: 'Aprovadas',
			data: [50, 72, 107, 130],
		},
		{
			name: 'Desaprovadas',
			data: [83, 78, 98, 93],
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
