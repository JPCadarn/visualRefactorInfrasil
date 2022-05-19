<?php

namespace Controllers;

use Filters\PontesFilter;
use Services\PontesService;

class PontesController
{
    private int $idCliente;
    private int $idUsuario;

    /**
     * Método para listar todas as pontes, filtrando por idCliente e idUsuario
     * @return string
     */
    public function listarPontes($dadosRequisicao)
    {
        $PontesService = new PontesService();
        $dadosRequisicao = PontesFilter::listarPontesFilter($dadosRequisicao);

        return $PontesService->listarPontes($dadosRequisicao);
    }

    /**
     * @return mixed
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    /**
     * @param mixed $idCliente
     */
    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;
    }

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @param mixed $idUsuario
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }
}