<?php

class Utils
{
	public static function getLimitGrid($numeroPagina)
	{
		$maior = 10 * $numeroPagina;
		$menor = $maior - 10;

		return $menor.', '.$maior;
	}
}