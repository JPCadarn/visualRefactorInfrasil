<?php

namespace Filters;

class ClientesFilter extends AbstractFilter
{
	public static function listarClientesFilter($dadosRequisicao)
	{
		$filtros = [
			'page' => FILTER_SANITIZE_NUMBER_INT,
			'numeroModal' => FILTER_SANITIZE_NUMBER_INT
		];
		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}

	public static function gerarFormularioCadastroClienteFilter($dadosRequisicao)
	{
		$filtros = [
			'numeroModal' => FILTER_SANITIZE_NUMBER_INT
		];
		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}

	public static function gerarFormularioEdicaoClienteFilter($dadosRequisicao)
	{
		$filtros = [
			'numeroModal' => FILTER_SANITIZE_NUMBER_INT,
			'id' => FILTER_SANITIZE_NUMBER_INT
		];
		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}

	public static function adicionarClienteFilter($dadosRequisicao)
	{
		$filtros = [
			'nome' => FILTER_SANITIZE_SPECIAL_CHARS,
			'data_nascimento' => FILTER_SANITIZE_SPECIAL_CHARS,
			'cpf_cnpj' => FILTER_SANITIZE_SPECIAL_CHARS,
			'telefone' => FILTER_SANITIZE_SPECIAL_CHARS,
			'email' => FILTER_SANITIZE_EMAIL,
			'cep' => FILTER_SANITIZE_NUMBER_INT,
			'endereco' => FILTER_SANITIZE_SPECIAL_CHARS,
			'bairro' => FILTER_SANITIZE_SPECIAL_CHARS,
			'numero' => FILTER_SANITIZE_NUMBER_INT,
			'complemento' => FILTER_SANITIZE_SPECIAL_CHARS,
			'estado' => FILTER_SANITIZE_SPECIAL_CHARS,
			'cidade' => FILTER_SANITIZE_SPECIAL_CHARS,
			'referencia' => FILTER_SANITIZE_SPECIAL_CHARS
		];
		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}

	public static function editarClienteFilter($dadosRequisicao)
	{
		$filtros = [
			'id' => FILTER_SANITIZE_NUMBER_INT,
			'nome' => FILTER_SANITIZE_SPECIAL_CHARS,
			'data_nascimento' => FILTER_SANITIZE_SPECIAL_CHARS,
			'cpf_cnpj' => FILTER_SANITIZE_SPECIAL_CHARS,
			'telefone' => FILTER_SANITIZE_SPECIAL_CHARS,
			'email' => FILTER_SANITIZE_EMAIL,
			'cep' => FILTER_SANITIZE_NUMBER_INT,
			'endereco' => FILTER_SANITIZE_SPECIAL_CHARS,
			'bairro' => FILTER_SANITIZE_SPECIAL_CHARS,
			'numero' => FILTER_SANITIZE_NUMBER_INT,
			'complemento' => FILTER_SANITIZE_SPECIAL_CHARS,
			'estado' => FILTER_SANITIZE_SPECIAL_CHARS,
			'cidade' => FILTER_SANITIZE_SPECIAL_CHARS,
			'referencia' => FILTER_SANITIZE_SPECIAL_CHARS
		];
		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}

	public static function excluirClienteFilter($dadosRequisicao)
	{
		$filtros = [
			'id' => FILTER_SANITIZE_NUMBER_INT
		];

		$dadosFiltrados = filter_var_array($dadosRequisicao, $filtros);

		return parent::limparCamposRequisicao($dadosFiltrados);
	}
}