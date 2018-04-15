<?php

//include_once '../back/numphp/vendor/autoload.php';
require_once '/var/www/html/LAUTCOM/back/clases/mods_modulacion_fm.php';

$puntos = 40;

$frec = 400;

$frec1 = 100;

$t_final = 0.020;

$t_inicio = 0;

$tiempo = $t_final - $t_inicio;

$frec_ang = 2*$frec*pi();

$muestras = ($puntos*$frec)*$tiempo;

$espacios = 1/(20*$frec);

$amp = 4;

$acum = $t_inicio;

$senal = new ModsModulacionFM();
$ind_mod = 3;

for($i=0;$i<$muestras;$i++){
	$enviar[$i]['x'] = $acum;
	$enviar[$i]['y'] = $senal->modSenSenFrec($amp,$frec,$frec1,$acum,$ind_mod);
	//$enviar[$i]['y'] = $amp*sin($frec_ang*$acum);
	if(($i % 10) == 0){
		$etiquetas [$i] = $acum;
	}else{
		$etiquetas [$i] = " ";
	}
	$acum = $acum + $espacios;
}

$datos['valores'] = $enviar;
$datos['etiquetas'] = $etiquetas;
$datos['tipo'] = $amp.'*sen(2*pi*'.$frec.'*t)';

print json_encode($datos);

?>