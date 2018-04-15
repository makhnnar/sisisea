<?php

require_once 'signals.php';
require_once 'utils.php';

class EvalSignals{

	private $sig;
	private $utl;

	function __construct(){
		$this->sig = new BasicSignals();
		$this->utl = new Utils();
	}

	public function EvalSeno($t_ini,$t_fin,$frec,$amp){


		//$muestras = ($n_mue*$frec)*$tiempo;
		
		$muestras = $this->utl->calcMuesEsp($t_ini, $t_fin, $frec);

		//$espacios = 1/($n_mue*$frec)*$tiempo;

		$espacios = ($t_fin-$t_ini)/$muestras;

		$acum = $t_ini;

		$ref_x = $this->utl->calcEtq($muestras);
		$val_inc = $this->utl->valEtqSum($t_ini,$t_fin);
		$veces = 0;
		for($i=0;$i<$muestras;$i++){
			$enviar[$i]['x'] = $acum;
			$enviar[$i]['y'] = $amp*$this->sig->Seno($frec,$acum);
			//;$amp*sin($frec_ang*$acum);
			if($i == $ref_x*$veces){
				$etiquetas [$i] = (float)$t_ini+$val_inc*(float)$veces;
				$veces++;
			}else{
				$etiquetas [$i] = "";
			}
			$acum = $acum + $espacios;
		}

		$datos['valores'] = $enviar;
		$datos['etiquetas'] = $etiquetas;
		$datos['tipo'] = $amp.'*sen(2*pi*'.$frec.'*t)';
		return $datos;
	}

	public function EvalCoseno($t_ini,$t_fin,$frec,$amp){

		//$muestras = ($n_mue*$frec)*$tiempo;
		
		$muestras = $this->utl->calcMuesEsp($t_ini, $t_fin, $frec);

		//$espacios = 1/($n_mue*$frec)*$tiempo;

		$espacios = ($t_fin-$t_ini)/$muestras;
		$acum = $t_ini;
		$ref_x = $this->utl->calcEtq($muestras);
		$val_inc = $this->utl->valEtqSum($t_ini,$t_fin);
		$veces = 0;
		for($i=0;$i<$muestras;$i++){
			$enviar[$i]['x'] = $acum;
			$enviar[$i]['y'] = $amp*$this->sig->Coseno($frec,$acum);
			//$amp*cos($frec_ang*$acum);
			if($i == $ref_x*$veces){
				$etiquetas [$i] = (float)$t_ini+$val_inc*(float)$veces;
				$veces++;
			}else{
				$etiquetas [$i] = "";
			}
			$acum = $acum + $espacios;
		}

		$datos['valores'] = $enviar;
		$datos['etiquetas'] = $etiquetas;
		$datos['tipo'] = $amp.'*cos(2*pi*'.$frec.'*t)';
		return $datos;	
	}

	public function EvalTriangular($t_ini,$t_fin,$frec,$amp){

		//$muestras = ($n_mue*$frec)*$tiempo;
		
		$muestras = $this->utl->calcMuesEsp($t_ini, $t_fin, $frec);

		//$espacios = 1/($n_mue*$frec)*$tiempo;

		$espacios = ($t_fin-$t_ini)/$muestras;
		
		$acum = $t_ini;

		$ref_x = $this->utl->calcEtq($muestras);
		$val_inc = $this->utl->valEtqSum($t_ini,$t_fin);
		$veces = 0;
		for($i=0;$i<$muestras;$i++){
			$enviar[$i]['x'] = $acum;
			$enviar[$i]['y'] = $amp*$this->sig->Triangular($frec,$acum);
			//((2*$amp)/pi())*asin(sin($frec_ang*$acum));
			if($i == $ref_x*$veces){
				$etiquetas [$i] = (float)$t_ini+$val_inc*(float)$veces;
				$veces++;
			}else{
				$etiquetas [$i] = "";
			}
			$acum = $acum + $espacios;
		}

		$datos['valores'] = $enviar;
		$datos['etiquetas'] = $etiquetas;
		$datos['tipo'] = '2*'.$amp.'/pi*arcsen(sen(2*pi*'.$frec.'*t))';
		return $datos;
	}

	public function EvalSierra($t_ini,$t_fin,$frec,$amp){

		//$muestras = ($n_mue*$frec)*$tiempo;
		
		$muestras = $this->utl->calcMuesEsp($t_ini, $t_fin, $frec);

		//$espacios = 1/($n_mue*$frec)*$tiempo;

		$espacios = ($t_fin-$t_ini)/$muestras;

		$acum = $t_ini;
		$ref_x = $this->utl->calcEtq($muestras);
		$val_inc = $this->utl->valEtqSum($t_ini,$t_fin);
		$veces = 0;
		for($i=0;$i<$muestras;$i++){
			$enviar[$i]['x'] = $acum;
			$enviar[$i]['y'] = $amp*$this->sig->Sierra($frec,$acum);
			//(-(2*$amp)/pi())*atan(cos($frec_ang*$acum)/sin($frec_ang*$acum));
			if($i == $ref_x*$veces){
				$etiquetas [$i] = (float)$t_ini+$val_inc*(float)$veces;
				$veces++;
			}else{
				$etiquetas [$i] = "";
			}
			$acum = $acum + $espacios;
		}

		$datos['valores'] = $enviar;
		$datos['etiquetas'] = $etiquetas;
		$datos['tipo'] = '-2*'.$amp.'/pi*arctan(cot(2*pi'.$frec.'*t))';
		return $datos;
	}
}
?>