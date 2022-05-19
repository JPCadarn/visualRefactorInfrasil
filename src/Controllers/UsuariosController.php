<?php

namespace Controllers;

use Conexao;
use Services\UsuariosService;

class UsuariosController
{
    public function fazerLogin($dadosRequisicao)
    {
        $conexao = Conexao::conectar();
		$UsuariosService = new UsuariosService();
		$UsuariosService->setConexao($conexao);

		return $UsuariosService->fazerLogin($dadosRequisicao);
    }
}