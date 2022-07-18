<?php

namespace Services;

use Exception;
use InfrasilHtml;
use Validators\ClientesValidator;

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
				'idModal' => $grid['idModal'],
                'idTable' => $grid['idTable']
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

	public function adicionarCliente($dadosRequisicao)
	{
		$erros = ClientesValidator::adicionarClienteValidate($dadosRequisicao);

		if(count($erros)){
			return [
				'status' => 200,
				'type' => 'error',
				'errors' => $erros
			];
		}

		try{
			$this->conexao->beginTransaction();
			$sql = '
				INSERT INTO clientes
				(nome, data_nascimento, cpf_cnpj, telefone, email, cep, endereco, bairro, numero, complemento, estado, cidade, referencia)
				VALUES
				(:nome, :data_nascimento, :cpf_cnpj, :telefone, :email, :cep, :endereco, :bairro, :numero, :complemento, :estado, :cidade, :referencia)
			';
			$statement = $this->conexao->prepare($sql);
			foreach($dadosRequisicao as $key => $value){
				$statement->bindValue(':'.$key, $value);
			}
			$statement->execute();
			$idInserido = $this->conexao->lastInsertId();
			$this->conexao->commit();
			return [
				'id' => $idInserido,
				'status' => 200,
				'type' => 'success',
				'message' => 'Cliente cadastrado com sucesso.'
			];
		}catch(Exception $e){
            echo '<pre>';

            $statement->debugDumpParams();
            exit;
			$this->conexao->rollBack();
			return [
				'status' => $e->getCode(),
				'errors' => [
					'Ocorreu um erro ao cadastrar o cliente. Tente novamente e contate o suporte técnico caso o erro persista.'
				],
				'type' => 'error'
			];
		}
	}

	public function editarCliente($dadosRequisicao)
	{
		$erros = ClientesValidator::adicionarClienteValidate($dadosRequisicao);

		if(count($erros)){
			return [
				'status' => 200,
				'type' => 'error',
				'errors' => $erros
			];
		}

		try{
			$this->conexao->beginTransaction();
			$sql = '
				UPDATE clientes
				SET
					nome = :nome,
					data_nascimento = :data_nascimento,
					cpf_cnpj = :cpf_cnpj,
					telefone = :telefone,
					email = :email,
					cep = :cep,
					endereco = :endereco,
					bairro = :bairro,
					numero = :numero,
					complemento = :complemento,
					estado = :estado,
					cidade = :cidade,
					referencia = :referencia
				WHERE id = :id
			';
			$statement = $this->conexao->prepare($sql);
			foreach($dadosRequisicao as $key => $value){
				$statement->bindValue(':'.$key, $value);
			}
			$statement->execute();
			$idInserido = $this->conexao->lastInsertId();
			$this->conexao->commit();
			return [
				'id' => $idInserido,
				'status' => 200,
				'type' => 'success',
				'message' => 'Cliente atualizado com sucesso.'
			];
		}catch(Exception $e){
			$this->conexao->rollBack();
			return [
				'status' => $e->getCode(),
				'errors' => [
					'Ocorreu um erro ao atualizar o cliente. Tente novamente e contate o suporte técnico caso o erro persista.'
				],
				'type' => 'error'
			];
		}
	}

	public function excluirCliente($dadosRequisicao)
	{
		try{
			$this->conexao->beginTransaction();
			$sql = 'DELETE FROM clientes WHERE id = : idCliente';
			$statement = $this->conexao->prepare($sql);
			$statement->bindParam(':idCliente', $dadosRequisicao['id']);
			$statement->execute();
			$this->conexao->commit();
			return [
				'status' => 200,
				'type' => 'success',
				'message' => 'Cliente excluído com sucesso.'
			];
		}catch(Exception $e){
			$this->conexao->rollBack();
			return [
				'status' => $e->getCode(),
				'errors' => [
					'Ocorreu um erro ao excluir o Cliente. Tente novamente e contate o suporte técnico caso o erro persista.'
				],
				'type' => 'error'
			];
		}
	}
}