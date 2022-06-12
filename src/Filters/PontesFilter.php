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
			'via' => FILTER_SANITIZE_STRING,
			'nome' => FILTER_SANITIZE_STRING,
			'data_construcao' => FILTER_SANITIZE_STRING,
			'trem_tipo' => FILTER_SANITIZE_STRING,
			'sentido' => FILTER_SANITIZE_STRING,
			'localizacao' => FILTER_SANITIZE_STRING,
			'latitude' => FILTER_SANITIZE_STRING,
			'longitude' => FILTER_SANITIZE_STRING,
			'projetista' => FILTER_SANITIZE_STRING,
			'construtor' => FILTER_SANITIZE_STRING,
			'comprimento_estrutura' => FILTER_SANITIZE_STRING,
			'largura_estrutura' => FILTER_SANITIZE_STRING,
			'largura_acostamento' => FILTER_SANITIZE_STRING,
			'largura_refugio' => FILTER_SANITIZE_STRING,
			'largura_passeio' => FILTER_SANITIZE_STRING,
			'sistema_construtivo' => FILTER_SANITIZE_STRING,
			'natureza_transposicao' => FILTER_SANITIZE_STRING,
			'material_construcao' => FILTER_SANITIZE_STRING,
			'longitudinal_super' => FILTER_SANITIZE_STRING,
			'transversal_super' => FILTER_SANITIZE_STRING,
			'mesoestrutura_tipo' => FILTER_SANITIZE_STRING,
			'infraestrutura' => FILTER_SANITIZE_STRING,
			'nro_vaos' => FILTER_SANITIZE_STRING,
			'nro_apoios' => FILTER_SANITIZE_STRING,
			'nro_pilares_apoio' => FILTER_SANITIZE_STRING,
			'aparelhos_apoio' => FILTER_SANITIZE_STRING,
			'comprimento_vao_tipico' => FILTER_SANITIZE_STRING,
			'comprimento_maior_vao' => FILTER_SANITIZE_STRING,
			'altura_pilares' => FILTER_SANITIZE_STRING,
			'juntas_dilatacao' => FILTER_SANITIZE_STRING,
			'encontros' => FILTER_SANITIZE_STRING,
			'descricao' => FILTER_SANITIZE_STRING,
			'caracteristicas_plani' => FILTER_SANITIZE_STRING,
			'nro_faixas' => FILTER_SANITIZE_STRING,
			'acostamento' => FILTER_SANITIZE_STRING,
			'refugios' => FILTER_SANITIZE_STRING,
			'passeio' => FILTER_SANITIZE_STRING,
			'barreira_rigida' => FILTER_SANITIZE_STRING,
			'material_pavimento' => FILTER_SANITIZE_STRING,
			'pingadeiras' => FILTER_SANITIZE_STRING,
			'guarda_corpo' => FILTER_SANITIZE_STRING,
			'drenos' => FILTER_SANITIZE_STRING,
			'freq_passagem_carga' => FILTER_SANITIZE_STRING,
			'superestrutura' => FILTER_SANITIZE_STRING,
			'mesoestrutura' => FILTER_SANITIZE_STRING,
			'infraestrutura_anomalia' => FILTER_SANITIZE_STRING,
			'aparelhos_apoio_anomalia' => FILTER_SANITIZE_STRING,
			'juntas_dilatacao_anomalia' => FILTER_SANITIZE_STRING,
			'encontros_anomalia' => FILTER_SANITIZE_STRING,
			'pavimento_anomalia' => FILTER_SANITIZE_STRING,
			'acostamento_refugio_anomalia' => FILTER_SANITIZE_STRING,
			'drenagem_anomalia' => FILTER_SANITIZE_STRING,
			'guarda_corpo_anomalia' => FILTER_SANITIZE_STRING,
			'barreira_defesa' => FILTER_SANITIZE_STRING,
			'taludes' => FILTER_SANITIZE_STRING,
			'iluminacao' => FILTER_SANITIZE_STRING,
			'sinalizacao' => FILTER_SANITIZE_STRING,
			'protecao_pilares' => FILTER_SANITIZE_STRING,
			'resumo' => FILTER_SANITIZE_STRING,
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