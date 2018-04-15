<?php
include_once 'numphp/vendor/autoload.php';

$frec = 100;

$t_final = 0.05;

$t_inicio = 0;

$tiempo = $t_final - $t_inicio;

$frec_ang = 2*$frec*pi();

$muestras = (20*$frec)*$tiempo;

$espacios = 1/(20*$frec);

$amp = 4;

$acum = $t_inicio;

for($i=0;$i<$muestras;$i++){
	$enviar[$i]['x'] = $acum;
	$enviar[$i]['y'] = ((2*$amp)/pi())*asin(sin($frec_ang*$acum));
	if(($i % 10) == 0){
		$etiquetas [$i] = $acum;
	}else{
		$etiquetas [$i] = " ";
	}
	$acum = $acum + $espacios;
}

$datos['valores'] = $enviar;
$datos['etiquetas'] = $etiquetas;
$datos['tipo'] = '2*'.$amp.'/pi*arcsen(sen(2*pi*'.$frec.'*t))';

print json_encode($datos);

?>