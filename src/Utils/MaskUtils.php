<?php

namespace Utils;

class MaskUtils
{
	public static function formataCpfCnpj($cpfCnpj)
	{
		if (strlen($cpfCnpj) == 14) {
			//XX.XXX.XXX/0001-XX
			$retorno = substr_replace($cpfCnpj, '.', 2, 0);
			$retorno = substr_replace($retorno, '.', 6, 0);
			$retorno = substr_replace($retorno, '/', 10, 0);
			$retorno = substr_replace($retorno, '-', 15, 0);
		} else {
			//XXX.XXX.XXX-XX
			$retorno = substr_replace($cpfCnpj, '.', 3, 0);
			$retorno = substr_replace($retorno, '.', 7, 0);
			$retorno = substr_replace($retorno, '-', 11, 0);
		}

		return $retorno;
	}
}