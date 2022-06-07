<?php

namespace Controllers;

use Conexao;
use Filters\InspecoesFilter;
use Services\InspecoesService;

class InspecoesController
{
	public function listarInspecoes($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$InspecoesService = new InspecoesService();
		$InspecoesService->setConexao($conexao);

		$dadosFiltrados = InspecoesFilter::listarInspecoesFilter($dadosRequisicao);

		return $InspecoesService->listarInspecoes($dadosFiltrados);
	}

	public function formularioAvaliacaoInspecao($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$InspecoesService = new InspecoesService();
		$InspecoesService->setConexao($conexao);

		$dadosFiltrados = InspecoesFilter::formularioAvaliacaoInspecaoFilter($dadosRequisicao);

		return $InspecoesService->formularioAvaliacaoInspecao($dadosFiltrados);
	}
}