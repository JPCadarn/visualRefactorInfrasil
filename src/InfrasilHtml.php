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
}

?>