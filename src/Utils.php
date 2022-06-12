<?php

class Utils
{
	public static function getLimitGrid($numeroPagina)
	{
		$maior = 10 * $numeroPagina;
		$menor = $maior - 10;

		return $menor.', '.$maior;
	}

	public static function formatarData($data, $formato)
	{
		$Date = new DateTime($data);

		return $Date->format($formato);
	}


	public static function formatarDataBanco($data)
	{
		return implode('-', array_reverse(explode('/', $data)));
	}

	public static function formataCpfCnpj($cpfCnpj)
	{
		if(strlen($cpfCnpj) == 14){
			//XX.XXX.XXX/0001-XX
			$retorno = substr_replace($cpfCnpj, '.', 2, 0);
			$retorno = substr_replace($retorno, '.', 6, 0);
			$retorno = substr_replace($retorno, '/', 10, 0);
			$retorno = substr_replace($retorno, '-', 15, 0);
		}else{
			//XXX.XXX.XXX-XX
			$retorno = substr_replace($cpfCnpj, '.', 3, 0);
			$retorno = substr_replace($retorno, '.', 7, 0);
			$retorno = substr_replace($retorno, '-', 11, 0);
		}

		return $retorno;
	}
}