<?php

namespace Filters;

class AbstractFilter
{
    protected static function limparCamposRequisicao($camposRequisicao)
    {
		return array_map('htmlspecialchars', $camposRequisicao);
    }
}