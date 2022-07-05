<?php

namespace Controllers;

use Conexao;
use Exception;
use Filters\UsuariosFilter;
use Services\SessionService;
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

		$dadosFiltrados = UsuariosFilter::editarUsuarioFilter($dadosRequisicao);

		return $UsuariosService->editarUsuario($dadosFiltrados);
	}

	public function listarConta($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$UsuariosService = new UsuariosService();
		$UsuariosService->setConexao($conexao);

		$dadosFiltrados = UsuariosFilter::listarContaFilter($dadosRequisicao);

		return $UsuariosService->listarConta($dadosFiltrados);
	}

	public function excluirUsuario($dadosRequisicao)
	{
		$conexao = Conexao::conectar();
		$UsuariosService = new UsuariosService();
		$UsuariosService->setConexao($conexao);

		$dadosFiltrados = UsuariosFilter::excluirUsuarioFilter($dadosRequisicao);

		return $UsuariosService->excluirUsuario($dadosFiltrados);
	}

    public function fazerLogout()
    {
        try {
            SessionService::fazerLogout();
            return [
                'status' => 200,
                'type' => 'success',
                'message' => 'Logout realizado com sucesso.',
                'redirect' => $_SERVER['HTTP_REFERER']
            ];
        } catch (Exception $exception) {
            return [
                'status' => 400,
                'type' => 'error',
                'message' => 'Erro ao realizar o logout',
                'logout' => false
            ];
        }

    }
}