<?php

namespace Services;

use Exception;
use InfrasilHtml;
use PDO;
use Utils\HtmlUtils;
use Validators\AgendamentosValidator;

class AgendamentosService extends AbstractService
{
	public function listarAgendamentos(array $dadosRequisicao)
	{
		$agendamentos = [];

		$limit = HtmlUtils::getLimitGrid($dadosRequisicao['page']);
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
		$sql = "
			SELECT pontes.nome, pontes.id
			FROM pontes
			LEFT JOIN usuarios ON pontes.id_usuario = usuarios.id 
			LEFT JOIN clientes ON usuarios.id_cliente = clientes.id
			WHERE clientes.id = :idCliente";
		try{
			$this->conexao->beginTransaction();
			$stmt = $this->conexao->prepare($sql);
			$idCliente = SessionService::getIdClienteLogado();
			$stmt->bindParam(':idCliente', $idCliente);
			$stmt->execute();
			$pontes = $stmt->fetchAll();
			$this->conexao->commit();
		}catch(Exception $e){
			$mensagemErro = $e->getMessage();
			$this->conexao->rollBack();
		}

		$grid = InfrasilHtml::montarFormAgendamentos($dadosRequisicao['numeroModal'] + 1, $pontes);

		return [
			'html' => $grid['html'],
			'status' => 200,
			'idModal' => $grid['idModal']
		];
	}

	public function adicionarAgendamento($dadosRequisicao)
	{
		$erros = AgendamentosValidator::adicionarAgendamentoValidate($dadosRequisicao);

		if(count($erros)){
			return [
				'status' => 200,
				'type' => 'error',
				'errors' => $erros
			];
		}
		$tipoInspecao = $dadosRequisicao['tipo_inspecao'];
		unset($dadosRequisicao['tipo_inspecao']);

		$sql = '
			INSERT INTO agendamentos
			(data, horario, detalhes, ponte_id, id_usuario)
			VALUES
			(:data, :horario, :detalhes, :ponte_id, :id_usuario)
		';

		try {
			$this->conexao->beginTransaction();
			$statement = $this->conexao->prepare($sql);
			foreach($dadosRequisicao as $key => $value){
				$statement->bindValue(':'.$key, $value);
			}
			$statement->execute();
			$idInserido = $this->conexao->lastInsertId();

			$nomeInspecao = 'Inspeção automática gerada pelo agendamento ID: '.$idInserido;
			$sqlInspecao = "
				INSERT INTO inspecoes
				(ponte_id, nome, descricao, tipo_inspecao, id_usuario, id_agendamento)
				VALUES
				(:ponte_id, :nome, :descricao, :tipo_inspecao, :id_usuario, :id_agendamento)
			";
			$statementInspecao = $this->conexao->prepare($sqlInspecao);
			$statementInspecao->bindParam(':ponte_id', $dadosRequisicao['ponte_id']);
			$statementInspecao->bindParam(':nome', $nomeInspecao);
			$statementInspecao->bindParam(':descricao', $dadosRequisicao['detalhes']);
			$statementInspecao->bindParam(':tipo_inspecao', $tipoInspecao);
			$statementInspecao->bindParam(':id_agendamento', $idInserido);

			$this->conexao->commit();
			return [
				'id' => $idInserido,
				'status' => 200,
				'type' => 'success',
				'message' => 'Agendamento cadastrado com sucesso.'
			];
		}catch (Exception $e){
			$this->conexao->rollBack();
			return [
				'status' => $e->getCode(),
				'errors' => [
					'Ocorreu um erro ao salvar o agendamento. Tente novamente e contate o suporte técnico caso o erro persista.'
				],
				'type' => 'error'
			];
		}
	}

	public function gerarFormularioEdicaoAgendamento($dadosRequisicao)
	{
		$grid = InfrasilHtml::montarFormEdicaoAgendamentos($dadosRequisicao['numeroModal'] + 1, $dadosRequisicao['id']);

		return [
			'html' => $grid['html'],
			'status' => 200,
			'idModal' => $grid['idModal']
		];
	}

	public function editarAgendamento($dadosRequisicao)
	{
		$erros = AgendamentosValidator::editarAgendamentoValidate($dadosRequisicao);

		if(count($erros)){
			return [
				'status' => 200,
				'type' => 'error',
				'errors' => $erros
			];
		}

		$sql = '
			UPDATE agendamentos
			SET data = :data, horario = :horario, detalhes = :detalhes
			WHERE id = :id
		';

		try {
			$this->conexao->beginTransaction();
			$statement = $this->conexao->prepare($sql);
			foreach($dadosRequisicao as $key => $value){
				$statement->bindValue(':'.$key, $value);
			}
			$statement->execute();

			$this->conexao->commit();
			return [
				'status' => 200,
				'type' => 'success',
				'message' => 'Agendamento editado com sucesso.'
			];
		}catch (Exception $e){
			$this->conexao->rollBack();
			return [
				'status' => $e->getCode(),
				'errors' => [
					'Ocorreu um erro ao editar o agendamento. Tente novamente e contate o suporte técnico caso o erro persista.'
				],
				'type' => 'error'
			];
		}
	}
}