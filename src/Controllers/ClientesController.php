<?php

namespace Controllers;

use Conexao;
use Filters\ClientesFilter;
use Services\ClientesService;

class ClientesController
{
	public function listarClientes($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$ClientesService = new ClientesService();
		$ClientesService->setConexao($conexao);

		$dadosFiltrados = ClientesFilter::listarClientesFilter($dadosRequisicao);

		return $ClientesService->listarClientes($dadosRequisicao);
	}

	public function gerarFormularioCadastroCliente($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$ClientesService = new ClientesService();
		$ClientesService->setConexao($conexao);

		$dadosFiltrados = AgendamentosFilter::gerarFormularioCadastroClienteFilter($dadosRequisicao);

		return $ClientesService->gerarFormularioCadastroCliente($dadosFiltrados);
	}

	public function gerarFormularioEdicaoCliente($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$ClientesService = new ClientesService();
		$ClientesService->setConexao($conexao);

		$dadosFiltrados = AgendamentosFilter::gerarFormularioEdicaoClienteFilter($dadosRequisicao);

		return $ClientesService->gerarFormularioEdicaoCliente($dadosFiltrados);
	}
}