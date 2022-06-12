<?php

namespace Filters;

use Utils;

class AgendamentosFilter extends AbstractFilter
{
	public static function listarAgendamentosFilter($dadosRequisicao)
	{
		$filtros = [
			'page' => FILTER_SANITIZE_NUMBER_INT,
			'numeroModal' => FILTER_SANITIZE_NUMBER_INT
		];
		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}

	public static function gerarFormularioCadastroAgendamentoFilter($dadosRequisicao)
	{
		$filtros = [
			'numeroModal' => FILTER_SANITIZE_NUMBER_INT
		];
		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}

	public static function adicionarAgendamentoFilter($dadosRequisicao)
	{
		$filtros = [
			'data' => FILTER_SANITIZE_STRING,
			'horario' => FILTER_SANITIZE_STRING,
			'detalhes' => FILTER_SANITIZE_STRING,
			'ponte_id' => FILTER_SANITIZE_NUMBER_INT,
			'tipo_inspecao' => FILTER_SANITIZE_STRING,
			'id_usuario' => FILTER_SANITIZE_NUMBER_INT
		];

		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);
		$dadosFiltrados['data'] = Utils::formatarDataBanco($dadosFiltrados['data']);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}
}