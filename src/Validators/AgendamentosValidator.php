<?php

namespace Validators;

class AgendamentosValidator
{
	public static function adicionarAgendamentoValidate($dadosInsert)
	{
		$erros = [];

		$camposObrigatorios = [
			'ponte_id' => 'Por favor, selecione a OAE do agendamento.',
			'data' => 'Por favor, preencha o campo Data.',
			'horario' => 'Por favor, preencha o campo Horário.',
			'detalhes' => 'Por favor, preencha o campo Detalhes.',
			'tipo_inspecao' => 'Por favor, selecione o tipo de inspeção'
		];

		foreach($dadosInsert as $key => $value){
			if(array_key_exists($key, $camposObrigatorios) && empty($value)){
				$erros[] = $camposObrigatorios[$key];
			}
		}

		return $erros;
	}
}