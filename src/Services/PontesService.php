<?php

namespace Services;

use Conexao;
use Exception;
use InfrasilHtml;
use PDO;

class PontesService
{
    private PDO $conexao;
    private int $idUsuario;
    private int $idCliente;

    public function listarPontes($dadosRequisicao)
    {
        $_SESSION['idCliente'] = 1;
        $html = '';
        $pontes = [];

        $limit = '0, 10';
        $sql = '
            SELECT 
                pontes.id, 
                pontes.nome, 
                pontes.data_construcao
            FROM pontes
                INNER JOIN usuarios ON pontes.id_usuario = usuarios.id 
                INNER JOIN clientes ON usuarios.id_cliente = clientes.id 
            WHERE clientes.id = :idCliente
            LIMIT '. $limit;
        $idCliente = SessionService::getIdClienteLogado();

        try {
            $this->conexao->beginTransaction();
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
            $stmt->execute();
            $pontes = $stmt->fetchAll();
            $this->conexao->commit();
        }catch (Exception $e){
            $mensagemErro = $e->getMessage();
            $this->conexao->rollBack();
        }

        $grid = InfrasilHtml::montarGridPontes($pontes, ($dadosRequisicao['numeroModal'] + 1));

        return [
            'html' => $grid['html'],
            'status' => 200,
            'idModal' => $grid['idModal']
        ];
    }

    /**
     * @return int
     */
    public function getIdUsuario(): int
    {
        return $this->idUsuario;
    }

    /**
     * @param int $idUsuario
     */
    public function setIdUsuario(int $idUsuario): void
    {
        $this->idUsuario = $idUsuario;
    }

    /**
     * @return int
     */
    public function getIdCliente(): int
    {
        return $this->idCliente;
    }

    /**
     * @param int $idCliente
     */
    public function setIdCliente(int $idCliente): void
    {
        $this->idCliente = $idCliente;
    }

    /**
     * @return PDO
     */
    public function getConexao(): PDO
    {
        return $this->conexao;
    }

    /**
     * @param PDO $conexao
     */
    public function setConexao(PDO $conexao): void
    {
        $this->conexao = $conexao;
    }
}