<?php

namespace Controllers;

use Conexao;
use Filters\PontesFilter;
use Services\PontesService;

class PontesController
{
    /**
     * Método para listar todas as pontes, filtrando por idCliente e idUsuario
     * @return array
	 */
    public function listarPontes($dadosRequisicao)
    {
        $conexao = Conexao::conectar();
        $PontesService = new PontesService();
        $PontesService->setConexao($conexao);

        $dadosFiltrados = PontesFilter::listarPontesFilter($dadosRequisicao);

		return $PontesService->listarPontes($dadosFiltrados);
    }

	public function gerarFormularioCadastroPonte($dadosRequisicao)
	{
		$PontesService = new PontesService();

		$dadosFiltrados = PontesFilter::gerarFormularioCadastroPonteFilter($dadosRequisicao);

		return $PontesService->gerarFormularioCadastroPonte($dadosRequisicao);
	}

	public function adicionarOae($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$PontesService = new PontesService();
		$PontesService->setConexao($conexao);

		$dadosFiltrados = PontesFilter::adicionarOaeFilter($dadosRequisicao);

		$campos = [];

		return $PontesService->adicionarOae($dadosFiltrados);
	}
}