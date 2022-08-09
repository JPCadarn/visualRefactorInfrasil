<?php

namespace Services;

use Exception;
use InfrasilHtml;
use PDO;
use Utils\HtmlUtils;
use Validators\PontesValidator;

class PontesService extends AbstractService
{
    public function listarPontes($dadosRequisicao)
    {
        $pontes = [];

        $sql = '
            SELECT 
                pontes.id, 
                pontes.nome, 
                pontes.data_construcao
            FROM pontes
                JOIN usuarios ON pontes.id_usuario = usuarios.id 
                JOIN clientes ON usuarios.id_cliente = clientes.id 
            WHERE clientes.id = :idCliente';
        $idCliente = SessionService::getIdClienteLogado();

        try {
            $this->conexao->beginTransaction();
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
            $stmt->execute();
            $pontes = $stmt->fetchAll();
            $this->conexao->commit();
        }catch (Exception $e){
            $mensagemErro = $e->getMessage();
            $this->conexao->rollBack();
        }

        $grid = InfrasilHtml::montarGridPontes($pontes, ($dadosRequisicao['numeroModal'] + 1));

        return [
            'html' => $grid['html'],
            'status' => 200,
            'idModal' => $grid['idModal'],
            'idTable' => $grid['idTable']
        ];
    }

	public function gerarFormularioCadastroPonte($dadosRequisicao)
	{
		$grid = InfrasilHtml::montarFormPontes($dadosRequisicao['numeroModal'] + 1);

		return [
			'html' => $grid['html'],
			'status' => 200,
			'idModal' => $grid['idModal']
		];
	}

	public function adicionarOae($dadosRequisicao)
	{
		$erros = PontesValidator::adicionarOaeValidate($dadosRequisicao);

		if(count($erros)){
			return [
				'status' => 200,
				'type' => 'error',
				'errors' => $erros
			];
		}

		$sql = '
			INSERT INTO pontes
			(via, nome, data_construcao, trem_tipo, sentido, localizacao, latitude, longitude, projetista, construtor, comprimento_estrutura, largura_estrutura, largura_acostamento, largura_refugio, largura_passeio, sistema_construtivo, natureza_transposicao, material_construcao, longitudinal_super, transversal_super, mesoestrutura_tipo, infraestrutura, nro_vaos, nro_apoios, nro_pilares_apoio, aparelhos_apoio, comprimento_vao_tipico, comprimento_maior_vao, altura_pilares, juntas_dilatacao, encontros, descricao, caracteristicas_plani, nro_faixas, acostamento, refugios, passeio, barreira_rigida, material_pavimento, pingadeiras, guarda_corpo, drenos, freq_passagem_carga, superestrutura, mesoestrutura, infraestrutura_anomalia, aparelhos_apoio_anomalia, juntas_dilatacao_anomalia, encontros_anomalia, pavimento_anomalia, acostamento_refugio_anomalia, drenagem_anomalia, guarda_corpo_anomalia, barreira_defesa, taludes, iluminacao, sinalizacao, protecao_pilares, resumo, id_usuario)
			VALUES
			(:via, :nome, :data_construcao, :trem_tipo, :sentido, :localizacao, :latitude, :longitude, :projetista, :construtor, :comprimento_estrutura, :largura_estrutura, :largura_acostamento, :largura_refugio, :largura_passeio, :sistema_construtivo, :natureza_transposicao, :material_construcao, :longitudinal_super, :transversal_super, :mesoestrutura_tipo, :infraestrutura, :nro_vaos, :nro_apoios, :nro_pilares_apoio, :aparelhos_apoio, :comprimento_vao_tipico, :comprimento_maior_vao, :altura_pilares, :juntas_dilatacao, :encontros, :descricao, :caracteristicas_plani, :nro_faixas, :acostamento, :refugios, :passeio, :barreira_rigida, :material_pavimento, :pingadeiras, :guarda_corpo, :drenos, :freq_passagem_carga, :superestrutura, :mesoestrutura, :infraestrutura_anomalia, :aparelhos_apoio_anomalia, :juntas_dilatacao_anomalia, :encontros_anomalia, :pavimento_anomalia, :acostamento_refugio_anomalia, :drenagem_anomalia, :guarda_corpo_anomalia, :barreira_defesa, :taludes, :iluminacao, :sinalizacao, :protecao_pilares, :resumo, :id_usuario)
		';

		try {
			$this->conexao->beginTransaction();
			$statement = $this->conexao->prepare($sql);
			foreach($dadosRequisicao as $key => $value){
				$statement->bindValue(':'.$key, $value);
			}
			$statement->execute();
			$idInserido = $this->conexao->lastInsertId();
			$this->conexao->commit();
			return [
				'id' => $idInserido,
				'status' => 200,
				'type' => 'success',
				'message' => 'Estrutura cadastrada com sucesso.'
			];
		}catch (Exception $e){
			$this->conexao->rollBack();
			return [
				'status' => $e->getCode(),
				'errors' => [
					'Ocorreu um erro ao salvar a estrutura. Tente novamente e contate o suporte técnico caso o erro persista.'
				],
				'type' => 'error'
			];
		}
	}

	public function detalhesPonte($dadosRequisicao)
	{
		$erros = PontesValidator::detalhesPonteValidator($dadosRequisicao);

		if(count($erros)){
			return [
				'status' => 200,
				'type' => 'error',
				'errors' => $erros
			];
		}

		$sqlOae = 'SELECT * FROM pontes WHERE id = :idOae';
		$sqlAdicional = '
			SELECT imagem 
			FROM imagens_pontes
			JOIN agendamentos ON imagens_pontes.ponte_id = agendamentos.ponte_id
			JOIN inspecoes ON imagens_pontes.ponte_id = inspecoes.ponte_id
			JOIN usuarios ON inspecoes.id_usuario = usuarios.id
			WHERE imagens_pontes.ponte_id = :idOae
		';

		try{
			$statementOae = $this->conexao->prepare($sqlOae);
			$statementAdicional = $this->conexao->prepare($sqlAdicional);

			$statementOae->bindParam(':idOae', $dadosRequisicao['id']);
			$statementAdicional->bindParam(':idOae', $dadosRequisicao['id']);
			$statementOae->execute();
			$statementAdicional->execute();

			$dadosOae = $statementOae->fetch();
			$dadosAdicionais = $statementAdicional->fetchAll();
			$this->conexao->commit();

			$detalhes = [
				'dadosOae' => $dadosOae,
				'dadosAdicionais' => $dadosAdicionais
			];
			
		}catch(Exception $e){
			$this->conexao->rollBack();
			return [
				'status' => $e->getCode(),
				'errors' => [
					'Ocorreu um erro ao buscar a estrutura. Tente novamente e contate o suporte técnico caso o erro persista.'
				],
				'type' => 'error'
			];
		}

		$form = InfrasilHtml::montarDetalhesOae($detalhes, ($dadosRequisicao['numeroModal'] + 1));

		return [
            'html' => $form['html'],
            'status' => 200,
            'idModal' => $form['idModal']
        ];
	}
}