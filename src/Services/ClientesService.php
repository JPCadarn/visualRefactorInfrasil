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
}