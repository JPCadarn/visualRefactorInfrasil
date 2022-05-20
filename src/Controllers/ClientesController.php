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
}