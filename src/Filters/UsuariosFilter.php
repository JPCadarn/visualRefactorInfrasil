<?php

namespace Filters;

class UsuariosFilter extends AbstractFilter
{
	public static function loginFilter($dadosRequisicao)
	{
		$dadosFiltrados = [
			'usuario' => $dadosRequisicao['usuario'],
			'senha' => $dadosRequisicao['senha']
		];

		return parent::limparCamposRequisicao($dadosFiltrados);
	}
}