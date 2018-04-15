<?php 
require_once '../clases/signals.php';
require_once '../clases/eval_mod_fm.php';

error_reporting(0);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
	$sig = new EvalModFm();
	$opciones = file_get_contents("php://input");
	$opciones = json_decode($opciones,true);
	switch ($opciones['t_signal_por']) {
		case '1':
			switch ($opciones['t_signal_mod']) {
				case '1':
					print json_encode($sig->EvalSenSenModFrec($opciones['t_inicial'],$opciones['t_final'],$opciones['frecC'],$opciones['frecM'],$opciones['ampC'],$opciones['ind_mod']));
				break;

				case '2':
					print json_encode($sig->EvalSenCosModFrec($opciones['t_inicial'],$opciones['t_final'],$opciones['frecC'],$opciones['frecM'],$opciones['ampC'],$opciones['ind_mod']));
				break;

				case '3':
					print json_encode($sig->EvalSenTriangModFrec($opciones['t_inicial'],$opciones['t_final'],$opciones['frecC'],$opciones['frecM'],$opciones['ampC'],$opciones['ind_mod']));
				break;

				case '4':
					print json_encode($sig->EvalSenSierraModFrec($opciones['t_inicial'],$opciones['t_final'],$opciones['frecC'],$opciones['frecM'],$opciones['ampC'],$opciones['ind_mod']));
				break;
				default:
					print json_encode(array('mensaje' => 'HUBO UN PROBLEMA' ));
				break;

			}
			break;

		case '2':
			switch ($opciones['t_signal_mod']) {
				
				case '1':
					print json_encode($sig->EvalCosSenModFrec($opciones['t_inicial'],$opciones['t_final'],$opciones['frecC'],$opciones['frecM'],$opciones['ampC'],$opciones['ind_mod']));
				break;

				case '2':
					print json_encode($sig->EvalCosCosModFrec($opciones['t_inicial'],$opciones['t_final'],$opciones['frecC'],$opciones['frecM'],$opciones['ampC'],$opciones['ind_mod']));
				break;

				case '3':
					print json_encode($sig->EvalCosTriangModFrec($opciones['t_inicial'],$opciones['t_final'],$opciones['frecC'],$opciones['frecM'],$opciones['ampC'],$opciones['ind_mod']));
				break;

				case '4':
					print json_encode($sig->EvalCosSierraModFrec($opciones['t_inicial'],$opciones['t_final'],$opciones['frecC'],$opciones['frecM'],$opciones['ampC'],$opciones['ind_mod']));
				break;
				default:
					print json_encode(array('mensaje' => 'HUBO UN PROBLEMA' ));
				break;

			}
			break;

		case '3':
			switch ($opciones['t_signal_mod']) {
				
				case '1':
					print json_encode($sig->EvalTriangSenModFrec($opciones['t_inicial'],$opciones['t_final'],$opciones['frecC'],$opciones['frecM'],$opciones['ampC'],$opciones['ind_mod']));
				break;

				case '2':
					print json_encode($sig->EvalTriangCosModFrec($opciones['t_inicial'],$opciones['t_final'],$opciones['frecC'],$opciones['frecM'],$opciones['ampC'],$opciones['ind_mod']));
				break;

				case '3':
					print json_encode($sig->EvalTriangTriangModFrec($opciones['t_inicial'],$opciones['t_final'],$opciones['frecC'],$opciones['frecM'],$opciones['ampC'],$opciones['ind_mod']));
				break;

				case '4':
					print json_encode($sig->EvalTriangSierraModFrec($opciones['t_inicial'],$opciones['t_final'],$opciones['frecC'],$opciones['frecM'],$opciones['ampC'],$opciones['ind_mod']));
				break;
				default:
					print json_encode(array('mensaje' => 'HUBO UN PROBLEMA' ));
				break;

			}
			break;

		case '4':
			switch ($opciones['t_signal_mod']) {

				case '1':
					print json_encode($sig->EvalSierraSenModFrec($opciones['t_inicial'],$opciones['t_final'],$opciones['frecC'],$opciones['frecM'],$opciones['ampC'],$opciones['ind_mod']));
				break;

				case '2':
					print json_encode($sig->EvalSierraCosModFrec($opciones['t_inicial'],$opciones['t_final'],$opciones['frecC'],$opciones['frecM'],$opciones['ampC'],$opciones['ind_mod']));
				break;

				case '3':
					print json_encode($sig->EvalSierraTriangModFrec($opciones['t_inicial'],$opciones['t_final'],$opciones['frecC'],$opciones['frecM'],$opciones['ampC'],$opciones['ind_mod']));
				break;

				case '4':
					print json_encode($sig->EvalSierraSierraModFrec($opciones['t_inicial'],$opciones['t_final'],$opciones['frecC'],$opciones['frecM'],$opciones['ampC'],$opciones['ind_mod']));
				break;

				default:
					print json_encode(array('mensaje' => 'HUBO UN PROBLEMA' ));
				break;

			}
			break;
		default:
			print json_encode(array('mensaje' => 'HUBO UN PROBLEMA' ));
		break;

	}
	
}
?>