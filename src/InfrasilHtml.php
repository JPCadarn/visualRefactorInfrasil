<?php

use Services\SessionService;
use Utils\Constants;
use Utils\DateUtils;
use Utils\HtmlUtils;
use Utils\MaskUtils;

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
                    <th>'.DateUtils::formatarData($ponte['data_construcao'], 'd/m/Y').'</th>
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
        $html .= "<button class='modal-close waves-effect waves-green btn-floating triggerModal tooltipped' data-action='formularioPonte' data-position='bottom' data-tooltip='Cadastrar estrutura'><i class='material-icons'>add</i></button>";
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
                    <th>'.DateUtils::formatarData($agendamento['data'], 'd/m/Y').'</th>
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
		$html .= "<button class='modal-close waves-effect waves-green btn-floating triggerModal tooltipped' data-action='formularioAgendamento' data-position='bottom' data-tooltip='Cadastrar agendamento'><i class='material-icons'>add</i></button>";
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
                    <th>'.DateUtils::formatarData($inspecao['data_inspecao'], 'd/m/Y').'</th>
                    <th>'.$inspecao['tipo_inspecao'].'</th>
                    <th>'.$inspecao['status'].'</th>
            ';
			if($inspecao['status'] === 'avaliado'){
				$corpo .= '<th>
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Avaliar" data-position="bottom" data-action="formularioAvaliacaoInspecao" data-id="'.$inspecao['id_inspecao'].'"><i class="material-icons yellow-text text-darken-3">thumbs_up_down</i></a>
					</th>
                </tr>';
			}else{
				$corpo .= '<th>
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Detalhes" data-position="bottom" data-action="detalhesInspecao" data-id="'.$inspecao['id_inspecao'].'"><i class="material-icons yellow-text text-darken-3">info</i></a>
					</th>
                </tr>';
			}
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
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Editar Usuário" data-position="bottom" data-action="formularioEdicaoUsuario" data-id="'.$usuario['id'].'"><i class="material-icons yellow-text text-darken-3">edit</i></a>
                    	<a class="waves-effect triggerModal tooltipped" data-tooltip="Excluir Usuário" data-position="bottom" data-action="excluirUsuario" data-id="'.$usuario['id'].'"><i class="material-icons yellow-text text-darken-3">delete</i></a>
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
		$html .= "<button class='modal-close waves-effect waves-green btn-floating triggerModal tooltipped' data-action='formularioUsuario' data-position='bottom' data-tooltip='Cadastrar usuário'><i class='material-icons'>add</i></button>";
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
                    <th>'.DateUtils::formatarData($cliente['data_nascimento'], 'd/m/Y').'</th>
                    <th>'.MaskUtils::formataCpfCnpj($cliente['cpf_cnpj']).'</th>
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
		$html .= "<button class='modal-close waves-effect waves-green btn-floating triggerModal tooltipped' data-action='formularioCliente' data-position='bottom' data-tooltip='Cadastrar cliente'><i class='material-icons'>add</i></button>";
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

		$selectIndiceLocalizao = HtmlUtils::renderSelect(
			'nota_indice_localizacao',
			Constants::camposIndiceLocalizacao,
			'Índice de Localização',
			'Índice de Localização',
			'descricao',
			'nota'
		);
		$selectNotaIndiceVolumeTrafego = HtmlUtils::renderSelect('nota_indice_volume_trafego', Constants::camposVolumeTrafego, 'Índice de Volume de Tráfego', 'Índice de Volume de Tráfego', 'descricao', 'nota');
		$selectNotaIndiceLarguraOae = HtmlUtils::renderSelect('nota_indice_largura_oae', Constants::camposLarguraOAE, 'Índice de Largura da OAE', 'Índice de Largura da OAE', 'descricao', 'nota');
		$selectNotaGeometriaCondicoes = HtmlUtils::renderSelect('nota_geometria_condicoes', Constants::camposFsPesoAlto, 'Geometria e condições várias', 'Geometria e condições várias', 'descricao', 'nota');
		$selectNotaAcessos = HtmlUtils::renderSelect('nota_acessos', Constants::camposFsPesoMedio, 'Acessos', 'Acessos', 'descricao', 'nota');
		$selectNotaCursosAgua = HtmlUtils::renderSelect('nota_cursos_agua', Constants::camposFsPesoMedio, 'Cursos d\'água', 'Cursos d\'água', 'descricao', 'nota');
		$selectNotaEncontrosFundacoes = HtmlUtils::renderSelect('nota_encontros_fundacoes', Constants::camposFsPesoAlto, 'Encontros e fundações', 'Encontros e fundações', 'descricao', 'nota');
		$selectNotaApoiosIntermediarios = HtmlUtils::renderSelect('nota_apoios_intermediarios', Constants::camposFsPesoAlto, 'Apoios intermediários', 'Apoios intermediários', 'descricao', 'nota');
		$selectNotaAparelhosApoio = HtmlUtils::renderSelect('nota_aparelhos_apoio', Constants::camposFsPesoAlto, 'Aparelhos de apoio', 'Aparelhos de apoio', 'descricao', 'nota');
		$selectNotaSuperestrutura = HtmlUtils::renderSelect('nota_superestrutura', Constants::camposFsPesoAlto, 'Superestrutura', 'Superestrutura', 'descricao', 'nota');
		$selectNotaPistaRolamentoFc = HtmlUtils::renderSelect('nota_pista_rolamento_fc', Constants::camposFcPistaRolamento, 'Pista de rolamento', 'Pista de rolamento', 'descricao', 'nota');
		$selectNotaPistaRolamento = HtmlUtils::renderSelect('nota_pista_rolamento', Constants::camposFsPesoMedio, 'Pista de rolamento', 'Pista de rolamento', 'descricao', 'nota');
		$selectNotaJuntasDilatacao = HtmlUtils::renderSelect('nota_juntas_dilatacao', Constants::camposFsPesoMedio, 'Juntas de dilatação', 'Juntas de dilatação', 'descricao', 'nota');
		$selectNotaBarreirasGuardacorpos = HtmlUtils::renderSelect('nota_barreiras_guardacorpos', Constants::camposFsPesoBaixo, 'Barreiras e guarda-corpos', 'Barreiras e guarda-corpos', 'descricao', 'nota');
		$selectNotaSinalizacao = HtmlUtils::renderSelect('nota_sinalizacao', Constants::camposFsPesoBaixo, 'Sinalização', 'Sinalização', 'descricao', 'nota');
		$selectNotaInstalacoesUtilPublica = HtmlUtils::renderSelect('nota_instalacoes_util_publica', Constants::camposFsPesoBaixo, 'Instalações de utilidade pública', 'Instalações de utilidade pública', 'descricao', 'nota');
		$selectNotaLarguraPlataforma = HtmlUtils::renderSelect('nota_largura_plataforma', Constants::camposFcLargura, 'Largura da plataforma', 'Largura da plataforma', 'descricao', 'nota');
		$selectNotaCapacidadeCarga = HtmlUtils::renderSelect('nota_capacidade_carga', Constants::camposFcCarga, 'Capacidade de carga', 'Capacidade de carga', 'descricao', 'nota');
		$selectNotaSuperficiePlataforma = HtmlUtils::renderSelect('nota_superficie_plataforma', Constants::camposFcSuperficie, 'Superfície da plataforma', 'Superfície da plataforma', 'descricao', 'nota');
		$selectNotaOutrosFc = HtmlUtils::renderSelect('nota_outros_fc', Constants::camposFcOutros, 'Outros', 'Outros', 'descricao', 'nota');
		$selectNotaEspacoLivre = HtmlUtils::renderSelect('nota_espaco_livre', Constants::camposFiEspacoLivre, 'Espaço livre', 'Espaço livre', 'descricao', 'nota');
		$selectNotaLocalizacaoPonte = HtmlUtils::renderSelect('nota_localizacao_ponte', Constants::camposFiLocal, 'Localização da Ponte', 'Localização da Ponte', 'descricao', 'nota');
		$selectNotaSaudeFisicaPonte = HtmlUtils::renderSelect('nota_saude_fisica_ponte', Constants::camposFiSaude, 'Saúde física da ponte', 'Saúde física da ponte', 'descricao', 'nota');
		$selectNotaOutrosFi = HtmlUtils::renderSelect('nota_outros_fi', Constants::camposFiOutros, 'Outros', 'Outros', 'descricao', 'nota');

		$html = file_get_contents('Html/formAvaliacaoInspecao.html');
        $html = str_replace('REPLACE_ID_MODAL', $idModal, $html);
        $html = str_replace('REPLACE_ID_INSPECAO', $idInspecao, $html);
		$html = str_replace('REPLACE_SELECT_IND_LOCALIZACAO', $selectIndiceLocalizao, $html);
		$html = str_replace('REPLACE_SELECT_INDICE_VOL_TRAF', $selectNotaIndiceVolumeTrafego, $html);
		$html = str_replace('REPLACE_INDICE_LARGURA_OAE', $selectNotaIndiceLarguraOae, $html);
		$html = str_replace('REPLACE_NOTA_GEOMETRIA_CONDICOES', $selectNotaGeometriaCondicoes, $html);
		$html = str_replace('REPLACE_NOTA_ACESSOS', $selectNotaAcessos, $html);
		$html = str_replace('REPLACE_NOTA_CURSOS_AGUA', $selectNotaCursosAgua, $html);
		$html = str_replace('REPLACE_NOTA_ENCONTROS_FUNDACOES', $selectNotaEncontrosFundacoes, $html);
		$html = str_replace('REPLACE_NOTA_APOIOS_INTERMEDIARIOS', $selectNotaApoiosIntermediarios, $html);
		$html = str_replace('REPLACE_NOTA_APARELHOS_APOIO', $selectNotaAparelhosApoio, $html);
		$html = str_replace('REPLACE_NOTA_SUPERESTRUTURA', $selectNotaSuperestrutura, $html);
		$html = str_replace('REPLACE_NOTA_PISTA_ROLAMENTO_FC', $selectNotaPistaRolamentoFc, $html);
		$html = str_replace('REPLACE_NOTA_PISTA_ROLAMENTO', $selectNotaPistaRolamento, $html);
		$html = str_replace('REPLACE_NOTA_JUNTAS_DILATACAO', $selectNotaJuntasDilatacao, $html);
		$html = str_replace('REPLACE_NOTA_BARREIRAS_GUARDACORPOS', $selectNotaBarreirasGuardacorpos, $html);
		$html = str_replace('REPLACE_NOTA_SINALIZACAO', $selectNotaSinalizacao, $html);
		$html = str_replace('REPLACE_NOTA_INSTALACOES_UTIL_PUBLICA', $selectNotaInstalacoesUtilPublica, $html);
		$html = str_replace('REPLACE_NOTA_LARGURA_PLATAFORMA', $selectNotaLarguraPlataforma, $html);
		$html = str_replace('REPLACE_NOTA_CAPACIDADE_CARGA', $selectNotaCapacidadeCarga, $html);
		$html = str_replace('REPLACE_NOTA_SUPERFICIE_PLATAFORMA', $selectNotaSuperficiePlataforma, $html);
		$html = str_replace('REPLACE_NOTA_OUTROS_FC', $selectNotaOutrosFc, $html);
		$html = str_replace('REPLACE_NOTA_ESPACO_LIVRE', $selectNotaEspacoLivre, $html);
		$html = str_replace('REPLACE_NOTA_LOCALIZACAO_PONTE', $selectNotaLocalizacaoPonte, $html);
		$html = str_replace('REPLACE_NOTA_SAUDE_FISICA_PONTE', $selectNotaSaudeFisicaPonte, $html);
		$html = str_replace('REPLACE_NOTA_OUTROS_FI', $selectNotaOutrosFi, $html);

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

	public static function montarFormUsuarios($numeroModal)
	{
		$idModal = 'modal'.$numeroModal;

		$html = file_get_contents('Html/formCadastroUsuarios.html');
		$html = str_replace('REPLACE_ID_MODAL', $idModal, $html);

		return [
			'html' => $html,
			'idModal' => $idModal
		];
	}

	public static function montarFormEditUsuarios($numeroModal, $dadosUsuario)
	{
		$idModal = 'modal'.$numeroModal;

		$html = file_get_contents('Html/formEdicaoUsuarios.html');
		$html = str_replace('REPLACE_ID_MODAL', $idModal, $html);
		$html = str_replace('REPLACE_ID_USUARIO', $dadosUsuario['id'], $html);
		$html = str_replace('REPLACE_NOME', $dadosUsuario['nome'], $html);
		$html = str_replace('REPLACE_EMAIL', $dadosUsuario['email'], $html);

		return [
			'html' => $html,
			'idModal' => $idModal
		];
	}

	public static function montarFormMinhaConta($numeroModal, $dadosUsuario)
	{
		$idModal = 'modal'.$numeroModal;

		$html = file_get_contents('Html/formMinhaConta.html');
		$html = str_replace('REPLACE_ID_MODAL', $idModal, $html);
		$html = str_replace('REPLACE_ID_USUARIO', $dadosUsuario['id'], $html);
		$html = str_replace('REPLACE_NOME', $dadosUsuario['nome'], $html);
		$html = str_replace('REPLACE_EMAIL', $dadosUsuario['email'], $html);
		$html = str_replace('REPLACE_TIPO', $dadosUsuario['tipo'], $html);

		return [
			'html' => $html,
			'idModal' => $idModal
		];
	}

	public static function montarFormCliente($numeroModal)
	{
		$idModal = 'modal'.$numeroModal;

		$html = file_get_contents('Html/formCadastroCliente.html');
		$html = str_replace('REPLACE_ID_MODAL', $idModal, $html);

		return [
			'html' => $html,
			'idModal' => $idModal
		];
	}

	public static function montarFormEdicaoCliente($numeroModal, $dadosCliente)
	{
		$idModal = 'modal'.$numeroModal;

		$html = file_get_contents('Html/formCadastroCliente.html');
		$html = str_replace('REPLACE_ID_MODAL', $idModal, $html);
		$html = str_replace('REPLACE_ID_CLIENTE', $dadosCliente['id'], $html);
		$html = str_replace('REPLACE_NOME', $dadosCliente['nome'], $html);
		$html = str_replace('REPLACE_DATA_NASCIMENTO', $dadosCliente['data_nascimento'], $html);
		$html = str_replace('REPLACE_CPF_CNPJ', $dadosCliente['cpf_cnpj'], $html);
		$html = str_replace('REPLACE_TELEFONE', $dadosCliente['telefone'], $html);
		$html = str_replace('REPLACE_EMAIL', $dadosCliente['email'], $html);
		$html = str_replace('REPLACE_CEP', $dadosCliente['cep'], $html);
		$html = str_replace('REPLACE_ENDERECO', $dadosCliente['endereco'], $html);
		$html = str_replace('REPLACE_BAIRRO', $dadosCliente['bairro'], $html);
		$html = str_replace('REPLACE_NUMERO', $dadosCliente['numero'], $html);
		$html = str_replace('REPLACE_COMPLEMENTO', $dadosCliente['complemento'], $html);
		$html = str_replace('REPLACE_ESTADO', $dadosCliente['estado'], $html);
		$html = str_replace('REPLACE_CIDADE', $dadosCliente['cidade'], $html);
		$html = str_replace('REPLACE_REFERENCIA', $dadosCliente['referencia'], $html);

		return [
			'html' => $html,
			'idModal' => $idModal
		];
	}

	public static function montarFormEdicaoAgendamentos($numeroModal, $idAgendamento)
	{
		$idModal = 'modal'.$numeroModal;

		$html = file_get_contents('Html/formEdicaoAgendamento.html');
		$html = str_replace('REPLACE_ID_MODAL', $idModal, $html);
		$html = str_replace('REPLACE_ID_AGENDAMENTO', $idAgendamento, $html);

		return [
			'html' => $html,
			'idModal' => $idModal
		];
	}

	public static function renderNavBar()
	{
		$tipoUsuario = SessionService::getTipoUsuarioLogado();

		echo '
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
					<li><div class="divider"></div></li>';
		if($tipoUsuario !== 'normal'){
			echo '
				<li>
					<a class="waves-effect triggerModal" data-action="listarUsuarios"><i class="material-icons">people</i>Usuários</a>
				</li>
			';
		}
		if($tipoUsuario === 'aguia'){
			echo '
				<li>
					<a class="waves-effect triggerModal" data-action="listarClientes"><i class="material-icons">business_center</i>Clientes</a>
				</li>
			';
		}
		echo '				
					<li>
						<a class="waves-effect triggerModal" data-action="listarConta"><i class="material-icons">settings</i>Minha Conta</a>
					</li>
				</ul>
			</div>
		';
	}
}

?>