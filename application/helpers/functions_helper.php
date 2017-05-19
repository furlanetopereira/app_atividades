<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('Data2bd'))
{    
	function Data2bd($data,$hora=""){
		if($data==""){
			return $data;
		}
		$quebra_data = explode("/",$data);
		if(trim($hora)!=""){
			return $quebra_data[2]."-".$quebra_data[1]."-".$quebra_data[0]." ".$hora;
		}else{
			return $quebra_data[2]."-".$quebra_data[1]."-".$quebra_data[0];
		}
	}
}

if ( ! function_exists('Bd2data'))
{    
	function Bd2data($data_original){
		$data_original = trim($data_original);
		if( $data_original == "" ){
			return $data_original;	
		}
		if( $data_original == "0000-00-00" ){
			return "";	
		}


		if ( strlen($data_original) == 10){
			$ano = substr($data_original,0,4);
			$mes = substr($data_original,5,2);
			$dia = substr($data_original,8,2);
			$datBrasileiro = $dia. "/" .$mes."/" .$ano;
		}elseif ( strlen($data_original) == 6){
			$dia = substr($data_original,0,2);
			$mes = substr($data_original,2,2);
			$ano = substr($data_original,4,2);
			$datBrasileiro = $dia. "/" .$mes."/" .$ano;
		}else{
			$ano = substr($data_original,0,4);
			$mes = substr($data_original,5,2);
			$dia = substr($data_original,8,2);
			$hora = substr($data_original,11,2);
			$minuto = substr($data_original,14,2);
			$datBrasileiro = $dia. "/" .$mes."/" .$ano. " " .$hora. ":" .$minuto;
		}
		return $datBrasileiro;
	}
}