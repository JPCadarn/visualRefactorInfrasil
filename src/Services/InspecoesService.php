<?php

namespace Services;

use Exception;
use InfrasilHtml;
use PDO;
use Utils\HtmlUtils;
use Validators\InspecoesValidator;

class InspecoesService extends AbstractService
{
	public function listarInspecoes($dadosRequisicao)
	{
		$inspecoes = [];

		$sql = '
			SELECT 
				pontes.id, 
				pontes.nome AS ponte_nome, 
				inspecoes.nome, 
				inspecoes.descricao, 
				inspecoes.id AS id_inspecao, 
				inspecoes.status, 
				inspecoes.data_inspecao, 
				inspecoes.tipo_inspecao 
			FROM pontes 
			INNER JOIN inspecoes ON pontes.id = inspecoes.ponte_id 
			LEFT JOIN usuarios ON pontes.id_usuario = usuarios.id 
			LEFT JOIN clientes ON usuarios.id_cliente = clientes.id
			WHERE clientes.id = :idCliente';
		$idCliente = SessionService::getIdClienteLogado();

		try{
			$this->conexao->beginTransaction();
			$stmt = $this->conexao->prepare($sql);
			$stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
			$stmt->execute();
			$inspecoes = $stmt->fetchAll();
			$this->conexao->commit();
		}catch(Exception $e){
			$this->conexao->rollBack();
		}

		$grid = InfrasilHtml::montarGridInspecoes($inspecoes, ($dadosRequisicao['numeroModal'] + 1));

		return [
			'html' => $grid['html'],
			'status' => 200,
			'idModal' => $grid['idModal'],
            'idTable' => $grid['idTable']
		];
	}

	public function formularioAvaliacaoInspecao($dadosRequisicao)
	{
		$grid = InfrasilHtml::montarFormAvaliacao($dadosRequisicao['numeroModal'] + 1, $dadosRequisicao['id']);

		return [
			'html' => $grid['html'],
			'status' => 200,
			'idModal' => $grid['idModal']
		];
	}

	public function avaliarInspecao($dadosRequisicao)
	{
		$erros = InspecoesValidator::avaliarInspecaoValidate($dadosRequisicao);

		if(count($erros)){
			return [
				'status' => 200,
				'type' => 'error',
				'errors' => $erros
			];
		}

		$dadosRequisicao['status'] = 'Avaliado';
		$dadosRequisicao['data_inspecao'] = date('Y-m-d');

		$sql = '
			UPDATE inspecoes
			SET status = :status,
				nota_indice_localizacao = :nota_indice_localizacao,
				nota_indice_volume_trafego = :nota_indice_volume_trafego,
				nota_indice_largura_oae = :nota_indice_largura_oae,
				nota_geometria_condicoes = :nota_geometria_condicoes,
				nota_acessos = :nota_acessos,
				nota_cursos_agua = :nota_cursos_agua,
				nota_encontros_fundacoes = :nota_encontros_fundacoes,
				nota_apoios_intermediarios = :nota_apoios_intermediarios,
				nota_aparelhos_apoio = :nota_aparelhos_apoio,
				nota_superestrutura = :nota_superestrutura,
				nota_pista_rolamento = :nota_pista_rolamento,
				nota_juntas_dilatacao = :nota_juntas_dilatacao,
				nota_barreiras_guardacorpos = :nota_barreiras_guardacorpos,
				nota_sinalizacao = :nota_sinalizacao,
				nota_instalacoes_util_publica = :nota_instalacoes_util_publica,
				nota_largura_plataforma = :nota_largura_plataforma,
				nota_capacidade_carga = :nota_capacidade_carga,
				nota_superficie_plataforma = :nota_superficie_plataforma,
				nota_pista_rolamento_fc = :nota_pista_rolamento_fc,
				nota_outros_fc = :nota_outros_fc,
				nota_espaco_livre = :nota_espaco_livre,
				nota_localizacao_ponte = :nota_localizacao_ponte,
				nota_saude_fisica_ponte = :nota_saude_fisica_ponte,
				nota_outros_fi = :nota_outros_fi,
				obs = :obs,
				data_inspecao = :data_inspecao
			WHERE id = :id_inspecao
		';

		try{
			$this->conexao->beginTransaction();
			$statement = $this->conexao->prepare($sql);
			foreach($dadosRequisicao as $key => $value){
				$statement->bindValue(':'.$key, $value);
			}
			$statement->execute();
			$this->conexao->commit();
			return [
				'id' => $dadosRequisicao['id_inspecao'],
				'status' => 200,
				'type' => 'success',
				'message' => 'Inspeção avaliada com sucesso.'
			];
		}catch(Exception $e){
			$this->conexao->rollBack();
			return [
				'status' => $e->getCode(),
				'errors' => [
					'Ocorreu um erro ao avaliar a inspeção. Tente novamente e contate o suporte técnico caso o erro persista.'
				],
				'type' => 'error'
			];
		}
	}

	public function detalhesInspecao($dadosRequisicao)
	{
		$sqlInspecao = "SELECT * FROM inspecoes WHERE id = :id";
		$sqlImagens = "SELECT * FROM imagens_inspecoes WHERE inspecao_id = :inspecaoId";

		try{
			$this->conexao->beginTransaction();
			$statementInspecao = $this->conexao->prepare($sqlInspecao);
			$statementInspecao->bindParam(':id', $dadosRequisicao['id']);
			$statementInspecao->execute();
			$dadosInspecao = $statementInspecao->fetch();

			$statementImagens = $this->conexao->prepare($sqlImagens);
			$statementImagens->bindParam(':inspecaoId', $dadosInspecao['id']);
			$statementImagens->execute();
			$dadosInspecao['imagens'] = $statementImagens->fetchAll();
			$this->conexao->commit();

			$grid = InfrasilHtml::montarDetalhesInspecao($dadosRequisicao['numeroModal'] + 1, $dadosInspecao);

			return [
				'html' => $grid['html'],
				'status' => 200,
				'idModal' => $grid['idModal']
			];
		}catch(Exception $e){
			$this->conexao->rollBack();
			return [
				'status' => $e->getCode(),
				'errors' => [
					'Ocorreu um erro ao buscar a inspeção. Tente novamente e contate o suporte técnico caso o erro persista.'
				],
				'type' => 'error'
			];
		}
	}
}