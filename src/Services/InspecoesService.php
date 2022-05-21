<?php

namespace Services;

use Exception;
use InfrasilHtml;
use PDO;
use Utils;

class InspecoesService extends AbstractService
{
	public function listarInspecoes($dadosRequisicao)
	{
		$inspecoes = [];

		$limit = Utils::getLimitGrid($dadosRequisicao['page']);
		$sql = '
			SELECT 
				pontes.id, 
				pontes.nome AS ponte_nome, 
				inspecoes.nome, 
				inspecoes.descricao, 
				inspecoes.id AS id_inspecao, 
				inspecoes.status, 
				inspecoes.data_inspecao, 
				inspecoes.tipo_inspecao 
			FROM pontes 
			INNER JOIN inspecoes ON pontes.id = inspecoes.ponte_id 
			LEFT JOIN usuarios ON pontes.id_usuario = usuarios.id 
			LEFT JOIN clientes ON usuarios.id_cliente = clientes.id
			WHERE clientes.id = :idCliente
			LIMIT '.$limit;
		$idCliente = SessionService::getIdClienteLogado();

		try{
			$this->conexao->beginTransaction();
			$stmt = $this->conexao->prepare($sql);
			$stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
			$stmt->execute();
			$inspecoes = $stmt->fetchAll();
			$this->conexao->commit();
		}catch(Exception $e){
			$this->conexao->rollBack();
		}

		$grid = InfrasilHtml::montarGridInspecoes($inspecoes, ($dadosRequisicao['numeroModal'] + 1));

		return [
			'html' => $grid['html'],
			'status' => 200,
			'idModal' => $grid['idModal']
		];
	}
}