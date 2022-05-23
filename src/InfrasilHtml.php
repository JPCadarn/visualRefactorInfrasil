<?php

class InfrasilHtml {
    public static function montarGridPontes($pontes, $numeroModal)
    {
        $idModal = 'modal'.$numeroModal;

        $html = "<div id='$idModal' class='modal center-align'>";
		$html .= "<div class='modal-header centered'>";
		$html .= "<h4 class='left'>Estruturas Cadastradas</h4>";
		$html .= "<h4 class='right modal-close'><i class='material-icons'>close</i></h4>";
		$html .= "</div>";
        $html .= "<div class='modal-content'>";

        $corpo = '';

        foreach ($pontes as $ponte){
            $corpo .= '
                <tr>
                    <th>'.$ponte['id'].'</th>
                    <th>'.$ponte['nome'].'</th>
                    <th>'.Utils::formatarData($ponte['data_construcao'], 'd/m/Y').'</th>
                    <th>
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Detalhes" data-position="bottom" data-action="detalhesPonte"><i class="material-icons yellow-text text-darken-3">info</i></a>
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Imprimir Relatório" data-position="bottom" data-action="formularioAgendamento"><i class="material-icons yellow-text text-darken-3">print</i></a>
					</th>
                </tr>
            ';
        }

        $html .= '
            <table class="highlight responsive-table">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Data de Construção</th>
                      <th>Ações</th>
                    </tr>
                </thead>
                
                <tbody>
                    '.$corpo.'
                </tbody>
            </table>';

        $html .= "</div>";
        $html .= "<div class='modal-footer'>";
        $html .= "<a href='#!' class='modal-close waves-effect waves-green btn-floating triggerModal tooltipped' data-action='formularioPonte' data-position='bottom' data-tooltip='Cadastrar estrutura'><i class='material-icons'>add</i></a>";
        $html .= "</div>";
        $html .= "</div>";

		return [
            'html' => $html,
            'idModal' => $idModal
        ];
	}

	public static function montarGridAgendamentos($agendamentos, $numeroModal)
	{
		$idModal = 'modal'.$numeroModal;

		$html = "<div id='$idModal' class='modal center-align'>";
		$html .= "<div class='modal-header centered'>";
		$html .= "<h4 class='left'>Agendamentos</h4>";
		$html .= "<h4 class='right modal-close'><i class='material-icons'>close</i></h4>";
		$html .= "</div>";
		$html .= "<div class='modal-content'>";

		$corpo = '';

		foreach ($agendamentos as $agendamento){
			$corpo .= '
                <tr>
                    <th>'.$agendamento['id'].'</th>
                    <th>'.$agendamento['ponte_nome'].'</th>
                    <th>'.Utils::formatarData($agendamento['data'], 'd/m/Y').'</th>
                    <th>'.$agendamento['horario'].'</th>
                    <th>
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Detalhes" data-position="bottom" data-action="detalhesAgendamento"><i class="material-icons yellow-text text-darken-3">info</i></a>
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Editar Agendamento" data-position="bottom" data-action="editarAgendamento"><i class="material-icons yellow-text text-darken-3">edit</i></a>
					</th>
                </tr>
            ';
		}

		$html .= '
            <table class="highlight responsive-table">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>Ponte</th>
                      <th>Data</th>
                      <th>Horário</th>
                      <th>Ações</th>
                    </tr>
                </thead>
                
                <tbody>
                    '.$corpo.'
                </tbody>
            </table>';

		$html .= "</div>";
		$html .= "<div class='modal-footer'>";
		$html .= "<a href='#!' class='modal-close waves-effect waves-green btn'>Fechar</a>";
		$html .= "</div>";
		$html .= "</div>";

		return [
			'html' => $html,
			'idModal' => $idModal
		];
	}

	public static function montarGridInspecoes($inspecoes, $numeroModal)
	{
		$idModal = 'modal'.$numeroModal;

		$html = "<div id='$idModal' class='modal center-align'>";
		$html .= "<div class='modal-header centered'>";
		$html .= "<h4 class='left'>Inspeções</h4>";
		$html .= "<h4 class='right modal-close'><i class='material-icons'>close</i></h4>";
		$html .= "</div>";
		$html .= "<div class='modal-content'>";

		$corpo = '';

		foreach ($inspecoes as $inspecao){
			$corpo .= '
                <tr>
                    <th>'.$inspecao['id_inspecao'].'</th>
                    <th>'.$inspecao['ponte_nome'].'</th>
                    <th>'.Utils::formatarData($inspecao['data_inspecao'], 'd/m/Y').'</th>
                    <th>'.$inspecao['tipo_inspecao'].'</th>
                    <th>'.$inspecao['status'].'</th>
                    <th>
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Detalhes" data-position="bottom" data-action="detalhesInspecao"><i class="triggerModal material-icons yellow-text text-darken-3">info</i></a>
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Editar Inspeção" data-position="bottom" data-action="editarInspecao"><i class="material-icons yellow-text text-darken-3">edit</i></a>
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Avaliar" data-position="bottom" data-action="detalhesAgendamento"><i class="material-icons yellow-text text-darken-3">thumbs_up_down</i></a>
					</th>
                </tr>
            ';
		}

		$html .= '
            <table class="highlight responsive-table">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>Ponte</th>
                      <th>Data</th>
                      <th>Tipo</th>
                      <th>Status</th>
                      <th>Ações</th>
                    </tr>
                </thead>
                
                <tbody>
                    '.$corpo.'
                </tbody>
            </table>';

		$html .= "</div>";
		$html .= "<div class='modal-footer'>";
		$html .= "<a href='#!' class='modal-close waves-effect waves-green btn'>Fechar</a>";
		$html .= "</div>";
		$html .= "</div>";

		return [
			'html' => $html,
			'idModal' => $idModal
		];
	}

	public static function montarGridUsuarios($usuarios, $numeroModal)
	{
		$idModal = 'modal'.$numeroModal;

		$html = "<div id='$idModal' class='modal center-align'>";
		$html .= "<div class='modal-header centered'>";
		$html .= "<h4 class='left'>Usuários</h4>";
		$html .= "<h4 class='right modal-close'><i class='material-icons'>close</i></h4>";
		$html .= "</div>";
		$html .= "<div class='modal-content'>";

		$corpo = '';

		foreach ($usuarios as $usuario){
			$corpo .= '
                <tr>
                    <th>'.$usuario['id'].'</th>
                    <th>'.$usuario['nome'].'</th>
                    <th>'.$usuario['email'].'</th>
                    <th>'.$usuario['tipo'].'</th>
                    <th>
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Detalhes" data-position="bottom" data-action="detalhesUsuario"><i class="material-icons yellow-text text-darken-3">info</i></a>
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Editar Usuário" data-position="bottom" data-action="editarUsuario"><i class="material-icons yellow-text text-darken-3">edit</i></a>
					</th>
                </tr>
            ';
		}

		$html .= '
            <table class="highlight responsive-table">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Email</th>
                      <th>Tipo</th>
                      <th>Ações</th>
                    </tr>
                </thead>
                
                <tbody>
                    '.$corpo.'
                </tbody>
            </table>';

		$html .= "</div>";
		$html .= "<div class='modal-footer'>";
		$html .= "<a href='#!' class='modal-close waves-effect waves-green btn'>Fechar</a>";
		$html .= "</div>";
		$html .= "</div>";

		return [
			'html' => $html,
			'idModal' => $idModal
		];
	}

	public static function montarGridClientes($clientes, $numeroModal)
	{
		$idModal = 'modal'.$numeroModal;

		$html = "<div id='$idModal' class='modal center-align'>";
		$html .= "<div class='modal-header centered'>";
		$html .= "<h4 class='left'>Inspeções</h4>";
		$html .= "<h4 class='right modal-close'><i class='material-icons'>close</i></h4>";
		$html .= "</div>";
		$html .= "<div class='modal-content'>";

		$corpo = '';

		foreach ($clientes as $cliente){
			$corpo .= '
                <tr>
                    <th>'.$cliente['id'].'</th>
                    <th>'.$cliente['nome'].'</th>
                    <th>'.$cliente['email'].'</th>
                    <th>'.Utils::formatarData($cliente['data_nascimento'], 'd/m/Y').'</th>
                    <th>'.Utils::formataCpfCnpj($cliente['cpf_cnpj']).'</th>
                    <th>
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Detalhes" data-position="bottom" data-action="detalhesCliente"><i class="material-icons yellow-text text-darken-3">info</i></a>
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Editar Usuário" data-position="bottom" data-action="alterarCliente"><i class="material-icons yellow-text text-darken-3">edit</i></a>
					</th>
                </tr>
            ';
		}

		$html .= '
            <table class="highlight responsive-table">
                <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Email</th>
                      <th>Data de Nascimento</th>
                      <th>CPF/CNPJ</th>
                      <th>Ações</th>
                    </tr>
                </thead>
                
                <tbody>
                    '.$corpo.'
                </tbody>
            </table>';

		$html .= "</div>";
		$html .= "<div class='modal-footer'>";
		$html .= "<a href='#!' class='modal-close waves-effect waves-green btn'>Fechar</a>";
		$html .= "</div>";
		$html .= "</div>";

		return [
			'html' => $html,
			'idModal' => $idModal
		];
	}

	public static function montarFormPontes($numeroModal)
	{
		$idModal = 'modal'.$numeroModal;

		$html = "
			<div id='$idModal' class='modal center-align'>
				<div class='modal-header centered'>
					<h4 class='left'>Ficha de Inspeção Cadastral</h4>
					<h4 class='right modal-close'><i class='material-icons'>close</i></h4>
				</div>
				<div class='row'>
				<form action='action.php' id='formCadastroOAE' method='POST' class='col s12' enctype='multipart/form-data' autocomplete='off'>
					<div class='modal-content'>
						<div class='row'>
							<ul class='collapsible expandable popout'>
								<li class='active'>
									<div class='collapsible-header'><i class='material-icons'>location_on</i>Identicação e Localização</div>
									<div class='collapsible-body'>
										<div class='row'>
											<div class='input-field col s12 m6'>
												<input id='via' name='via' type='text'  data-error='wrong'>
												<label for='via'>Via ou Municipio</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='nome' name='nome' type='text' >
												<label for='nome'>Nome da OAE</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='data_construcao' name='data_construcao' class='mask-date' type='text'>
												<label for='data_construcao'>Data de Inauguração</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='trem_tipo' name='trem_tipo' type='text'>
												<label for='trem_tipo'>Trem-Tipo</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='sentido' name='sentido' type='text'>
												<label for='sentido'>Sentido</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='localizacao' name='localizacao' type='text'>
												<label for='localizacao'>Localização</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='latitude' name='latitude' type='text' class='mask-coord validate'  pattern='\d\dº\s\d\d\&lsquo;\s\d\d&quot;\s[A-Z]'>
												<label for='latitude'>Latitude</label>
												<span class='helper-text' data-error='As coordenadas precisam seguir o padrão 00º 00' 00&quot; A'></span>
											</div>
											<div class='input-field col s12 m6'>
												<input id='longitude' name='longitude' type='text' class='mask-coord validate'  pattern='\d\dº\s\d\d\&lsquo;\s\d\d&quot;\s[A-Z]'>
												<label for='longitude'>Longitude</label>
												<span class='helper-text' data-error='As coordenadas precisam seguir o padrão 00º 00' 00&quot; A'></span>
											</div>
											<div class='input-field col s12 m6'>
												<input id='projetista' name='projetista' type='text'>
												<label for='projetista'>Projetista</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='construtor' name='construtor' type='text'>
												<label for='construtor'>Construtor</label>
											</div>
										</div>
									</div>
								</li>
								<li>
									<div class='collapsible-header'><i class='material-icons'>build</i>Características da Estrutura</div>
									<div class='collapsible-body'>
										<div class='row'>
											<div class='input-field col s12 m6'>
												<input id='comprimento_estrutura' name='comprimento_estrutura' class='mask-decimal' type='text'>
												<label for='comprimento_estrutura'>Comprimento (metros)</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='largura_estrutura' name='largura_estrutura' class='mask-decimal' type='text'>
												<label for='largura_estrutura'>Largura (metros)</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='largura_acostamento' name='largura_acostamento' class='mask-decimal' type='text'>
												<label for='largura_acostamento'>Largura do Acostamento (metros)</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='largura_refugio' name='largura_refugio' class='mask-decimal' type='text'>
												<label for='largura_refugio'>Largura do Refúgio (metros)</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='largura_passeio' name='largura_passeio' class='mask-decimal' type='text'>
												<label for='largura_passeio'>Largura do Passeio (metros)</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='sistema_construtivo' name='sistema_construtivo' type='text'>
												<label for='sistema_construtivo'>Sistema Construtivo (Tabela A.3 - NBR 9452)</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='natureza_transposicao' name='natureza_transposicao' type='text'>
												<label for='natureza_transposicao'>Natureza de Transposição (Tabela A.4 - NBR 9452)</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='material_construcao' name='material_construcao' type='text'>
												<label for='material_construcao'>Material (Tabela A.5 - NBR 9452)</label>
											</div>
											<h5 class='center'>Seção Tipo <i class='tiny material-icons tooltipped' data-position='bottom' data-tooltip='Favor anexar as imagens correspondentes na seção Imagens'>info</i></h5>
											<div class='input-field col s12 m6'>
												<input id='longitudinal_super' name='longitudinal_super' type='text'>
												<label for='longitudinal_super'>Longitudinal da superestrutura</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='transversal_super' name='transversal_super' type='text'>
												<label for='transversal_super'>Transversal da superestrutura</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='mesoestrutura_tipo' name='mesoestrutura_tipo' type='text'>
												<label for='mesoestrutura_tipo'>Mesoestrutura (Tabela A.2 - NBR 9452) </label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='infraestrutura' name='infraestrutura' type='text'>
												<label for='infraestrutura'>Infraestrutura (Tabela A.2 - NBR 9452)</label>
											</div>
											<h5 class='center'>Características Particulares</h5>
											<div class='input-field col s12 m6'>
												<input id='nro_vaos' name='nro_vaos' type='number'>
												<label for='nro_vaos'>Número de Vãos</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='nro_apoios' name='nro_apoios' type='number'>
												<label for='nro_apoios'>Número de Apoios</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='nro_pilares_apoio' name='nro_pilares_apoio' type='number'>
												<label for='nro_pilares_apoio'>Número de Pilares por Apoio</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='aparelhos_apoio' name='aparelhos_apoio' type='text'>
												<label for='aparelhos_apoio'>Aparelhos de Apoio</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='comprimento_vao_tipico' name='comprimento_vao_tipico' class='mask-decimal' type='text'>
												<label for='comprimento_vao_tipico'>Comprimento do vão típico (metros)</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='comprimento_maior_vao' name='comprimento_maior_vao' class='mask-decimal' type='text'>
												<label for='comprimento_maior_vao'>Comprimento do maior vão (metros)</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='altura_pilares' name='altura_pilares' class='mask-decimal' type='text'>
												<label for='altura_pilares'>Altura dos pilares (metros)</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='juntas_dilatacao' name='juntas_dilatacao' type='text'>
												<label for='juntas_dilatacao'>Juntas de dilatação</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='encontros' name='encontros' type='text'>
												<label for='encontros'>Encontros</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='descricao' name='descricao' type='text'>
												<label for='descricao'>Outras Características</label>
											</div>
										</div>
									</div>
								</li>
								<li>
									<div class='collapsible-header'><i class='material-icons'>landscape</i>Características Funcionais</div>
									<div class='collapsible-body'>
										<div class='row'>
											<div class='input-field col s12 m6'>
												<input id='caracteristicas_plani' name='caracteristicas_plani' type='text'>
												<label for='caracteristicas_plani'>Características plani-altimétricas</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='nro_faixas' name='nro_faixas' type='number'>
												<label for='nro_faixas'>Número de Faixas</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='acostamento' name='acostamento' type='text'>
												<label for='acostamento'>Acostamento</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='refugios' name='refugios' type='text'>
												<label for='refugios'>Refúgios</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='passeio' name='passeio' type='text'>
												<label for='passeio'>Passeio</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='barreira_rigida' name='barreira_rigida' type='text'>
												<label for='barreira_rigida'>Barreira rígida</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='material_pavimento' name='material_pavimento' type='text'>
												<label for='material_pavimento'>Material do pavimento</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='pingadeiras' name='pingadeiras' type='text'>
												<label for='pingadeiras'>Pingadeiras</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='guarda_corpo' name='guarda_corpo' type='text'>
												<label for='guarda_corpo'>Guarda-Corpo</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='drenos' name='drenos' type='text'>
												<label for='drenos'>Dreno</label>
											</div>
											<div class='input-field col s12'>
												<input id='freq_passagem_carga' name='freq_passagem_carga' type='text'>
												<label for='freq_passagem_carga'>Frequencia passagem carga especial</label>
											</div>
										</div>
									</div>
								</li>
								<li>
									<div class='collapsible-header'><i class='material-icons'>block</i>Registro de Anomalias</div>
									<div class='collapsible-body'>
										<div class='row'>
											<h5 class='center'>Elementos Estruturais</h5>
											<div class='input-field col s12'>
												<textarea class='materialize-textarea' id='superestrutura' name='superestrutura' type='text'></textarea>
												<label for='superestrutura'>Superestrutura</label>
											</div>
											<div class='input-field col s12'>
												<textarea class='materialize-textarea' id='mesoestrutura' name='mesoestrutura' type='text'></textarea>
												<label for='mesoestrutura'>Mesoestrutura (Tabela A.2 - NBR 9452)</label>
											</div>
											<div class='input-field col s12'>
												<textarea class='materialize-textarea' id='infraestrutura_anomalia' name='infraestrutura_anomalia' type='text'></textarea>
												<label for='infraestrutura_anomalia'>Infraestrutura</label>
											</div>
											<div class='input-field col s12'>
												<textarea class='materialize-textarea' id='aparelhos_apoio_anomalia' name='aparelhos_apoio_anomalia' type='text'></textarea>
												<label for='aparelhos_apoio_anomalia'>Aparelhos de apoio</label>
											</div>
											<div class='input-field col s12'>
												<textarea class='materialize-textarea' id='juntas_dilatacao_anomalia' name='juntas_dilatacao_anomalia' type='text'></textarea>
												<label for='juntas_dilatacao_anomalia'>Juntas de dilatação</label>
											</div>
											<div class='input-field col s12'>
												<textarea class='materialize-textarea' id='encontros_anomalia' name='encontros_anomalia' type='text'></textarea>
												<label for='encontros_anomalia'>Encontros</label>
											</div>
											<h5 class='center'>Elementos da pista ou funcionais</h5>
											<div class='input-field col s12 m6'>
												<input id='pavimento_anomalia' name='pavimento_anomalia' type='text'>
												<label for='pavimento_anomalia'>Pavimento</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='acostamento_refugio_anomalia' name='acostamento_refugio_anomalia' type='text'>
												<label for='acostamento_refugio_anomalia'>Acostamento e refúgio</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='drenagem_anomalia' name='drenagem_anomalia' type='text'>
												<label for='drenagem'>Drenagem</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='guarda_corpo_anomalia' name='guarda_corpo_anomalia' type='text'>
												<label for='guarda_corpo_anomalia'>Guarda-Corpo</label>
											</div>
											<div class='input-field col s12'>
												<input id='barreira_defesa' name='barreira_defesa' type='text'>
												<label for='barreira_defesa'>Barreiras concreto/defensa metálica</label>
											</div>
											<h5 class='center'>Outros Elementos</h5>
											<div class='input-field col s12 m6'>
												<input id='taludes' name='taludes' type='text'>
												<label for='taludes'>Taludes</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='iluminacao' name='iluminacao' type='text'>
												<label for='iluminacao'>Iluminação</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='sinalizacao' name='sinalizacao' type='text'>
												<label for='sinalizacao'>Sinalização</label>
											</div>
											<div class='input-field col s12 m6'>
												<input id='protecao_pilares' name='protecao_pilares' type='text'>
												<label for='protecao_pilares'>Proteção de pilares</label>
											</div>
										</div>
									</div>
								</li>
								<li>
									<div class='collapsible-header'><i class='material-icons'>photo_camera</i>Imagens</div>
									<div class='collapsible-body'>
										<div class='row'>
											<div class='file-field input-field'>
												<div class='btn indigo darken-4'>
													<span>Imagens</span>
													<input name='images[]'  type='file' multiple accept='image/*' aria-='true'>
												</div>
												<div class='file-path-wrapper'>
													<input class='file-path validate' type='text' placeholder='Anexe aqui as imagens da ponte'>
												</div>
											</div>
											<div class='input-field col s12'>
												<textarea class='materialize-textarea' id='resumo' name='resumo' type='text' ></textarea>
												<label for='resumo'>Resumo da situação e recomendações</label>
											</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class='modal-footer'>
						<a href='#!' class='modal-close waves-effect waves-green btn'>Fechar</a>
						<button class='btn waves-effect waves-light' type='submit' name='action'>Salvar
							<i class='material-icons right'>send</i>
						</button>
					</div>
				</form>
				</div>
			</div>";

		return [
			'html' => $html,
			'idModal' => $idModal
		];
	}
}

?>