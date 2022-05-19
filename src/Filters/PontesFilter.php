<?php

namespace Filters;

class PontesFilter
{
    public static function listarPontesFilter($dadosRequisicao)
    {
        $dadosFiltrados = [];

        $dadosFiltrados['page'] = $dadosRequisicao['page'];
        $dadosFiltrados['numeroModal'] = $dadosRequisicao['numeroModal'];

        return $dadosFiltrados;
    }
}