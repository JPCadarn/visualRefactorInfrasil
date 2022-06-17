<?php

namespace Utils;

use DateTime;

class DateUtils
{
	public static function formatarData($data, $formato)
	{
		$Date = new DateTime($data);

		return $Date->format($formato);
	}


	public static function formatarDataBanco($data)
	{
		return implode('-', array_reverse(explode('/', $data)));
	}
}