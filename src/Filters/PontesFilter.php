<?php

namespace Filters;

class PontesFilter extends AbstractFilter
{
    public static function listarPontesFilter($dadosRequisicao)
    {
        $filtros = [
			'page' => FILTER_SANITIZE_NUMBER_INT,
			'numeroModal' => FILTER_SANITIZE_NUMBER_INT
		];
		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);

        return parent::limparCamposRequisicao($dadosFiltrados);
    }

	public static function gerarFormularioCadastroPonteFilter($dadosRequisicao)
	{
		$filtros = [
			'numeroModal' => FILTER_SANITIZE_NUMBER_INT
		];
		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}

	public static function adicionarOaeFilter($dadosRequisicao)
	{
		$filtros = [
			'via' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nome' => FILTER_SANITIZE_SPECIAL_CHARS,
			'data_construcao' => FILTER_SANITIZE_SPECIAL_CHARS,
			'trem_tipo' => FILTER_SANITIZE_SPECIAL_CHARS,
			'sentido' => FILTER_SANITIZE_SPECIAL_CHARS,
			'localizacao' => FILTER_SANITIZE_SPECIAL_CHARS,
			'latitude' => FILTER_SANITIZE_SPECIAL_CHARS,
			'longitude' => FILTER_SANITIZE_SPECIAL_CHARS,
			'projetista' => FILTER_SANITIZE_SPECIAL_CHARS,
			'construtor' => FILTER_SANITIZE_SPECIAL_CHARS,
			'comprimento_estrutura' => FILTER_SANITIZE_SPECIAL_CHARS,
			'largura_estrutura' => FILTER_SANITIZE_SPECIAL_CHARS,
			'largura_acostamento' => FILTER_SANITIZE_SPECIAL_CHARS,
			'largura_refugio' => FILTER_SANITIZE_SPECIAL_CHARS,
			'largura_passeio' => FILTER_SANITIZE_SPECIAL_CHARS,
			'sistema_construtivo' => FILTER_SANITIZE_SPECIAL_CHARS,
			'natureza_transposicao' => FILTER_SANITIZE_SPECIAL_CHARS,
			'material_construcao' => FILTER_SANITIZE_SPECIAL_CHARS,
			'longitudinal_super' => FILTER_SANITIZE_SPECIAL_CHARS,
			'transversal_super' => FILTER_SANITIZE_SPECIAL_CHARS,
			'mesoestrutura_tipo' => FILTER_SANITIZE_SPECIAL_CHARS,
			'infraestrutura' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nro_vaos' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nro_apoios' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nro_pilares_apoio' => FILTER_SANITIZE_SPECIAL_CHARS,
			'aparelhos_apoio' => FILTER_SANITIZE_SPECIAL_CHARS,
			'comprimento_vao_tipico' => FILTER_SANITIZE_SPECIAL_CHARS,
			'comprimento_maior_vao' => FILTER_SANITIZE_SPECIAL_CHARS,
			'altura_pilares' => FILTER_SANITIZE_SPECIAL_CHARS,
			'juntas_dilatacao' => FILTER_SANITIZE_SPECIAL_CHARS,
			'encontros' => FILTER_SANITIZE_SPECIAL_CHARS,
			'descricao' => FILTER_SANITIZE_SPECIAL_CHARS,
			'caracteristicas_plani' => FILTER_SANITIZE_SPECIAL_CHARS,
			'nro_faixas' => FILTER_SANITIZE_SPECIAL_CHARS,
			'acostamento' => FILTER_SANITIZE_SPECIAL_CHARS,
			'refugios' => FILTER_SANITIZE_SPECIAL_CHARS,
			'passeio' => FILTER_SANITIZE_SPECIAL_CHARS,
			'barreira_rigida' => FILTER_SANITIZE_SPECIAL_CHARS,
			'material_pavimento' => FILTER_SANITIZE_SPECIAL_CHARS,
			'pingadeiras' => FILTER_SANITIZE_SPECIAL_CHARS,
			'guarda_corpo' => FILTER_SANITIZE_SPECIAL_CHARS,
			'drenos' => FILTER_SANITIZE_SPECIAL_CHARS,
			'freq_passagem_carga' => FILTER_SANITIZE_SPECIAL_CHARS,
			'superestrutura' => FILTER_SANITIZE_SPECIAL_CHARS,
			'mesoestrutura' => FILTER_SANITIZE_SPECIAL_CHARS,
			'infraestrutura_anomalia' => FILTER_SANITIZE_SPECIAL_CHARS,
			'aparelhos_apoio_anomalia' => FILTER_SANITIZE_SPECIAL_CHARS,
			'juntas_dilatacao_anomalia' => FILTER_SANITIZE_SPECIAL_CHARS,
			'encontros_anomalia' => FILTER_SANITIZE_SPECIAL_CHARS,
			'pavimento_anomalia' => FILTER_SANITIZE_SPECIAL_CHARS,
			'acostamento_refugio_anomalia' => FILTER_SANITIZE_SPECIAL_CHARS,
			'drenagem_anomalia' => FILTER_SANITIZE_SPECIAL_CHARS,
			'guarda_corpo_anomalia' => FILTER_SANITIZE_SPECIAL_CHARS,
			'barreira_defesa' => FILTER_SANITIZE_SPECIAL_CHARS,
			'taludes' => FILTER_SANITIZE_SPECIAL_CHARS,
			'iluminacao' => FILTER_SANITIZE_SPECIAL_CHARS,
			'sinalizacao' => FILTER_SANITIZE_SPECIAL_CHARS,
			'protecao_pilares' => FILTER_SANITIZE_SPECIAL_CHARS,
			'resumo' => FILTER_SANITIZE_SPECIAL_CHARS,
			'id_usuario' => FILTER_SANITIZE_NUMBER_INT
		];
		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}

	public static function detalhesPonteFilter($dadosRequisicao)
	{
		$filtros = [
			'numeroModal' => FILTER_SANITIZE_NUMBER_INT,
			'id' => FILTER_SANITIZE_NUMBER_INT
		];
		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}
}