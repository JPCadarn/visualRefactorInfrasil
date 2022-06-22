<?php

namespace Filters;

class UsuariosFilter extends AbstractFilter
{
	public static function loginFilter($dadosRequisicao)
	{
		$filtros = [
			'usuario' => FILTER_SANITIZE_STRING,
			'senha' => FILTER_SANITIZE_STRING
		];
		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}

	public static function listarUsuariosFilter($dadosRequisicao)
	{
		$filtros = [
			'page' => FILTER_SANITIZE_NUMBER_INT,
			'numeroModal' => FILTER_SANITIZE_NUMBER_INT
		];
		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}

	public static function gerarFormularioCadastroUsuarioFilter($dadosRequisicao)
	{
		$filtros = [
			'numeroModal' => FILTER_SANITIZE_NUMBER_INT
		];
		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}

	public static function adicionarUsuarioFilter($dadosRequisicao)
	{
		$filtros = [
			'nome' => FILTER_SANITIZE_SPECIAL_CHARS,
			'senha' => FILTER_SANITIZE_SPECIAL_CHARS,
			'email' => FILTER_SANITIZE_EMAIL,
			'chave' => FILTER_SANITIZE_SPECIAL_CHARS,
			'tipo' => FILTER_SANITIZE_SPECIAL_CHARS
		];

		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}
}