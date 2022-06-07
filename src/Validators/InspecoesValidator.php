<?php

namespace Validators;

class InspecoesValidator
{
	public static function avaliarInspecaoValidate($dadosUpdate)
	{
		$erros = [];

		$camposRequeridos = [
			'id_inspecao' => 'Inspeção Inválida!',
			'nota_indice_localizacao' => 'Por favor, preencha o campo Índice de Localização',
			'nota_indice_volume_trafego' => 'Por favor, preencha o campo Índice de Volume de Tráfego',
			'nota_indice_largura_oae' => 'Por favor, preencha o campo Índice de Largura da OAE',
			'nota_geometria_condicoes' => 'Por favor, preencha o campo Geometria e condições viárias',
			'nota_acessos' => 'Por favor, preencha o campo Acessos',
			'nota_cursos_agua' => 'Por favor, preencha o campo Cursos d\'água',
			'nota_encontros_fundacoes' => 'Por favor, preencha o campo Encontros e fundações',
			'nota_apoios_intermediarios' => 'Por favor, preencha o campo Apoios intermediários',
			'nota_aparelhos_apoio' => 'Por favor, preencha o campo Aparelhos de apoio',
			'nota_superestrutura' => 'Por favor, preencha o campo Superestrutura',
			'nota_pista_rolamento' => 'Por favor, preencha o campo Pista de rolamento',
			'nota_juntas_dilatacao' => 'Por favor, preencha o campo Juntas de dilatação',
			'nota_barreiras_guardacorpos' => 'Por favor, preencha o campo Barreiras e guarda-corpos',
			'nota_sinalizacao' => 'Por favor, preencha o campo Sinalização',
			'nota_instalacoes_util_publica' => 'Por favor, preencha o campo Instalações de utilidade pública',
			'nota_largura_plataforma' => 'Por favor, preencha o campo Largura da plataforma',
			'nota_capacidade_carga' => 'Por favor, preencha o campo Capacidade de carga',
			'nota_superficie_plataforma' => 'Por favor, preencha o campo Superfície da plataforma',
			'nota_pista_rolamento_fc' => 'Por favor, preencha o campo Pista de rolamento',
			'nota_outros_fc' => 'Por favor, preencha o campo Outros',
			'nota_espaco_livre' => 'Por favor, preencha o campo Espaço livre',
			'nota_localizacao_ponte' => 'Por favor, preencha o campo Localização da Ponte',
			'nota_saude_fisica_ponte' => 'Por favor, preencha o campo Saúde física da ponte',
			'nota_outros_fi' => 'Por favor, preencha o campo Outros',
			'obs' => 'Por favor, preencha o campo Resumo'
		];

		foreach($dadosUpdate as $key => $value){
			if(array_key_exists($key, $camposRequeridos) && empty($value)){
				$erros[] = $camposRequeridos[$key];
			}
		}

		return $erros;
	}
}