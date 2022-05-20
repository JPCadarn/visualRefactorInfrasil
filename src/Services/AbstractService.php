<?php

namespace Services;

use PDO;

class AbstractService
{
	protected PDO $conexao;

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