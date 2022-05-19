<?php

namespace Services;

use Exception;
use PDO;

class UsuariosService
{
	private PDO $conexao;

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

	/**
	 * @return PDO
	 */
	public function getConexao (): PDO
	{
		return $this->conexao;
	}

	/**
	 * @param PDO $conexao
	 */
	public function setConexao (PDO $conexao): void
	{
		$this->conexao = $conexao;
	}
}