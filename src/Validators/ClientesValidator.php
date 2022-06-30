<?php

namespace Validators;

class ClientesValidator {
	public static function adicionarClienteValidate($dadosInsert)
	{
		$erros = [];

		$camposRequeridos = [
			'nome' => 'Por favor, preencha o campo Nome.',
			'data_nascimento' => 'Por favor, preencha o campo Data de Nascimento',
			'cpf_cnpj' => 'Por favor, preencha o campo CPF/CNPJ',
			'telefone' => 'Por favor, preencha o campo Telefone',
			'email' => 'Por favor, preencha o campo Email',
			'cep' => 'Por favor, preencha o campo CEP',
			'endereco' => 'Por favor, preencha o campo Endereço',
			'bairro' => 'Por favor, preencha o campo Bairro',
			'numero' => 'Por favor, preencha o campo Número',
			'complemento' => 'Por favor, preencha o campo Complemento',
			'estado' => 'Por favor, preencha o campo Estado',
			'cidade' => 'Por favor, preencha o campo Cidade',
			'referencia' => 'Por favor, preencha o campo Referência'
		];

		foreach($dadosInsert as $key => $value){
			if(array_key_exists($key, $camposRequeridos) && empty($value)){
				$erros[] = $camposRequeridos[$key];
			}
		}

		return $erros;
	}
}