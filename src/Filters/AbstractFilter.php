<?php

namespace Filters;

class AbstractFilter
{
    public static function limparCamposRequisicao($camposRequisicao)
    {
		return array_map('htmlspecialchars', $camposRequisicao);
    }
}