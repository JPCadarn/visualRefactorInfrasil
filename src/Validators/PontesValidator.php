<?php

namespace Validators;

class PontesValidator
{
	public static function adicionarOaeValidate($dadosInsert)
	{
		$erros = [];

		$camposRequeridos = [
			'via' => 'Por favor, preencha o campo Via.',
			'nome' => 'Por favor, preencha o campo Nome.',
			'latitude' => 'Por favor, preencha o campo Latitude.',
			'longitude' => 'Por favor, preencha o campo Longitude.',
			'resumo' => 'Por favor, preencha o campo Resumo.'
		];

		foreach($dadosInsert as $key => $value){
			if(array_key_exists($key, $camposRequeridos) && empty($value)){
				$erros[] = $camposRequeridos[$key];
			}
		}

		if(empty($_FILES)){
			$erros[] = 'Por favor, insira ao menos uma imagem para a OAE';
		}

		return $erros;
	}

	public static function detalhesPonteValidator($dadosSelect){
		$erros = [];

		$camposRequeridos = [
			'idOae' => 'A OAE selecionada é inválida'
		];

		foreach($dadosSelect as $key => $value){
			if(array_key_exists($key, $camposRequeridos) && empty($value)){
				$erros[] = $camposRequeridos[$key];
			}
		}

		return $erros;
	}
}