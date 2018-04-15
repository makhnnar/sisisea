<?php


require_once '../clases/eval_signals.php';

error_reporting(0);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
	$sig = new EvalSignals();
	$opciones = file_get_contents("php://input");
	$opciones = json_decode($opciones,true);
	switch ($opciones['t_senal']) {
		case '1':
			print json_encode($sig->EvalSeno($opciones['t_inicial'],$opciones['t_final'],$opciones['frecuencia'],$opciones['amplitud']));
			break;

		case '2':
			print json_encode($sig->EvalCoseno($opciones['t_inicial'],$opciones['t_final'],$opciones['frecuencia'],$opciones['amplitud']));
			break;

		case '3':
			print json_encode($sig->EvalTriangular($opciones['t_inicial'],$opciones['t_final'],$opciones['frecuencia'],$opciones['amplitud']));
			break;

		case '4':
			print json_encode($sig->EvalSierra($opciones['t_inicial'],$opciones['t_final'],$opciones['frecuencia'],$opciones['amplitud']));
			break;
		default:
			print json_encode(array('mensaje' => 'HUBO UN PROBLEMA' ));
		break;

	}
	
}



?>