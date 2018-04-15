<?php
/**
* 
*/
class Utils{
	
	function __construct(){
	}

	public function calcMuesEsp($t_ini,$t_fin,$frec){
		return (($t_fin-$t_ini)*$frec)*100;
	}

	public function valEtqSum($t_ini,$t_fin){
		return (($t_fin-$t_ini)*(0.20));
	}

	public function calcEtq($muestras){
		/*if(($muestras%20)!=0){
			$muestras = $muestras - ($muestras%20);
		}*/
		return $muestras*0.20;
	}
}
?>