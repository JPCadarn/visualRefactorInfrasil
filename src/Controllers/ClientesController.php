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

		$dadosFiltrados = ClientesFilter::gerarFormularioCadastroClienteFilter($dadosRequisicao);

		return $ClientesService->gerarFormularioCadastroCliente($dadosFiltrados);
	}

	public function gerarFormularioEdicaoCliente($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$ClientesService = new ClientesService();
		$ClientesService->setConexao($conexao);

		$dadosFiltrados = ClientesFilter::gerarFormularioEdicaoClienteFilter($dadosRequisicao);

		return $ClientesService->gerarFormularioEdicaoCliente($dadosFiltrados);
	}

	public function adicionarCliente($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$ClientesService = new ClientesService();
		$ClientesService->setConexao($conexao);

		$dadosFiltrados = ClientesFilter::adicionarClienteFilter($dadosRequisicao);

		return $ClientesService->adicionarCliente($dadosFiltrados);
	}

	public function editarCliente($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$ClientesService = new ClientesService();
		$ClientesService->setConexao($conexao);

		$dadosFiltrados = ClientesFilter::editarClienteFilter($dadosRequisicao);

		return $ClientesService->editarCliente($dadosFiltrados);
	}
}