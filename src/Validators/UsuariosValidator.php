<?php

namespace Validators;

class UsuariosValidator {
	public static function adicionarUsuarioValidate($dadosInsert, $chaveCliente)
	{
		$erros = [];

		$camposRequeridos = [
			'nome' => 'O nome é obrigatório.',
			'senha' => 'A senha é obrigatória.',
			'email' => 'O email é obrigatório',
			'chave' => 'A chave de cliente é obrigatória.',
			'tipo' => 'O tipo de cliente é obrigatório.'
		];

		foreach($dadosInsert as $key => $value){
			if(array_key_exists($key, $camposRequeridos) && empty($value)){
				$erros[] = $camposRequeridos[$key];
			}
		}

		if(!empty($chaveCliente)){
			$erros[] = 'A chave informada não corresponde a nenhum cliente';
		}

		return $erros;
	}
}