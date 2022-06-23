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

		$dadosFiltrados = UsuariosFilter::gerarFormularioCadastroUsuarioFilter($dadosRequisicao);

		return $UsuariosService->gerarFormularioCadastroUsuario($dadosFiltrados);
	}

	public function adicionarUsuario($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$UsuariosService = new UsuariosService();
		$UsuariosService->setConexao($conexao);

		$dadosFiltrados = UsuariosFilter::adicionarUsuarioFilter($dadosRequisicao);

		return $UsuariosService->adicionarUsuario($dadosFiltrados);
	}

	public function gerarFormularioEdicaoUsuario($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$UsuariosService = new UsuariosService();
		$UsuariosService->setConexao($conexao);

		$dadosFiltrados = UsuariosFilter::gerarFormularioEdicaoUsuarioFilter($dadosRequisicao);

		return $UsuariosService->gerarFormularioEdicaoUsuario($dadosFiltrados);
	}

	public function editarUsuario($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$UsuariosService = new UsuariosService();
		$UsuariosService->setConexao($conexao);

		$dadosFilter = UsuariosFilter::editarUsuarioFilter($dadosRequisicao);

		return $UsuariosService->editarUsuario($dadosRequisicao);
	}
}