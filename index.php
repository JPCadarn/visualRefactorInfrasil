<?php
	spl_autoload_register(function($class){
		require_once 'src\\'.$class.'.php';
	});

	use Services\SessionService;

	if(empty(SessionService::getIdUsuarioLogado())){
		header('Location: login.php');
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<link type="text/css" rel="stylesheet" href="assets/css/index.css"/>
		<meta charset="UTF-8">

		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  	</head>

  	<body>
		<div class="row">
			<div class="col s2 m2">
				<ul id="slide-out" class="sidenav sidenav-fixed">
					<li>
						<div class="image-sidenav">
							<img class="responsive-img" src="assets/images/logo.png">
						</div>
					</li>
					<li>
						<a class="waves-effect triggerModal" data-action="listarPontes"><i class="material-icons">location_city</i>Pontes</a>
					</li>
					<li>
						<a class="waves-effect triggerModal" data-action="listarAgendamentos"><i class="material-icons">event</i>Agendamentos</a>
					</li>
					<li>
						<a class="waves-effect triggerModal" data-action="listarInspecoes"><i class="material-icons">assessment</i>Inspeções</a>
					</li>
					<li><div class="divider"></div></li>
					<li>
						<a class="waves-effect triggerModal" data-action="listarUsuarios"><i class="material-icons">people</i>Usuários</a>
					</li>
					<li>
						<a class="waves-effect triggerModal" data-action="listarClientes"><i class="material-icons">business_center</i>Clientes</a>
					</li>
					<li>
						<a class="waves-effect triggerModal" data-action="listarConta"><i class="material-icons">settings</i>Minha Conta</a>
					</li>
				</ul>
			</div>
			<div class="col s12 m10">
				<div class="col s12 m4">
					<ul class="collapsible popout">
						<li class="active">
							<div class="collapsible-header"><i class="material-icons">event</i>Próximas Inspeções</div>
							<div class="collapsible-body">
								<table class="striped centered">
									<thead>
									  <tr>
										  <th>ID</th>
										  <th>Estrutura</th>
										  <th>Data</th>
										  <th>Visualizar</th>
									  </tr>
									</thead>
									<tbody>
									  <tr>
										<td>1</td>
										<td>Ponte Linha Corticeira</td>
										<td>01/01/2023</td>
										<td><i class="material-icons tooltipped yellow-text text-darken-3" data-position="right" data-tooltip="Visualizar informações">info</i></td>
									  </tr>
									  <tr>
										<td>1</td>
										<td>Ponte Linha Corticeira</td>
										<td>01/01/2023</td>
										<td><i class="material-icons tooltipped yellow-text text-darken-3" data-position="right" data-tooltip="Visualizar informações">info</i></td>
									  </tr>
									  <tr>
										<td>1</td>
										<td>Ponte Linha Corticeira</td>
										<td>01/01/2023</td>
										<td><i class="material-icons tooltipped yellow-text text-darken-3" data-position="right" data-tooltip="Visualizar informações">info</i></td>
									  </tr>
									</tbody>
								  </table>
							</div>
						</li>
					</ul>
				</div>
				<div class="col s12 m4">
					<ul class="collapsible popout">
						<li class="active">
							<div class="collapsible-header"><i class="material-icons">event</i>Rankeamento de Manutenção Prioritária</div>
							<div class="collapsible-body">
								<table class="striped centered">
									<thead>
									  <tr>
										  <th>ID</th>
										  <th>Estrutura</th>
										  <th>Nota</th>
										  <th>Visualizar</th>
									  </tr>
									</thead>
									<tbody>
									  <tr>
										<td>1</td>
										<td>Ponte Linha Corticeira</td>
										<td>32.7</td>
										<td><i class="material-icons tooltipped yellow-text text-darken-3" data-position="right" data-tooltip="Visualizar informações">info</i></td>
									  </tr>
									  <tr>
										<td>1</td>
										<td>Ponte Linha Corticeira</td>
										<td>26.7</td>
										<td><i class="material-icons tooltipped yellow-text text-darken-3" data-position="right" data-tooltip="Visualizar informações">info</i></td>
									  </tr>
									  <tr>
										<td>1</td>
										<td>Ponte Linha Corticeira</td>
										<td>18.6</td>
										<td><i class="material-icons tooltipped yellow-text text-darken-3" data-position="right" data-tooltip="Visualizar informações">info</i></td>
									  </tr>
									</tbody>
								  </table>
							</div>
						</li>
					</ul>
				</div>
				<div class="col s12 m4">
					<ul class="collapsible popout">
						<li class="active">
							<div class="collapsible-header"><i class="material-icons">filter_drama</i>Estado das OAE's</div>
							<div class="collapsible-body"><canvas id="myChart"></canvas></div>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="div-modal">

		</div>
	
	<!--JavaScript at end of body for optimized loading-->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script type="text/javascript" src="assets/js/index.js"></script>
	<script type="text/javascript" src="assets/js/chart.js"></script>
	<script type="text/javascript" src="assets/js/ajax.js"></script>
</body>
</html>