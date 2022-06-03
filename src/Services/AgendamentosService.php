<?php

namespace Services;

use Exception;
use InfrasilHtml;
use PDO;
use Utils;

class AgendamentosService extends AbstractService
{
	public function listarAgendamentos(array $dadosRequisicao)
	{
		$agendamentos = [];

		$limit = Utils::getLimitGrid($dadosRequisicao['page']);
		$sql = '
			SELECT 
				a.*,
				p.nome AS ponte_nome
			FROM agendamentos a
			INNER JOIN pontes p ON a.ponte_id = p.id
			LEFT JOIN usuarios ON p.id_usuario = usuarios.id 
			LEFT JOIN clientes ON usuarios.id_cliente = clientes.id
			WHERE clientes.id = :idCliente
			LIMIT '.$limit;
		$idCliente = SessionService::getIdClienteLogado();

		try {
			$this->conexao->beginTransaction();
			$stmt = $this->conexao->prepare($sql);
			$stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
			$stmt->execute();
			$agendamentos = $stmt->fetchAll();
			$this->conexao->commit();
		}catch (Exception $e){
			$mensagemErro = $e->getMessage();
			$this->conexao->rollBack();
		}

		$grid = InfrasilHtml::montarGridAgendamentos($agendamentos, ($dadosRequisicao['numeroModal'] + 1));

		return [
			'html' => $grid['html'],
			'status' => 200,
			'idModal' => $grid['idModal']
		];
	}

	public function gerarFormularioCadastroAgendamento($dadosRequisicao)
	{
		$grid = InfrasilHtml::montarFormAgendamentos($dadosRequisicao['numeroModal'] + 1);

		return [
			'html' => $grid['html'],
			'status' => 200,
			'idModal' => $grid['idModal']
		];
	}
}