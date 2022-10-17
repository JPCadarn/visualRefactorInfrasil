<?php

namespace Services;

use Exception;
use InfrasilHtml;
use PDO;
use Utils\HtmlUtils;
use Validators\InspecoesValidator;

class InspecoesService extends AbstractService
{
    const ALFA1 = 0.4;
    const ALFA2 = 0.6;

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
			JOIN inspecoes ON pontes.id = inspecoes.ponte_id 
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

    public function getDadosDashboard(array $dadosFiltrados)
    {
        $sql = 'SELECT 
				i.*,
				p.nome AS ponte_nome
			FROM inspecoes i
			JOIN pontes p ON i.ponte_id = p.id
			LEFT JOIN usuarios ON p.id_usuario = usuarios.id 
			LEFT JOIN clientes ON usuarios.id_cliente = clientes.id
			WHERE clientes.id = :idCliente AND i.status = :statusAvaliado';
        $statusAvaliado = 'Avaliado';

		$sqlProximasAvaliacoes = '
			SELECT i.id, p.nome, i.data_inspecao, i.tipo_inspecao
			FROM inspecoes i 
			JOIN pontes p ON i.ponte_id = p.id
			JOIN usuarios u ON p.id_usuario = u.id 
			JOIN clientes c ON u.id_cliente = c.id
			WHERE c.id = :idCliente AND i.status = :statusAberto
		';
		$statusAberto = 'Aberto';
		$grupos = [];
		$indicesManutencaoPrioritaria = [];

        try {
            $this->conexao->beginTransaction();
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':idCliente', $dadosFiltrados['idCliente']);
            $statement->bindParam(':statusAvaliado', $statusAvaliado);
            $statement->execute();
            $dadosGrafico = $statement->fetchAll();

			$statementProximasInspecoes = $this->conexao->prepare($sqlProximasAvaliacoes);
			$statementProximasInspecoes->bindParam(':idCliente', $dadosFiltrados['idCliente']);
			$statementProximasInspecoes->bindParam(':statusAberto', $statusAberto);
			$statementProximasInspecoes->execute();
			$dadosProximasInspecoes = $statementProximasInspecoes->fetchAll();

			foreach($dadosGrafico as $inspecao){
				$imp = $this->calcularIMP($inspecao)['imp'];
				$indicesManutencaoPrioritaria[] = $imp;
				$grupos[intval($imp/20)+1][] = $imp;
			}

            $this->conexao->commit();

            return [
				'dadosGrafico' => $this->agruparDadosGrafico($grupos),
				'proximasInspecoes' => $dadosProximasInspecoes,
				'manutencoesPrioritarias' => $this->montarManutencoesPrioritarias($indicesManutencaoPrioritaria)
			];
        } catch (Exception $exception) {
            echo '<pre>';
            print_r($exception);
            exit;
            $this->conexao->rollBack();
            return [
                'status' => $exception->getCode(),
                'errors' => [
                    'Ocorreu um erro ao buscar os dados do gráfico. Tente novamente e contate o suporte técnico caso o erro persista.'
                ],
                'type' => 'error'
            ];
        }
    }

    private function agruparDadosGrafico(array $dadosGrafico)
    {
        $grupos = [];
        return [
            'countUm' => isset($grupos[1]) ? count($grupos[1]) : 0,
            'countDois' => isset($grupos[2]) ? count($grupos[2]) : 0,
            'countTres' => isset($grupos[3]) ? count($grupos[3]) : 0,
            'countQuatro' => isset($grupos[4]) ? count($grupos[4]) : 0,
            'countCinco' => isset($grupos[5]) ? count($grupos[5]) : 0
        ];
    }

    public function calcularIMP($inspecao){
        $indiceValorSocial = $this->calcularIndiceValorSocial($inspecao);
        $indiceSaudeEstrutura = $this->calcularIndiceSaudeEstrutura($inspecao);
        $imp = self::ALFA1 * $indiceValorSocial + self::ALFA2 * $indiceSaudeEstrutura;
        return [
            'ivs' => $indiceValorSocial,
            'ise' => $indiceSaudeEstrutura,
            'imp' => $imp,
            'descricao' => substr($inspecao['nome'], 0, 50),
            'id' => $inspecao['id'],
            'ponte_id' => $inspecao['ponte_id'],
            'data_inspecao' => $inspecao['data_inspecao'],
            'ponte_nome' => $inspecao['ponte_nome'],
            'tipo_inspecao' => $inspecao['tipo_inspecao']
        ];
    }

    public function calcularIndiceValorSocial($inspecao){
        return $inspecao['nota_indice_localizacao'] + $inspecao['nota_indice_volume_trafego'] + $inspecao['nota_indice_largura_oae'];
    }

    public function calcularIndiceSaudeEstrutura($inspecao){
        $fatorSeguranca = $this->calcularFatorSeguranca($inspecao);
        $fatorConservacao = $this->calcularFatorConservacao($inspecao);
        $fatorImpacto = $this->calcularFatorImpacto($inspecao);
        return $fatorSeguranca + $fatorConservacao + $fatorImpacto;
    }

    private function calcularFatorSeguranca($inspecao){
        return $inspecao['nota_geometria_condicoes'] +
            $inspecao['nota_acessos'] +
            $inspecao['nota_cursos_agua'] +
            $inspecao['nota_encontros_fundacoes'] +
            $inspecao['nota_apoios_intermediarios'] +
            $inspecao['nota_aparelhos_apoio'] +
            $inspecao['nota_superestrutura'] +
            $inspecao['nota_pista_rolamento'] +
            $inspecao['nota_juntas_dilatacao'] +
            $inspecao['nota_barreiras_guardacorpos'] +
            $inspecao['nota_sinalizacao'] +
            $inspecao['nota_instalacoes_util_publica'];
    }

    private function calcularFatorConservacao($inspecao){
        return $inspecao['nota_largura_plataforma'] +
            $inspecao['nota_capacidade_carga'] +
            $inspecao['nota_superficie_plataforma'] +
            $inspecao['nota_pista_rolamento_fc'] +
            $inspecao['nota_outros_fc'];
    }

    private function calcularFatorImpacto($inspecao){
        return $inspecao['nota_espaco_livre'] +
            $inspecao['nota_localizacao_ponte'] +
            $inspecao['nota_saude_fisica_ponte'] +
            $inspecao['nota_outros_fi'];
    }

	private function montarManutencoesPrioritarias(bool|array $indicesManutencaoPrioritaria)
	{
		$indicesManutencaoPrioritaria = array_slice($indicesManutencaoPrioritaria, 0, 5);
		rsort($indicesManutencaoPrioritaria, SORT_NUMERIC);

		return $indicesManutencaoPrioritaria;
	}
}