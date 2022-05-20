<?php

class InfrasilHtml {
    public static function montarGridPontes($pontes, $numeroModal)
    {
        $idModal = 'modal'.$numeroModal;

        $html = "<div id='$idModal' class='modal center-align'>";
        $html .= "<div class='modal-header centered'>";
        $html .= "<h4>Estruturas Cadastradas</h4>";
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
                    </tr>
                </thead>
                
                <tbody>
                    '.$corpo.'
                </tbody>
            </table>';

        $html .= "</div>";
        $html .= "<div class='modal-footer'>";
        $html .= "<a href='#!' class='modal-close waves-effect waves-green btn-flat'>Fechar</a>";
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
		$html .= "<h4>Agendamentos</h4>";
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
                    </tr>
                </thead>
                
                <tbody>
                    '.$corpo.'
                </tbody>
            </table>';

		$html .= "</div>";
		$html .= "<div class='modal-footer'>";
		$html .= "<a href='#!' class='modal-close waves-effect waves-green btn-flat'>Fechar</a>";
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
                    <th>'.$inspecao['id'].'</th>
                    <th>'.$inspecao['ponte_nome'].'</th>
                    <th>'.Utils::formatarData($inspecao['data_inspecao'], 'd/m/Y').'</th>
                    <th>'.$inspecao['tipo_inspecao'].'</th>
                    <th>'.$inspecao['status'].'</th>
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
                    </tr>
                </thead>
                
                <tbody>
                    '.$corpo.'
                </tbody>
            </table>';

		$html .= "</div>";
		$html .= "<div class='modal-footer'>";
		$html .= "<a href='#!' class='modal-close waves-effect waves-green btn-flat'>Fechar</a>";
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
                    </tr>
                </thead>
                
                <tbody>
                    '.$corpo.'
                </tbody>
            </table>';

		$html .= "</div>";
		$html .= "<div class='modal-footer'>";
		$html .= "<a href='#!' class='modal-close waves-effect waves-green btn-flat'>Fechar</a>";
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
                    </tr>
                </thead>
                
                <tbody>
                    '.$corpo.'
                </tbody>
            </table>';

		$html .= "</div>";
		$html .= "<div class='modal-footer'>";
		$html .= "<a href='#!' class='modal-close waves-effect waves-green btn-flat'>Fechar</a>";
		$html .= "</div>";
		$html .= "</div>";

		return [
			'html' => $html,
			'idModal' => $idModal
		];
	}
}

?>