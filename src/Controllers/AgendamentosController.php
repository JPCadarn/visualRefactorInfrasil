<?php

namespace Controllers;

use Conexao;
use Filters\AgendamentosFilter;
use Services\AgendamentosService;
use Services\SessionService;

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
		$dadosRequisicao['id_usuario'] = SessionService::getIdUsuarioLogado();

		$dadosFiltrados = AgendamentosFilter::adicionarAgendamentoFilter($dadosRequisicao);

		return $AgendamentosService->adicionarAgendamento($dadosFiltrados);
	}

	public function editarAgendamento($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$AgendamentosService = new AgendamentosService();
		$AgendamentosService->setConexao($conexao);
		$dadosRequisicao['id_usuario'] = SessionService::getIdUsuarioLogado();

		$dadosFiltrados = AgendamentosFilter::editarAgendamentoFilter($dadosRequisicao);

		return $AgendamentosService->editarAgendamento($dadosFiltrados);
	}

	public function gerarFormularioEdicaoAgendamento($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$AgendamentosService = new AgendamentosService();
		$AgendamentosService->setConexao($conexao);

		$dadosFiltrados = AgendamentosFilter::gerarFormularioEdicaoAgendamentoFilter($dadosRequisicao);

		return $AgendamentosService->gerarFormularioEdicaoAgendamento($dadosFiltrados);
	}
}