<?php

class Avis {
	private int $id;
	private int $idUser;
	private int $rate;
	private string $Opinion;
	private int $DateAvis;
	
	public __construct ($ID, $idU, $Note, $texte,$DA) {
		$this->id = $ID;
		$this->idUser = $idU;
		$this->rate = $Note;
		$this->Opinion = $texte;
		$this->DateAvis = $DA;
	}
	
	public function getIdAvis() {
		return $this->id;
	}
	public function getIdUserAvis () {
		return $this->idUser;
	}
	public function getRate() {
		return $this->rate;
	}
	public function getOpinion() {
		return $this->Opinion;
	}
	public function getDateAvis (){
		return $this->DateAvis;
	}
	
}

















?>