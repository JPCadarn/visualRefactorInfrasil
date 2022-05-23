<?php

namespace Services;

use Conexao;
use Exception;
use InfrasilHtml;
use PDO;
use Utils;

class PontesService extends AbstractService
{
    public function listarPontes($dadosRequisicao)
    {
        $pontes = [];

		$limit = Utils::getLimitGrid($dadosRequisicao['page']);
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

	public function gerarFormularioCadastroPonte($dadosRequisicao)
	{
		$grid = InfrasilHtml::montarFormPontes($dadosRequisicao['numeroModal'] + 1);

		return [
			'html' => $grid['html'],
			'status' => 200,
			'idModal' => $grid['idModal']
		];
	}
}