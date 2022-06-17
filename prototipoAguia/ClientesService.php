<?php

use Utils\HtmlUtils;

require_once('conexao.php');
	require_once('utils.php');
	$conexao = new Conexao();

	class ClientesService{
		public function getDadosClientesFormatados(){
			$conexao = new Conexao();
			$clientes = $conexao->executarQuery("SELECT * FROM clientes");
			return $this->formatarDadosClientes($clientes);
		}

		private function formatarDadosClientes($clientes){
			foreach($clientes as $idCliente => $cliente){
				$clientes[$idCliente]['data_nascimento'] = HtmlUtils::formataData($cliente['data_nascimento']);
				$clientes[$idCliente]['telefone'] = HtmlUtils::formataTelefone($cliente['telefone']);
				$clientes[$idCliente]['cpf_cnpj'] = HtmlUtils::formataCpfCnpj($cliente['cpf_cnpj']);
				$clientes[$idCliente]['endereco'] = HtmlUtils::formataEnderecoCliente($cliente);
			}
			
			return $clientes;
		}
	}
?>