<?php

namespace Services;

use Exception;
use InfrasilHtml;
use PDO;
use Utils;

class InspecoesService
{
	private PDO $conexao;

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