<?php

namespace Services;

use Exception;
use InfrasilHtml;
use Utils\HtmlUtils;

class UsuariosService extends AbstractService
{
	public function fazerLogin($dadosLogin)
	{
		$sql = '
			SELECT usuarios.id, usuarios.senha, usuarios.email, usuarios.tipo, usuarios.id_cliente
			FROM usuarios
			WHERE usuarios.email = :email
		';

		try {
			$this->conexao->beginTransaction();
			$stmt = $this->conexao->prepare($sql);
			$stmt->bindParam(':email', $dadosLogin['usuario']);
			$stmt->execute();
			$retornoUsuario = $stmt->fetch();
			if(empty($retornoUsuario)){
				return [
					'status' => 403,
					'type' => 'error',
					'message' => 'Erro ao realizer login, verifique os dados informados.'
				];
			}else {
				if (password_verify($dadosLogin['senha'], $retornoUsuario['senha'])) {
					SessionService::setDadosLogin($retornoUsuario);
					return [
						'status' => 200,
						'type' => 'success',
						'message' => 'Login efetuado com sucesso!'
					];
				}else{
					return [
						'status' => 403,
						'type' => 'error',
						'message' => 'Erro ao realizer login, verifique os dados informados.'
					];
				}
			}
		}catch (Exception $e){
			$this->conexao->rollBack();
		}
	}

	public function listarUsuarios($dadosRequisicao)
	{
		$usuarios = [];

		$limit = HtmlUtils::getLimitGrid($dadosRequisicao['page']);
		$sql = '
			SELECT id, nome, email, tipo
			FROM usuarios
			WHERE id_cliente = :idCliente
			LIMIT '.$limit;
		$idCliente = SessionService::getIdClienteLogado();

		try{
			$this->conexao->beginTransaction();
			$statement = $this->conexao->prepare($sql);
			$statement->bindParam('idCliente', $idCliente);
			$statement->execute();
			$usuarios = $statement->fetchAll();

			$grid = InfrasilHtml::montarGridUsuarios($usuarios, ($dadosRequisicao['numeroModal'] + 1));

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