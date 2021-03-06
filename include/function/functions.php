<?php

function pr($var){
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}

/* Exibe a data formatada em dd/mm/yyyy */

function formatDate($data, $null = '--') {
	if($data == '0000-00-00'){
		$return = $null;
	}elseif($data <> ''){
	$dia = substr($data,8,2);
	$mes = substr($data,5,2);
	$ano = substr($data,0,4);
	$return = $dia.'/'.$mes.'/'.$ano;
	} else {
		$return = $null;
	}
	return $return; 
}

function merge($acumulador, $valor){
    $acumulador .= $valor.'¬';
    return $acumulador;
}

/* Inverte datas, e prepara para gravação no banco */

function inverte($string, $separador, $separadornew){
	$string = explode($separador, $string );
	$string  = array_reverse($string);
	$string  = array_reduce($string, "merge");
	$string = str_replace('¬',$separadornew,$string);
	$size = strlen($string);
	if($string[$size-1] == $separadornew)
	$string = substr($string,0,($size-1));
	return $string;
}

?>