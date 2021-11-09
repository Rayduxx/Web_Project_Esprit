<?php

class offres {
	private int $id_o;
	private string $description_o;
	private int $date_o;
	private int $lieu_o;
	 
	
	public __construct ($ID, $desc_o, $date_o, $lieu_o) {
		$this->id_o = $ID;
		$this->description_o = $desc_o;
		$this->date_o = $date_o;
		$this->lieu_o = $lieu_o;
		 
	}
	
	public function getId() {
		return $this->id_o;
	}
	public function getDescription () {
		return $this->description_o;
	}
	public function getDate() {
		return $this->date_o;
	}
	public function getLieu() {
		return $this->lieu_o;
	}
	 
	
}
?>
