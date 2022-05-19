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
}