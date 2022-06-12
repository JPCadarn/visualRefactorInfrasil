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
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Detalhes" data-position="bottom" data-action="detalhesPonte" data-id="'.$ponte['id'].'"><i class="material-icons yellow-text text-darken-3">info</i></a>
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Imprimir Relatório" data-position="bottom" data-action="formularioAgendamento" data-id="'.$ponte['id'].'"><i class="material-icons yellow-text text-darken-3">print</i></a>
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
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Detalhes" data-position="bottom" data-action="detalhesAgendamento" data-id="'.$agendamento['id'].'"><i class="material-icons yellow-text text-darken-3">info</i></a>
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Editar Agendamento" data-position="bottom" data-action="editarAgendamento" data-id="'.$agendamento['id'].'"><i class="material-icons yellow-text text-darken-3">edit</i></a>
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
		$html .= "<a href='#!' class='modal-close waves-effect waves-green btn-floating triggerModal tooltipped' data-action='formularioAgendamento' data-position='bottom' data-tooltip='Cadastrar agendamento'><i class='material-icons'>add</i></a>";
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
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Editar Inspeção" data-position="bottom" data-action="editarInspecao" data-id="'.$inspecao['id_inspecao'].'"><i class="material-icons yellow-text text-darken-3">edit</i></a>
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Avaliar" data-position="bottom" data-action="formularioAvaliacaoInspecao" data-id="'.$inspecao['id_inspecao'].'"><i class="material-icons yellow-text text-darken-3">thumbs_up_down</i></a>
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
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Editar Usuário" data-position="bottom" data-action="editarUsuario" data-id="'.$usuario['id'].'"><i class="material-icons yellow-text text-darken-3">edit</i></a>
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
		$html .= "<a href='#!' class='modal-close waves-effect waves-green btn-floating triggerModal tooltipped' data-action='formularioUsuario' data-position='bottom' data-tooltip='Cadastrar usuário'><i class='material-icons'>add</i></a>";
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
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Editar Usuário" data-position="bottom" data-action="alterarCliente" data-id="'.$cliente['id'].'"><i class="material-icons yellow-text text-darken-3">edit</i></a>
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
		$html .= "<a href='#!' class='modal-close waves-effect waves-green btn-floating triggerModal tooltipped' data-action='formularioCliente' data-position='bottom' data-tooltip='Cadastrar cliente'><i class='material-icons'>add</i></a>";
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

		$html = file_get_contents('Html/formCadastroOAE.html');
		$html = str_replace('REPLACE_ID_MODAL', $idModal, $html);

		return [
			'html' => $html,
			'idModal' => $idModal
		];
	}

    public static function montarFormAgendamentos($numeroModal, $pontes)
    {
        $idModal = 'modal'.$numeroModal;

		$selectPontes = "
			<div class='input-field col s12'>
				<select id='ponte_id' name='ponte_id'>
					<option value='' disabled selected>Selecione a OAE</option>";
		foreach($pontes as $ponte){
			$selectPontes .= '<option value='.$ponte['id'].'>'.$ponte['nome'].'</option>';
		}
		$selectPontes .= "
			</select>
			</div>
		";
		$selectTipoInspecao = "
			<div class='input-field col s12'>
				<select id='tipo_inspecao' name='tipo_inspecao'>
					<option value='' disabled selected>Selecione o tipo de inspeção</option>
					<option value='cadastral'>Cadastral</option>
					<option value='rotineira'>Rotineira</option>
					<option value='especial'>Especial</option>
					<option value='extraordinaria'>Extraordinária</option>
				</select>
			</div>
		";


        $html = file_get_contents('Html/formCadastroAgendamento.html');
        $html = str_replace('REPLACE_ID_MODAL', $idModal, $html);
        $html = str_replace('REPLACE_SELECT_PONTE', $selectPontes, $html);
        $html = str_replace('REPLACE_SELECT_TIPO_INSPECAO', $selectTipoInspecao, $html);

		return [
			'html' => $html,
			'idModal' => $idModal
		];
    }

	public static function montarFormAvaliacao($numeroModal, $idInspecao)
	{
		$idModal = 'modal'.$numeroModal;

		$html = file_get_contents('Html/formAvaliacaoInspecao.html');
        $html = str_replace('REPLACE_ID_MODAL', $idModal, $html);
        $html = str_replace('REPLACE_ID_INSPECAO', $idInspecao, $html);

		return [
			'html' => $html,
			'idModal' => $idModal
		];
	}

	public static function montarDetalhesOae($detalhes, $numeroModal)
	{
		$idModal = 'modal'.$numeroModal;

		$html = file_get_contents('Html/detalhesPonte.html');
		$replaces = [
			'REPLACE_ID_MODAL' => $idModal,
			'REPLACE_NOME_OAE' => $detalhes['dadosOae']['nome'],
			'REPLACE_VIA' => $detalhes['dadosOae']['via'],
			'REPLACE_MUNICIPIO' => $detalhes['dadosOae']['cidade'].', '.$detalhes['dadosOae']['estado'],
			'REPLACE_DATA_CONSTRUCAO' => $detalhes['dadosOae']['data_construcao'],
			'REPLACE_TREM_TIPO' => $detalhes['dadosOae']['trem_tipo'],
			'REPLACE_SENTIDO' => $detalhes['dadosOae']['sentido'],
			'REPLACE_LOCALIZACAO' => $detalhes['dadosOae']['localizacao'],
			'REPLACE_COORDENADAS' => $detalhes['dadosOae']['latitude'].' '.$detalhes['dadosOae']['longitude'],
			'REPLACE_PROJETISTA' => $detalhes['dadosOae']['projetista'],
			'REPLACE_CONSTRUTOR' => $detalhes['dadosOae']['construtor'],
			'REPLACE_COMPRIMENTO_TOTAL' => $detalhes['dadosOae']['comprimento_estrutura'],
			'REPLACE_LARGURA_FAIXA' => $detalhes['dadosOae']['largura_estrutura'],
			'REPLACE_LARGURA_ACOSTAMENTO' => $detalhes['dadosOae']['largura_acostamento'],
			'REPLACE_LARGURA_REFUGIO' => $detalhes['dadosOae']['largura_refugio'],
			'REPLACE_LARGURA_PASSEIO' => $detalhes['dadosOae']['largura_passeio'],
			'REPLACE_SIS_CONST' => $detalhes['dadosOae']['sistema_construtivo'],
			'REPLACE_TRANSPOSICAO' => $detalhes['dadosOae']['natureza_transposicao'],
			'REPLACE_MATERIAL' => $detalhes['dadosOae']['material_construcao'],
			'REPLACE_LONG_SUPER' => $detalhes['dadosOae']['longitudinal_super'],
			'REPLACE_TRANS_SUPER' => $detalhes['dadosOae']['transversal_super'],
			'REPLACE_MESO' => $detalhes['dadosOae']['mesoestrutura_tipo'],
			'REPLACE_NRO_VAOS' => $detalhes['dadosOae']['nro_vaos'],
			'REPLACE_NRO_APOIOS' => $detalhes['dadosOae']['nro_apoios'],
			'REPLACE_PILAR_APOIO' => $detalhes['dadosOae']['nro_pilares_apoio'],
			'REPLACE_APARELHOS_APOIO' => $detalhes['dadosOae']['aparelhos_apoio'],
			'REPLACE_VAO_TIPICO' => $detalhes['dadosOae']['comprimento_vao_tipico'],
			'REPLACE_MAIOR_VAO' => $detalhes['dadosOae']['comprimento_maior_vao'],
			'REPLACE_ALT_PILARES' => $detalhes['dadosOae']['altura_pilares'],
			'REPLACE_JUNTAS' => $detalhes['dadosOae']['juntas_dilatacao'],
			'REPLACE_ENCONTROS' => $detalhes['dadosOae']['encontros'],
			'REPLACE_OUTRAS' => $detalhes['dadosOae']['outras'],
			'REPLACE_CARACTERISTICAS_PLANI' => $detalhes['dadosOae']['caracteristicas_plani'],
			'REPLACE_NRO_FAIXAS' => $detalhes['dadosOae']['nro_faixas'],
			'REPLACE_ACOSTAMENTO' => $detalhes['dadosOae']['acostamento'],
			'REPLACE_REFUGIOS' => $detalhes['dadosOae']['refugios'],
			'REPLACE_PASSEIO' => $detalhes['dadosOae']['passeio'],
			'REPLACE_BARREIRA_RIGIDA' => $detalhes['dadosOae']['barreira_rigida'],
			'REPLACE_MATERIAL_PAVIMENTO' => $detalhes['dadosOae']['material_pavimento'],
			'REPLACE_PINGADEIRAS' => $detalhes['dadosOae']['pingadeiras'],
			'REPLACE_GUARDA_CORPO' => $detalhes['dadosOae']['guarda_corpo'],
			'REPLACE_DRENOS' => $detalhes['dadosOae']['drenos'],
			'REPLACE_FREQ_PASSAGEM_CARGA' => $detalhes['dadosOae']['freq_passagem_carga'],
			'REPLACE_SUPERESTRUTURA' => $detalhes['dadosOae']['superestrutura'],
			'REPLACE_MESOESTRUTURA' => $detalhes['dadosOae']['mesoestrutura'],
			'REPLACE_INFRAESTRUTURA' => $detalhes['dadosOae']['infraestrutura'],
			'REPLACE_APARELHOS_APOIO_ANOMALIA' => $detalhes['dadosOae']['aparelhos_apoio_anomalia'],
			'REPLACE_JUNTAS_DILATACAO_ANOMALIA' => $detalhes['dadosOae']['juntas_dilatacao_anomalia'],
			'REPLACE_ENCONTROS_ANOMALIA' => $detalhes['dadosOae']['encontros_anomalia'],
			'REPLACE_PAVIMENTO_ANOMALIA' => $detalhes['dadosOae']['pavimento_anomalia'],
			'REPLACE_ACOSTAMENTO_REFUGIO_ANOMALIA' => $detalhes['dadosOae']['acostamento_refugio_anomalia'],
			'REPLACE_DRENAGEM_ANOMALIA' => $detalhes['dadosOae']['drenagem_anomalia'],
			'REPLACE_GUARDA_CORPO_ANOMALIA' => $detalhes['dadosOae']['guarda_corpo_anomalia'],
			'REPLACE_BARREIRA_DEFESA' => $detalhes['dadosOae']['barreira_defesa'],
			'REPLACE_TALUDES' => $detalhes['dadosOae']['taludes'],
			'REPLACE_ILUMINACAO' => $detalhes['dadosOae']['iluminacao'],
			'REPLACE_SINALIZACAO' => $detalhes['dadosOae']['sinalizacao'],
			'REPLACE_PROTECAO_PILARES' => $detalhes['dadosOae']['protecao_pilares'],
			'REPLACE_AGENDAMENTOS' => self::montarAgendamentosDetalhesOae($detalhes['dadosAdicionais']),
			'REPLACE_INSPECOES' => self::montarInspecoesDetalhesOae($detalhes['dadosAdicionais']),
			'REPLACE_SLIDES' => self::montarSlidesDetalhesOae($detalhes['dadosAdicionais'])
		];
		foreach ($replaces as $chave => $valor){
			$html = str_replace($chave, $valor, $html);
		}

		return [
			'html' => $html,
			'idModal' => $idModal
		];
	}

	private static function montarAgendamentosDetalhesOae($dadosAdicionais)
	{

	}

	private static function montarInspecoesDetalhesOae($dadosAdicionais)
	{

	}

	private static function montarSlidesDetalhesOae($dadosAdicionais)
	{

	}
}

?>