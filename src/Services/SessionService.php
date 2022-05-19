<?php

namespace Services;

class SessionService
{
    public static function getIdClienteLogado()
    {
		session_start();

        return $_SESSION['idCliente'] ?? 0;
    }

    public static function getIdUsuarioLogado()
    {
		session_start();

        return $_SESSION['idUsuario'] ?? 0;
    }

	public static function setDadosLogin($dadosUsuario)
	{
		session_start();

		$_SESSION['idUsuario'] = $dadosUsuario['id'];
		$_SESSION['tipoUsuario'] = $dadosUsuario['tipo'];
		$_SESSION['idCliente'] = $dadosUsuario['id_cliente'];
	}
}