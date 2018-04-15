<?php

require_once 'signals.php';
require_once 'mods_modulacion_pm.php';
require_once 'utils.php';

class EvalModPm{

	private $mods_mod;
	private $utl;

	function __construct(){
		$this->mods_mod = new  ModsModulacionPM();
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
			$enviar[$i]['y'] = $this->mods_mod->modSenSenFase($ampC,$frecC,$frecM,$acum,$ind_mod);
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
		$datos['tipo'] = $ampC.'*sen(2*pi*'.$frec.'*t)';
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
			$enviar[$i]['y'] = $this->mods_mod->modSenCosFase($ampC,$frecC,$frecM,$acum,$ind_mod);
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
		$datos['tipo'] = $ampC.'*cos(2*pi*'.$frec.'*t)';
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
			$enviar[$i]['y'] = $this->mods_mod->modSenTriangFase($ampC,$frecC,$frecM,$acum,$ind_mod);
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
		$datos['tipo'] = '2*'.$ampC.'/pi*arcsen(sen(2*pi*'.$frec.'*t))';
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
			$enviar[$i]['y'] = $this->mods_mod->modSenSierraFase($ampC,$frecC,$frecM,$acum,$ind_mod);
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
		$datos['tipo'] = '-2*'.$ampC.'/pi*arctan(cot(2*pi'.$frec.'*t))';
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
			$enviar[$i]['y'] = $this->mods_mod->modCosCosFase($ampC,$frecC,$frecM,$acum,$ind_mod);
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
			$enviar[$i]['y'] = $this->mods_mod->modCosSenFase($ampC,$frecC,$frecM,$acum,$ind_mod);
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
			$enviar[$i]['y'] = $this->mods_mod->modCosTriangFase($ampC,$frecC,$frecM,$acum,$ind_mod);
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
			$enviar[$i]['y'] = $this->mods_mod->modCosSierraFase($ampC,$frecC,$frecM,$acum,$ind_mod);
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
			$enviar[$i]['y'] = $this->mods_mod->modTriangTriangFase($ampC,$frecC,$frecM,$acum,$ind_mod);
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
			$enviar[$i]['y'] = $this->mods_mod->modTriangSenFase($ampC,$frecC,$frecM,$acum,$ind_mod);
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
			$enviar[$i]['y'] = $this->mods_mod->modTriangCosFase($ampC,$frecC,$frecM,$acum,$ind_mod);
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
			$enviar[$i]['y'] = $this->mods_mod->modTriangSierraFase($ampC,$frecC,$frecM,$acum,$ind_mod);
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
			$enviar[$i]['y'] = $this->mods_mod->modSierraSierraFase($ampC,$frecC,$frecM,$acum,$ind_mod);
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
			$enviar[$i]['y'] = $this->mods_mod->modSierraSenFase($ampC,$frecC,$frecM,$acum,$ind_mod);
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
			$enviar[$i]['y'] = $this->mods_mod->modSierraCosFase($ampC,$frecC,$frecM,$acum,$ind_mod);
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
			$enviar[$i]['y'] = $this->mods_mod->modSierraTriangFase($ampC,$frecC,$frecM,$acum,$ind_mod);
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