<?php

namespace Utils;

class HtmlUtils
{
	public static function getLimitGrid($numeroPagina)
	{
		$maior = 10 * $numeroPagina;
		$menor = $maior - 10;

		return $menor . ', ' . $maior;
	}

	public static function renderSelect($idName, $opcoes, $label, $opcaoDisabled, $campoDescricao, $campoValue, $tamanho = 's12'){
		$html = "<div class='input-field col ".$tamanho."'>";
		$html .= "<select id='$idName' name='$idName'>";
		$html .= "<option value='' disabled selected>$opcaoDisabled</option>";
		foreach($opcoes as $opcao){
			$html .= '<option value='.$opcao[$campoValue].'>'.$opcao[$campoDescricao].'</option>';
		}
		$html .= "</select>";
		$html .= "<label>$label</label>";
		$html .= "</div>";

		return $html;
	}

	public static function renderImagens($imagens)
	{
		$html = '';
		foreach($imagens as $imagem){
			$html .= "<li><img class='materialboxed' src='assets/fotos/{$imagem['imagem']}'></li>";
		}

		return $html;
	}
}