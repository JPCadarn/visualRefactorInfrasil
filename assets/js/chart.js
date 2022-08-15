let dadosGrafico = [];
$.ajax({
	type: 'GET',
	url: 'src/action.php?action=getDadosDashboard&idCliente='+$('#idClienteSessao').val(),
	contentType: false,
	processData: false
}).done(function (resposta) {
	dadosGrafico = resposta.dadosGrafico;
	proximasInspecoes = resposta.proximasInspecoes;
	manutencoesPrioritarias = resposta.manutencoesPrioritarias;
});

const data = {
	labels: ['0-19', '20-39', '40-59', '60-79', '80-100'],
	datasets: [{
		label: 'Índice de Manutenção Prioritária',
		data: [dadosGrafico.countUm, dadosGrafico.countDois, dadosGrafico.countTres, dadosGrafico.countQuatro, dadosGrafico.countCinco],
		backgroundColor: [
			'#16f5f1',
			'#10de21',
			'#e1e810',
			'#e08610',
			'#ed2009'
		]
	}]
};

const config = {
    type: 'doughnut',
    data: data,
    options: {
		maintainAspectRatio: false
	}
};

const myChart = new Chart(
    document.getElementById('myChart'),
    config
);