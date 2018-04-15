<?php

/**
* 
*/
class BasicSignals{
	
	function __construct(){
		
	}

	public function Seno($frec,$t){
		return sin(2*$frec*pi()*$t);
	}

	public function Coseno($frec,$t){
		return cos(2*$frec*pi()*$t);
	}

	public function Triangular($frec,$t){
		return ((2)/pi())*asin(sin(2*$frec*pi()*$t));
	}

	public function Sierra($frec,$t){
		return (-(2)/pi())*atan(cos(2*$frec*pi()*$t)/sin(2*$frec*pi()*$t));
	}

	//exp es ecpresion a evaluar
	public function SenoMod($amp,$frec,$t,$exp){
		return $amp*sin(2*$frec*pi()*$t+$exp);
	}

	public function CosenoMod($amp,$frec,$t,$exp){
		return $amp*cos(2*$frec*pi()*$t+$exp);
	}

	public function TriangMod($amp,$frec,$t,$exp){
		return ((2*$amp)/pi())*asin(sin(2*$frec*pi()*$t+$exp));
	}

	public function SierraMod($amp,$frec,$t,$exp){
		return (-(2*$amp)/pi())*atan(cos(2*$frec*pi()*$t+$exp)/sin(2*$frec*pi()*$t+$exp));
	}

	public function IntgSeno($frec,$t){
		return (-1)*cos(2*$frec*pi()*$t);
	}

	public function IntgCoseno($frec,$t){
		return sin(2*$frec*pi()*$t);
	}

	public function IntgTriangular($frec,$t){
		$WC = 2*$frec*pi();
		$secante = (1/cos($WC*$t));
		if($secante<0){
			$secante = 0;
		}
		$devol = (((2)/pi()) * ( ($WC*asin(sin($WC*$t))) - ( (($WC*$WC)/2) *$t*sqrt(pow(cos($WC*$t),2)*$secante) ) ));
		//print " \n ".$devol;
		return $devol;
	}

	public function IntgSierra($frec,$t){
		return (-(2)/pi())*(pi()*$frec*($t*$t)+$t*atan(cos(2*$frec*pi()*$t)/sin(2*$frec*pi()*$t)));
	}  

}

?>