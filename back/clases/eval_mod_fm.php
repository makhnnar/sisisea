<?php

require_once 'signals.php';
require_once 'mods_modulacion_fm.php';
require_once 'utils.php';

class EvalModFm{

	private $mods_mod;
	private $utl;

	function __construct(){
		$this->mods_mod = new  ModsModulacionFM();
		$this->utl = new Utils();
	}

	public function EvalSenSenModFrec($t_ini,$t_fin,$frecC,$frecM,$ampC,$ind_mod){

		//$muestras = ($n_mue*$frec)*$tiempo;
		
		$muestras = $this->utl->calcMuesEsp($t_ini, $t_fin, $frecC);

		//$espacios = 1/($n_mue*$frec)*$tiempo;

		$espacios = ($t_fin-$t_ini)/$muestras;

		$acum = $t_ini;

		$ref_x = $this->utl->calcEtq($muestras);
		$val_inc = $this->utl->valEtqSum($t_ini,$t_fin);
		$veces = 0;
		for($i=0;$i<$muestras;$i++){
			$enviar[$i]['x'] = $acum;
			$enviar[$i]['y'] = $this->mods_mod->modSenSenFrec($ampC,$frecC,$frecM,$acum,$ind_mod);
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
		$datos['tipo'] = $ampC.'*sen(2*pi*'.$frecC.'*t)';
		return $datos;
	}

	public function EvalSenCosModFrec($t_ini,$t_fin,$frecC,$frecM,$ampC,$ind_mod){

		//$muestras = ($n_mue*$frec)*$tiempo;
		
		$muestras = $this->utl->calcMuesEsp($t_ini, $t_fin, $frecC);

		//$espacios = 1/($n_mue*$frec)*$tiempo;

		$espacios = ($t_fin-$t_ini)/$muestras;
		$acum = $t_ini;
		$ref_x = $this->utl->calcEtq($muestras);
		$val_inc = $this->utl->valEtqSum($t_ini,$t_fin);
		$veces = 0;
		for($i=0;$i<$muestras;$i++){
			$enviar[$i]['x'] = $acum;
			$enviar[$i]['y'] = $this->mods_mod->modSenCosFrec($ampC,$frecC,$frecM,$acum,$ind_mod);
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
		$datos['tipo'] = $ampC.'*cos(2*pi*'.$frecC.'*t)';
		return $datos;	
	}

	public function EvalSenTriangModFrec($t_ini,$t_fin,$frecC,$frecM,$ampC,$ind_mod){

		//$muestras = ($n_mue*$frec)*$tiempo;
		
		$muestras = $this->utl->calcMuesEsp($t_ini, $t_fin, $frecC);

		//$espacios = 1/($n_mue*$frec)*$tiempo;

		$espacios = ($t_fin-$t_ini)/$muestras;
		
		$acum = $t_ini;

		$ref_x = $this->utl->calcEtq($muestras);
		$val_inc = $this->utl->valEtqSum($t_ini,$t_fin);
		$veces = 0;
		for($i=0;$i<$muestras;$i++){
			$enviar[$i]['x'] = $acum;
			$enviar[$i]['y'] = $this->mods_mod->modSenTriangFrec($ampC,$frecC,$frecM,$acum,$ind_mod);
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
		$datos['tipo'] = '2*'.$ampC.'/pi*arcsen(sen(2*pi*'.$frecC.'*t))';
		//print print_r($datos['valores']);
		return $datos;
	}

	public function EvalSenSierraModFrec($t_ini,$t_fin,$frecC,$frecM,$ampC,$ind_mod){

		//$muestras = ($n_mue*$frec)*$tiempo;
		
		$muestras = $this->utl->calcMuesEsp($t_ini, $t_fin, $frecC);

		//$espacios = 1/($n_mue*$frec)*$tiempo;

		$espacios = ($t_fin-$t_ini)/$muestras;

		$acum = $t_ini;
		$ref_x = $this->utl->calcEtq($muestras);
		$val_inc = $this->utl->valEtqSum($t_ini,$t_fin);
		$veces = 0;
		for($i=0;$i<$muestras;$i++){
			$enviar[$i]['x'] = $acum;
			$enviar[$i]['y'] = $this->mods_mod->modSenSierraFrec($ampC,$frecC,$frecM,$acum,$ind_mod);
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
		$datos['tipo'] = '-2*'.$ampC.'/pi*arctan(cot(2*pi'.$frecC.'*t))';
		return $datos;
	}

	public function EvalCosCosModFrec($t_ini,$t_fin,$frecC,$frecM,$ampC,$ind_mod){

		//$muestras = ($n_mue*$frec)*$tiempo;
		
		$muestras = $this->utl->calcMuesEsp($t_ini, $t_fin, $frecC);

		//$espacios = 1/($n_mue*$frec)*$tiempo;

		$espacios = ($t_fin-$t_ini)/$muestras;

		$acum = $t_ini;

		$ref_x = $this->utl->calcEtq($muestras);
		$val_inc = $this->utl->valEtqSum($t_ini,$t_fin);
		$veces = 0;
		for($i=0;$i<$muestras;$i++){
			$enviar[$i]['x'] = $acum;
			$enviar[$i]['y'] = $this->mods_mod->modCosCosFrec($ampC,$frecC,$frecM,$acum,$ind_mod);
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
		$datos['tipo'] = $ampC.'*sen(2*pi*'.$frecC.'*t)';
		return $datos;
	}

	public function EvalCosSenModFrec($t_ini,$t_fin,$frecC,$frecM,$ampC,$ind_mod){

		//$muestras = ($n_mue*$frec)*$tiempo;
		
		$muestras = $this->utl->calcMuesEsp($t_ini, $t_fin, $frecC);

		//$espacios = 1/($n_mue*$frec)*$tiempo;

		$espacios = ($t_fin-$t_ini)/$muestras;
		$acum = $t_ini;
		$ref_x = $this->utl->calcEtq($muestras);
		$val_inc = $this->utl->valEtqSum($t_ini,$t_fin);
		$veces = 0;
		for($i=0;$i<$muestras;$i++){
			$enviar[$i]['x'] = $acum;
			$enviar[$i]['y'] = $this->mods_mod->modCosSenFrec($ampC,$frecC,$frecM,$acum,$ind_mod);
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
		$datos['tipo'] = $ampC.'*cos(2*pi*'.$frecC.'*t)';
		return $datos;	
	}

	public function EvalCosTriangModFrec($t_ini,$t_fin,$frecC,$frecM,$ampC,$ind_mod){

		//$muestras = ($n_mue*$frec)*$tiempo;
		
		$muestras = $this->utl->calcMuesEsp($t_ini, $t_fin, $frecC);

		//$espacios = 1/($n_mue*$frec)*$tiempo;

		$espacios = ($t_fin-$t_ini)/$muestras;
		
		$acum = $t_ini;

		$ref_x = $this->utl->calcEtq($muestras);
		$val_inc = $this->utl->valEtqSum($t_ini,$t_fin);
		$veces = 0;
		for($i=0;$i<$muestras;$i++){
			$enviar[$i]['x'] = $acum;
			$enviar[$i]['y'] = $this->mods_mod->modCosTriangFrec($ampC,$frecC,$frecM,$acum,$ind_mod);
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
		$datos['tipo'] = '2*'.$ampC.'/pi*arcsen(sen(2*pi*'.$frecC.'*t))';
		return $datos;
	}

	public function EvalCosSierraModFrec($t_ini,$t_fin,$frecC,$frecM,$ampC,$ind_mod){

		//$muestras = ($n_mue*$frec)*$tiempo;
		
		$muestras = $this->utl->calcMuesEsp($t_ini, $t_fin, $frecC);

		//$espacios = 1/($n_mue*$frec)*$tiempo;

		$espacios = ($t_fin-$t_ini)/$muestras;

		$acum = $t_ini;
		$ref_x = $this->utl->calcEtq($muestras);
		$val_inc = $this->utl->valEtqSum($t_ini,$t_fin);
		$veces = 0;
		for($i=0;$i<$muestras;$i++){
			$enviar[$i]['x'] = $acum;
			$enviar[$i]['y'] = $this->mods_mod->modCosSierraFrec($ampC,$frecC,$frecM,$acum,$ind_mod);
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
		$datos['tipo'] = '-2*'.$ampC.'/pi*arctan(cot(2*pi'.$frecC.'*t))';
		return $datos;
	}

	public function EvalTriangTriangModFrec($t_ini,$t_fin,$frecC,$frecM,$ampC,$ind_mod){

		//$muestras = ($n_mue*$frec)*$tiempo;
		
		$muestras = $this->utl->calcMuesEsp($t_ini, $t_fin, $frecC);

		//$espacios = 1/($n_mue*$frec)*$tiempo;

		$espacios = ($t_fin-$t_ini)/$muestras;

		$acum = $t_ini;

		$ref_x = $this->utl->calcEtq($muestras);
		$val_inc = $this->utl->valEtqSum($t_ini,$t_fin);
		$veces = 0;
		for($i=0;$i<$muestras;$i++){
			$enviar[$i]['x'] = $acum;
			$enviar[$i]['y'] = $this->mods_mod->modTriangTriangFrec($ampC,$frecC,$frecM,$acum,$ind_mod);
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
		$datos['tipo'] = $ampC.'*sen(2*pi*'.$frecC.'*t)';
		return $datos;
	}

	public function EvalTriangSenModFrec($t_ini,$t_fin,$frecC,$frecM,$ampC,$ind_mod){

		//$muestras = ($n_mue*$frec)*$tiempo;
		
		$muestras = $this->utl->calcMuesEsp($t_ini, $t_fin, $frecC);

		//$espacios = 1/($n_mue*$frec)*$tiempo;

		$espacios = ($t_fin-$t_ini)/$muestras;
		$acum = $t_ini;
		$ref_x = $this->utl->calcEtq($muestras);
		$val_inc = $this->utl->valEtqSum($t_ini,$t_fin);
		$veces = 0;
		for($i=0;$i<$muestras;$i++){
			$enviar[$i]['x'] = $acum;
			$enviar[$i]['y'] = $this->mods_mod->modTriangSenFrec($ampC,$frecC,$frecM,$acum,$ind_mod);
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
		$datos['tipo'] = $ampC.'*cos(2*pi*'.$frecC.'*t)';
		return $datos;	
	}

	public function EvalTriangCosModFrec($t_ini,$t_fin,$frecC,$frecM,$ampC,$ind_mod){

		//$muestras = ($n_mue*$frec)*$tiempo;
		
		$muestras = $this->utl->calcMuesEsp($t_ini, $t_fin, $frecC);

		//$espacios = 1/($n_mue*$frec)*$tiempo;

		$espacios = ($t_fin-$t_ini)/$muestras;
		
		$acum = $t_ini;

		$ref_x = $this->utl->calcEtq($muestras);
		$val_inc = $this->utl->valEtqSum($t_ini,$t_fin);
		$veces = 0;
		for($i=0;$i<$muestras;$i++){
			$enviar[$i]['x'] = $acum;
			$enviar[$i]['y'] = $this->mods_mod->modTriangCosFrec($ampC,$frecC,$frecM,$acum,$ind_mod);
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
		$datos['tipo'] = '2*'.$ampC.'/pi*arcsen(sen(2*pi*'.$frecC.'*t))';
		return $datos;
	}

	public function EvalTriangSierraModFrec($t_ini,$t_fin,$frecC,$frecM,$ampC,$ind_mod){

		//$muestras = ($n_mue*$frec)*$tiempo;
		
		$muestras = $this->utl->calcMuesEsp($t_ini, $t_fin, $frecC);

		//$espacios = 1/($n_mue*$frec)*$tiempo;

		$espacios = ($t_fin-$t_ini)/$muestras;

		$acum = $t_ini;
		$ref_x = $this->utl->calcEtq($muestras);
		$val_inc = $this->utl->valEtqSum($t_ini,$t_fin);
		$veces = 0;
		for($i=0;$i<$muestras;$i++){
			$enviar[$i]['x'] = $acum;
			$enviar[$i]['y'] = $this->mods_mod->modTriangSierraFrec($ampC,$frecC,$frecM,$acum,$ind_mod);
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
		$datos['tipo'] = '-2*'.$ampC.'/pi*arctan(cot(2*pi'.$frecC.'*t))';
		return $datos;
	}

	public function EvalSierraSierraModFrec($t_ini,$t_fin,$frecC,$frecM,$ampC,$ind_mod){

		//$muestras = ($n_mue*$frec)*$tiempo;
		
		$muestras = $this->utl->calcMuesEsp($t_ini, $t_fin, $frecC);

		//$espacios = 1/($n_mue*$frec)*$tiempo;

		$espacios = ($t_fin-$t_ini)/$muestras;

		$acum = $t_ini;

		$ref_x = $this->utl->calcEtq($muestras);
		$val_inc = $this->utl->valEtqSum($t_ini,$t_fin);
		$veces = 0;
		for($i=0;$i<$muestras;$i++){
			$enviar[$i]['x'] = $acum;
			$enviar[$i]['y'] = $this->mods_mod->modSierraSierraFrec($ampC,$frecC,$frecM,$acum,$ind_mod);
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
		$datos['tipo'] = $ampC.'*sen(2*pi*'.$frecC.'*t)';
		return $datos;
	}

	public function EvalSierraSenModFrec($t_ini,$t_fin,$frecC,$frecM,$ampC,$ind_mod){

		//$muestras = ($n_mue*$frec)*$tiempo;
		
		$muestras = $this->utl->calcMuesEsp($t_ini, $t_fin, $frecC);

		//$espacios = 1/($n_mue*$frec)*$tiempo;

		$espacios = ($t_fin-$t_ini)/$muestras;
		$acum = $t_ini;
		$ref_x = $this->utl->calcEtq($muestras);
		$val_inc = $this->utl->valEtqSum($t_ini,$t_fin);
		$veces = 0;
		for($i=0;$i<$muestras;$i++){
			$enviar[$i]['x'] = $acum;
			$enviar[$i]['y'] = $this->mods_mod->modSierraSenFrec($ampC,$frecC,$frecM,$acum,$ind_mod);
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
		$datos['tipo'] = $ampC.'*cos(2*pi*'.$frecC.'*t)';
		return $datos;	
	}

	public function EvalSierraCosModFrec($t_ini,$t_fin,$frecC,$frecM,$ampC,$ind_mod){

		//$muestras = ($n_mue*$frec)*$tiempo;
		
		$muestras = $this->utl->calcMuesEsp($t_ini, $t_fin, $frecC);

		//$espacios = 1/($n_mue*$frec)*$tiempo;

		$espacios = ($t_fin-$t_ini)/$muestras;
		
		$acum = $t_ini;

		$ref_x = $this->utl->calcEtq($muestras);
		$val_inc = $this->utl->valEtqSum($t_ini,$t_fin);
		$veces = 0;
		for($i=0;$i<$muestras;$i++){
			$enviar[$i]['x'] = $acum;
			$enviar[$i]['y'] = $this->mods_mod->modSierraCosFrec($ampC,$frecC,$frecM,$acum,$ind_mod);
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
		$datos['tipo'] = '2*'.$ampC.'/pi*arcsen(sen(2*pi*'.$frecC.'*t))';
		return $datos;
	}

	public function EvalSierraTriangModFrec($t_ini,$t_fin,$frecC,$frecM,$ampC,$ind_mod){

		//$muestras = ($n_mue*$frec)*$tiempo;
		
		$muestras = $this->utl->calcMuesEsp($t_ini, $t_fin, $frecC);

		//$espacios = 1/($n_mue*$frec)*$tiempo;

		$espacios = ($t_fin-$t_ini)/$muestras;

		$acum = $t_ini;
		$ref_x = $this->utl->calcEtq($muestras);
		$val_inc = $this->utl->valEtqSum($t_ini,$t_fin);
		$veces = 0;
		for($i=0;$i<$muestras;$i++){
			$enviar[$i]['x'] = $acum;
			$enviar[$i]['y'] = $this->mods_mod->modSierraTriangFrec($ampC,$frecC,$frecM,$acum,$ind_mod);
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
		$datos['tipo'] = '-2*'.$ampC.'/pi*arctan(cot(2*pi'.$frecC.'*t))';
		return $datos;
	}
}
?>