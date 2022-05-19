<?php

namespace Services;

class SessionService
{
    public static function getIdClienteLogado()
    {
        return $_SESSION['idCliente'] ?? 0;
    }

    public static function getIdUsuarioLogado()
    {
        return $_SESSION['idUsuario'] ?? 0;
    }
}