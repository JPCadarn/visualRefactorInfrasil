<?php

use Utils\HtmlUtils;

require_once('conexao.php');
	require_once('utils.php');
	require_once('InspecaoService.php');
	require_once('SessionService.php');
	SessionService::validarLoginFeito();
	$conexao = new Conexao();
	echo '<!DOCTYPE html>';
	HtmlUtils::tagHead();
	echo '<body>';
	HtmlUtils::navBar();

	$inspecoes = $conexao->executarQuery('
		SELECT 
			pontes.id, 
			pontes.nome AS ponte_nome, 
			inspecoes.nome, 
			inspecoes.descricao, 
			inspecoes.id AS id_inspecao, 
			inspecoes.status, 
			inspecoes.data_inspecao, 
			inspecoes.tipo_inspecao 
		FROM pontes 
		INNER JOIN inspecoes ON pontes.id = inspecoes.ponte_id 
		LEFT JOIN usuarios ON pontes.id_usuario = usuarios.id 
		LEFT JOIN clientes ON usuarios.id_cliente = clientes.id
		WHERE clientes.id = '.SessionService::getIdCliente());
	$inspecoesAgrupadas = HtmlUtils::agruparArrayPorChave($inspecoes, 'id');
	
	if(count($inspecoes)){
		echo "<div class='container'>";
			foreach($inspecoesAgrupadas as $groupInspecao){
				echo "<ul class='collapsible expandable popout'>";
					echo "<li>";
						echo "<div class='collapsible-header'>".$groupInspecao[0]['ponte_nome']." - ".$groupInspecao[0]['id']."</div>";
						echo "<div class='collapsible-body'>"; 
						InspecaoService::renderCardsInspecaoGroup($groupInspecao);
						echo "</div>";
					echo "</li>";
				echo "</ul>";
			}
		echo "</div>";
	}else{
		echo "<h6 class='centralizar'>Nenhuma inspeção cadastrada";
	}
?>
	<div id="modalAvaliar" class="modal">
		<br>
		<br>
		<div class="modal-title">
			<h4 class="center">Avaliar Inspeção</h4>
		</div>
		<div id="formCadastro" class="modal-content">
			<div class="row">
				<form id="formulario" action="novaInspecao.php" method="POST" class="col s12" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" value="" name="id_inspecao" id="id_inspecao">
					<input type="hidden" value="Avaliado" name="status" id="status">
					<ul class="collapsible expandable popout">
						<li class="active">
							<div class="collapsible-header"><i class="material-icons">grade</i>Notas</div>
							<div class="collapsible-body">
								<?php
									HtmlUtils::renderSelect('nota_indice_localizacao', InspecaoService::camposIndiceLocalizacao, 'Índice de Localização', 'Índice de Localização', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_indice_volume_trafego', Constants::camposVolumeTrafego, 'Índice de Volume de Tráfego', 'Índice de Volume de Tráfego', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_indice_largura_oae', Constants::camposLarguraOAE, 'Índice de Largura da OAE', 'Índice de Largura da OAE', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_geometria_condicoes', Constants::camposFsPesoAlto, 'Geometria e condições várias', 'Geometria e condições várias', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_acessos', Constants::camposFsPesoMedio, 'Acessos', 'Acessos', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_cursos_agua', Constants::camposFsPesoMedio, 'Cursos d\'água', 'Cursos d\'água', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_encontros_fundacoes', Constants::camposFsPesoAlto, 'Encontros e fundações', 'Encontros e fundações', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_apoios_intermediarios', Constants::camposFsPesoAlto, 'Apoios intermediários', 'Apoios intermediários', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_aparelhos_apoio', Constants::camposFsPesoAlto, 'Aparelhos de apoio', 'Aparelhos de apoio', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_superestrutura', Constants::camposFsPesoAlto, 'Superestrutura', 'Superestrutura', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_pista_rolamento', Constants::camposFsPesoMedio, 'Pista de rolamento', 'Pista de rolamento', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_juntas_dilatacao', Constants::camposFsPesoMedio, 'Juntas de dilatação', 'Juntas de dilatação', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_barreiras_guardacorpos', Constants::camposFsPesoBaixo, 'Barreiras e guarda-corpos', 'Barreiras e guarda-corpos', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_sinalizacao', Constants::camposFsPesoBaixo, 'Sinalização', 'Sinalização', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_instalacoes_util_publica', Constants::camposFsPesoBaixo, 'Instalações de utilidade pública', 'Instalações de utilidade pública', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_largura_plataforma', Constants::camposFcLargura, 'Largura da plataforma', 'Largura da plataforma', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_capacidade_carga', Constants::camposFcCarga, 'Capacidade de carga', 'Capacidade de carga', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_superficie_plataforma', Constants::camposFcSuperficie, 'Superfície da plataforma', 'Superfície da plataforma', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_pista_rolamento_fc', Constants::camposFcPistaRolamento, 'Pista de rolamento', 'Pista de rolamento', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_outros_fc', Constants::camposFcOutros, 'Outros', 'Outros', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_espaco_livre', Constants::camposFiEspacoLivre, 'Espaço livre', 'Espaço livre', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_localizacao_ponte', Constants::camposFiLocal, 'Localização da Ponte', 'Localização da Ponte', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_saude_fisica_ponte', Constants::camposFiSaude, 'Saúde física da ponte', 'Saúde física da ponte', 'descricao', 'nota');
									HtmlUtils::renderSelect('nota_outros_fi', Constants::camposFiOutros, 'Outros', 'Outros', 'descricao', 'nota');
								?>
								<div class="row">
									<div class="input-field col s12">
										<textarea class="materialize-textarea" id="obs" name="obs" type="text"></textarea>
										<label for="obs">Resumo</label>
									</div>
								</div>
							</div>
						</li>
					</ul>
					<button class="indigo darken-4  waves-effect waves-circle waves-light btn-floating btn-large float-right" type="submit" value="Create">
						<i class="large material-icons">check</i>
					</button>
				</form>
			</div>
		</div>
	</div>

		<!--JavaScript at end of body for optimized loading-->
		<script type="text/javascript" src="assets/js/jquery-3.4.1.js"></script>
		<script type="text/javascript" src="assets/materialize/js/materialize.min.js"></script>
		<script type="text/javascript" src="assets/js/main.js"></script>
		<script type="text/javascript" src="assets/js/inspecoes.js"></script>
	</body>
</html>