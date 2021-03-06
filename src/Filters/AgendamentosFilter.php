<?php

namespace Filters;

use Utils\DateUtils;

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
			'data' => FILTER_SANITIZE_SPECIAL_CHARS,
			'horario' => FILTER_SANITIZE_SPECIAL_CHARS,
			'detalhes' => FILTER_SANITIZE_SPECIAL_CHARS,
			'ponte_id' => FILTER_SANITIZE_NUMBER_INT,
			'tipo_inspecao' => FILTER_SANITIZE_SPECIAL_CHARS,
			'id_usuario' => FILTER_SANITIZE_NUMBER_INT
		];

		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);
		$dadosFiltrados['data'] = DateUtils::formatarDataBanco($dadosFiltrados['data']);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}

	public static function editarAgendamentoFilter($dadosRequisicao)
	{
		$filtros = [
			'id' => FILTER_SANITIZE_NUMBER_INT,
			'data' => FILTER_SANITIZE_SPECIAL_CHARS,
			'horario' => FILTER_SANITIZE_SPECIAL_CHARS,
			'detalhes' => FILTER_SANITIZE_SPECIAL_CHARS,
		];

		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);
		$dadosFiltrados['data'] = DateUtils::formatarDataBanco($dadosFiltrados['data']);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}

	public static function gerarFormularioEdicaoAgendamentoFilter($dadosRequisicao)
	{
		$filtros = [
			'numeroModal' => FILTER_SANITIZE_NUMBER_INT,
			'id' => FILTER_SANITIZE_NUMBER_INT
		];
		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}
}