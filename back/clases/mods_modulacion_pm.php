<?php

require_once 'signals.php';

/**
* 
*/
class ModsModulacionPM{
	
	private $sig;

	function __construct(){
		$this->sig = new BasicSignals();
	}

	public function modSenSenFase($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->SenoMod($ampC,$frecC,$t,(-1)*$ind_mod*$this->sig->Seno($frecM,$t));
	}

	public function modSenCosFase($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->SenoMod($ampC,$frecC,$t,$ind_mod*$this->sig->Coseno($frecM,$t));
	}

	public function modSenTriangFase($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->SenoMod($ampC,$frecC,$t,$ind_mod*$this->sig->Triangular($frecM,$t));
	}

	public function modSenSierraFase($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->SenoMod($ampC,$frecC,$t,$ind_mod*$this->sig->Sierra($frecM,$t));
	}

	public function modCosCosFase($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->CosMod($ampC,$frecC,$t,$ind_mod*$this->sig->Coseno($frecM,$t));
	}

	public function modCosSenFase($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->CosMod($ampC,$frecC,$t,$ind_mod*$this->sig->Seno($frecM,$t));
	}

	public function modCosTriangFase($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->CosMod($ampC,$frecC,$t,$ind_mod*$this->sig->Triangular($frecM,$t));
	}

	public function modCosSierraFase($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->CosMod($ampC,$frecC,$t,$ind_mod*$this->sig->Sierra($frecM,$t));
	}

	public function modTriangTriangFase($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->TriangMod($ampC,$frecC,$t,$ind_mod*$this->sig->Triangular($frecM,$t));
	}

	public function modTriangSenFase($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->TriangMod($ampC,$frecC,$t,$ind_mod*$this->sig->Seno($frecM,$t));
	}

	public function modTriangCosFase($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->TriangMod($ampC,$frecC,$t,$ind_mod*$this->sig->Coseno($frecM,$t));
	}

	public function modTriangSierraFase($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->TriangMod($ampC,$frecC,$t,$ind_mod*$this->sig->Sierra($frecM,$t));
	}

	public function modSierraSierraFase($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->SierraMod($ampC,$frecC,$t,$ind_mod*$this->sig->Sierra($frecM,$t));
	}

	public function modSierraSenFase($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->SierraMod($ampC,$frecC,$t,$ind_mod*$this->sig->Seno($frecM,$t));
	}

	public function modSierraCosFase($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->SierraMod($ampC,$frecC,$t,$ind_mod*$this->sig->Coseno($frecM,$t));
	}

	public function modSierraTriangFase($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->SierraMod($ampC,$frecC,$t,$ind_mod*$this->sig->Triang($frecM,$t));
	}
}
?>