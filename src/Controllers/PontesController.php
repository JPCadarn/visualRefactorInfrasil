<?php

namespace Controllers;

use Conexao;
use Filters\PontesFilter;
use Services\PontesService;

class PontesController
{
    private int $idCliente;
    private int $idUsuario;

    /**
     * Método para listar todas as pontes, filtrando por idCliente e idUsuario
     * @return array
	 */
    public function listarPontes($dadosRequisicao)
    {
        $conexao = Conexao::conectar();
        $PontesService = new PontesService();
        $PontesService->setConexao($conexao);

        $dadosFiltrados = PontesFilter::listarPontesFilter($dadosRequisicao);

        return $PontesService->listarPontes($dadosFiltrados);
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