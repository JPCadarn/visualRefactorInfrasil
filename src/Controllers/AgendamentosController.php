<?php

namespace Controllers;

use Conexao;
use Filters\AgendamentosFilter;
use Services\AgendamentosService;

class AgendamentosController
{
	public function listarAgendamentos($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$AgendamentosService = new AgendamentosService();
		$AgendamentosService->setConexao($conexao);

		$dadosFiltrados = AgendamentosFilter::listarAgendamentosFilter($dadosRequisicao);

		return $AgendamentosService->listarAgendamentos($dadosFiltrados);
	}

	public function gerarFormularioCadastroAgendamento($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$AgendamentosService = new AgendamentosService();
		$AgendamentosService->setConexao($conexao);

		$dadosFiltrados = AgendamentosFilter::gerarFormularioCadastroAgendamentoFilter($dadosRequisicao);

		return $AgendamentosService->gerarFormularioCadastroAgendamento($dadosFiltrados);
	}

	public function adicionarAgendamento($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$AgendamentosService = new AgendamentosService();
		$AgendamentosService->setConexao($conexao);

		$dadosFiltrados = AgendamentosFilter::adicionarAgendamentoFilter($dadosRequisicao);

		return $AgendamentosService->adicionarAgendamento();
	}
}