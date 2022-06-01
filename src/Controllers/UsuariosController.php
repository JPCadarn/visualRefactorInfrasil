<?php

namespace Controllers;

use Conexao;
use Filters\UsuariosFilter;
use Services\UsuariosService;

class UsuariosController
{
    public function fazerLogin($dadosRequisicao)
    {
        $conexao = Conexao::conectar();
		$UsuariosService = new UsuariosService();
		$UsuariosService->setConexao($conexao);

		$dadosFiltrados = UsuariosFilter::loginFilter($dadosRequisicao);

		return $UsuariosService->fazerLogin($dadosFiltrados);
    }

	public function listarUsuarios($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$UsuariosService = new UsuariosService();
		$UsuariosService->setConexao($conexao);

		$dadosFiltrados = UsuariosFilter::listarUsuariosFilter($dadosRequisicao);

		return $UsuariosService->listarUsuarios($dadosFiltrados);
	}

	public function gerarFormularioCadastroUsuario($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$UsuariosService = new UsuariosService();
		$UsuariosService->setConexao($conexao);

		$dadosFiltrados = AgendamentosFilter::gerarFormularioCadastroUsuarioFilter($dadosRequisicao);

		return $UsuariosService->gerarFormularioCadastroUsuario($dadosFiltrados);
	}

	public function gerarFormularioEdicaoUsuario($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$UsuariosService = new UsuariosService();
		$UsuariosService->setConexao($conexao);

		$dadosFiltrados = AgendamentosFilter::gerarFormularioEdicaoUsuarioFilter($dadosRequisicao);

		return $UsuariosService->gerarFormularioEdicaoCliente($dadosFiltrados);
	}
}