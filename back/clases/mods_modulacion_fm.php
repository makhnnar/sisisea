<?php

require_once 'signals.php';

/**
* 
*/
class ModsModulacionFM{
	
	private $sig;

	function __construct(){
		$this->sig = new BasicSignals();
	}

	public function modSenSenFrec($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->SenoMod($ampC,$frecC,$t,$ind_mod*$this->sig->IntgSeno($frecM,$t));
	}

	public function modSenCosFrec($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->SenoMod($ampC,$frecC,$t,$ind_mod*$this->sig->IntgCoseno($frecM,$t));
	}

	public function modSenTriangFrec($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->SenoMod($ampC,$frecC,$t,$ind_mod*$this->sig->IntgTriangular($frecM,$t));
	}

	public function modSenSierraFrec($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->SenoMod($ampC,$frecC,$t,$ind_mod*$this->sig->IntgSierra($frecM,$t));
	}

	public function modCosCosFrec($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->CosenoMod($ampC,$frecC,$t,$ind_mod*$this->sig->IntgCoseno($frecM,$t));
	}

	public function modCosSenFrec($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->CosenoMod($ampC,$frecC,$t,$ind_mod*$this->sig->Seno($frecM,$t));
	}

	public function modCosTriangFrec($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->CosenoMod($ampC,$frecC,$t,$ind_mod*$this->sig->IntgTriangular($frecM,$t));
	}

	public function modCosSierraFrec($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->CosenoMod($ampC,$frecC,$t,$ind_mod*$this->sig->IntgSierra($frecM,$t));
	}

	public function modTriangTriangFrec($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->TriangMod($ampC,$frecC,$t,$ind_mod*$this->sig->IntgTriangular($frecM,$t));
	}

	public function modTriangSenFrec($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->TriangMod($ampC,$frecC,$t,$ind_mod*$this->sig->IntgSeno($frecM,$t));
	}

	public function modTriangCosFrec($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->TriangMod($ampC,$frecC,$t,$ind_mod*$this->sig->IntgCoseno($frecM,$t));
	}

	public function modTriangSierraFrec($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->TriangMod($ampC,$frecC,$t,$ind_mod*$this->sig->IntgSierra($frecM,$t));
	}

	public function modSierraSierraFrec($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->SierraMod($ampC,$frecC,$t,$ind_mod*$this->sig->IntgSierra($frecM,$t));
	}

	public function modSierraSenFrec($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->SierraMod($ampC,$frecC,$t,$ind_mod*$this->sig->IntgSeno($frecM,$t));
	}

	public function modSierraCosFrec($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->SierraMod($ampC,$frecC,$t,$ind_mod*$this->sig->IntgCoseno($frecM,$t));
	}

	public function modSierraTriangFrec($ampC,$frecC,$frecM,$t,$ind_mod){
		return $this->sig->SierraMod($ampC,$frecC,$t,$ind_mod*$this->sig->IntgTriangular($frecM,$t));
	}
}

?>