<?php

namespace Filters;

class InspecoesFilter extends AbstractFilter
{
	public static function listarInspecoesFilter($dadosRequisicao)
	{
		$filtros = [
			'page' => FILTER_SANITIZE_NUMBER_INT,
			'numeroModal' => FILTER_SANITIZE_NUMBER_INT
		];
		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}

	public static function formularioAvaliacaoInspecaoFilter($dadosRequisicao)
	{
		$filtros = [
			'numeroModal' => FILTER_SANITIZE_NUMBER_INT,
			'id' => FILTER_SANITIZE_NUMBER_INT
		];
		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}

	public static function avaliarInspecaoFilter($dadosRequisicao)
	{
		$filtros = [
			'id_inspecao' => FILTER_SANITIZE_NUMBER_INT,
			'nota_indice_localizacao' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_indice_volume_trafego' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_indice_largura_oae' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_geometria_condicoes' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_acessos' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_cursos_agua' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_encontros_fundacoes' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_apoios_intermediarios' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_aparelhos_apoio' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_superestrutura' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_pista_rolamento' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_juntas_dilatacao' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_barreiras_guardacorpos' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_sinalizacao' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_instalacoes_util_publica' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_largura_plataforma' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_capacidade_carga' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_superficie_plataforma' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_pista_rolamento_fc' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_outros_fc' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_espaco_livre' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_localizacao_ponte' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_saude_fisica_ponte' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nota_outros_fi' => FILTER_SANITIZE_SPECIAL_CHARS,
			'obs' => FILTER_SANITIZE_SPECIAL_CHARS
		];

		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}
}