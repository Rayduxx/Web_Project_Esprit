<?php

class Avis {
	private int $id;
	private int $id_user;
	private int $rate;
	private int $DateAvis;

	public function __construct ($ID , $idU, $Note, $DA){
		$this->id = $ID;
		$this->id_user = $idU;
		$this->rate = $Note;
		$this->DateAvis = $DA;
	}

	public function getIdAvis() {
		return $this->id;
	}
	public function getIdUserAvis () {
		return $this->id_user;
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
