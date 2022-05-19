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
}