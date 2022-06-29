<?php

namespace Services;

use Exception;
use InfrasilHtml;

class ClientesService extends AbstractService
{
	public function listarClientes($dadosRequisicao)
	{
		$clientes = [];

		$sql = '
			SELECT 
			    id,
			    nome,
			    data_nascimento,
			    cpf_cnpj,
			    email
			FROM clientes
		';

		try{
			$this->conexao->beginTransaction();
			$statement = $this->conexao->prepare($sql);
			$statement->execute();
			$clientes = $statement->fetchAll();

			$grid = InfrasilHtml::montarGridClientes($clientes, $dadosRequisicao['numeroModal']);

			return [
				'html' => $grid['html'],
				'status' => 200,
				'idModal' => $grid['idModal']
			];
		}catch(Exception $e){
			$this->conexao->rollBack();
		}
	}

	public function gerarFormularioCadastroCliente($dadosRequisicao)
	{
		$grid = InfrasilHtml::montarFormCliente($dadosRequisicao['numeroModal'] + 1);

		return [
			'html' => $grid['html'],
			'status' => 200,
			'idModal' => $grid['idModal']
		];
	}

	public function gerarFormularioEdicaoCliente($dadosRequisicao)
	{
		try{
			$this->conexao->beginTransaction();
			$sql = "SELECT * FROM clientes WHERE id = :id";
			$statement = $this->conexao->prepare($sql);
			$statement->bindParam(':id', $dadosRequisicao['id']);
			$statement->execute();
			$dadosCliente = $statement->fetch();
			$this->conexao->commit();
		}catch(Exception $e){
			$this->conexao->rollBack();
		}

		$grid = InfrasilHtml::montarFormEdicaoCliente($dadosRequisicao['numeroModal'] + 1, $dadosCliente);

		return [
			'html' => $grid['html'],
			'status' => 200,
			'idModal' => $grid['idModal']
		];
	}
}