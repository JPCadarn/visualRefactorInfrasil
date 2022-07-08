<?php

namespace Services;

class SessionService
{
    public static function getIdClienteLogado()
    {
        if(session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        return $_SESSION['idCliente'] ?? 0;
    }

    public static function getIdUsuarioLogado()
    {
        if(session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        return $_SESSION['idUsuario'] ?? 0;
    }

	public static function setDadosLogin($dadosUsuario)
	{
        if(session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

		$_SESSION['idUsuario'] = $dadosUsuario['id'];
		$_SESSION['tipoUsuario'] = $dadosUsuario['tipo'];
		$_SESSION['idCliente'] = $dadosUsuario['id_cliente'];
	}

	public static function getTipoUsuarioLogado()
	{
        if(session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

		return $_SESSION['tipoUsuario'] ?? '';
	}

    public static function fazerLogout()
    {
        if(session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        session_destroy();
    }
}