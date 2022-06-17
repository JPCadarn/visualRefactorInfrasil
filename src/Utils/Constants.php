<?php

namespace Utils;

class Constants
{
	public const camposIndiceLocalizacao = [
		['nota' => 40, 'descricao' => 'Centro Urbano'],
		['nota' => 35, 'descricao' => 'Rodovia Federal'],
		['nota' => 25, 'descricao' => 'Rodovia Estadual'],
		['nota' => 15, 'descricao' => 'Área Urbana Municipal'],
		['nota' => 5, 'descricao' => 'Área Rural Municipal']
	];

	public const camposVolumeTrafego = [
		['nota' => 40, 'descricao' => 'Muito alto, com muitos engarrafamentos'],
		['nota' => 35, 'descricao' => 'Alto, com poucos engarrafamentos'],
		['nota' => 25, 'descricao' => 'Moderado, com ou sem engarrafamento'],
		['nota' => 15, 'descricao' => 'Baixo, sem engarrafamento'],
		['nota' => 5, 'descricao' => 'Muito baixo, sem engarrafamento']
	];

	public const camposLarguraOAE = [
		['nota' => 20, 'descricao' => 'Muito larga (maior que 17m) '],
		['nota' => 15, 'descricao' => 'Larga (14-17m)'],
		['nota' => 10, 'descricao' => 'Média (10-14m)'],
		['nota' => 6, 'descricao' => 'Estreita (6,5-10m)'],
		['nota' => 3, 'descricao' => 'Muito estreita (menos que 6,5m)']
	];

	public const camposFsPesoAlto = [
		['nota' => 5, 'descricao' => 'Precária'],
		['nota' => 3.75, 'descricao' => 'Sofrível'],
		['nota' => 2.5, 'descricao' => 'Boa aparentemente'],
		['nota' => 1.25, 'descricao' => 'Boa'],
		['nota' => 0, 'descricao' => 'Muito boa']
	];

	public const camposFsPesoMedio = [
		['nota' => 4, 'descricao' => 'Precária'],
		['nota' => 3, 'descricao' => 'Sofrível'],
		['nota' => 2, 'descricao' => 'Boa aparentemente'],
		['nota' => 1, 'descricao' => 'Boa'],
		['nota' => 0, 'descricao' => 'Muito boa']
	];

	public const camposFsPesoBaixo = [
		['nota' => 3, 'descricao' => 'Precária'],
		['nota' => 2.25, 'descricao' => 'Sofrível'],
		['nota' => 1.5, 'descricao' => 'Boa aparentemente'],
		['nota' => 0.75, 'descricao' => 'Boa'],
		['nota' => 0, 'descricao' => 'Muito boa']
	];

	public const camposFcLargura = [
		['nota' => 10, 'descricao' => 'Muito larga (acima de 17 m)'],
		['nota' => 8, 'descricao' => 'Larga (14-17 m)'],
		['nota' => 6, 'descricao' => 'Média (10-14 m)'],
		['nota' => 4, 'descricao' => 'Estreita (7-10 m)'],
		['nota' => 2, 'descricao' => 'Muito estreita (abaixo de 7 m)']
	];

	public const camposFcCarga = [
		['nota' => 10, 'descricao' => 'Muito alta (maior que 30 toneladas)'],
		['nota' => 8, 'descricao' => 'Alta (25-30 toneladas)'],
		['nota' => 6, 'descricao' => 'Média (18-25 toneladas)'],
		['nota' => 4, 'descricao' => 'Baixa (13-18 toneladas)'],
		['nota' => 2, 'descricao' => 'Muito baixa (menor que 13 toneladas)']
	];

	public const camposFcSuperficie = [
		['nota' => 10, 'descricao' => 'Nota 1'],
		['nota' => 8, 'descricao' => 'Nota 2'],
		['nota' => 6, 'descricao' => 'Nota 3'],
		['nota' => 4, 'descricao' => 'Nota 4'],
		['nota' => 2, 'descricao' => 'Nota 5']
	];

	public const camposFcPistaRolamento = [
		['nota' => 5, 'descricao' => 'Está em pior estado que as pistas de acesso à ponte'],
		['nota' => 3, 'descricao' => 'Está no mesmo estado que as pistas de acesso à ponte'],
		['nota' => 1, 'descricao' => 'Está em melhor estado que as pistas de acesso à ponte']
	];

	public const camposFcOutros = [
		['nota' => 5, 'descricao' => 'Vida útil remanescente baixa'],
		['nota' => 3, 'descricao' => 'Vida útil remanescente média'],
		['nota' => 1, 'descricao' => 'Vida útil remanescente alta']
	];

	public const camposFiEspacoLivre = [
		['nota' => 5, 'descricao' => 'Frequentemente inviabiliza a passagem de navios'],
		['nota' => 3, 'descricao' => 'Inviabiliza a passagem de navios algumas vezes'],
		['nota' => 1, 'descricao' => 'Não inviabiliza a passagem de navios'],
	];

	public const camposFiLocal = [
		['nota' => 3, 'descricao' => 'Centro urbano'],
		['nota' => 2.4, 'descricao' => 'Rodovia Federal'],
		['nota' => 1.8, 'descricao' => 'Rodovia Estadual'],
		['nota' => 1.2, 'descricao' => 'Área urbana municipal'],
		['nota' => 0.6, 'descricao' => 'Área rural municipal']
	];

	public const camposFiSaude = [
		['nota' => 1, 'descricao' => 'Nota 1'],
		['nota' => 0.8, 'descricao' => 'Nota 2'],
		['nota' => 0.6, 'descricao' => 'Nota 3'],
		['nota' => 0.4, 'descricao' => 'Nota 4'],
		['nota' => 0.2, 'descricao' => 'Nota 5']
	];

	public const camposFiOutros = [
		['nota' => 1, 'descricao' => 'Alto impacto em terceiros'],
		['nota' => 0.6, 'descricao' => 'Impacto moderado em terceiros'],
		['nota' => 0.2, 'descricao' => 'Baixo impacto em terceiros']
	];

	public const tipos = [
		'cadastral' => 'Cadastral',
		'rotineira' => 'Rotineira',
		'especial' => 'Especial',
		'extraordinaria' => 'Extraordinária'
	];
}