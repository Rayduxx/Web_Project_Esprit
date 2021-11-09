<?php

class promotions {
	private int $id_p;
	private string $description_p;
	private int $date_p;
	private int $lieu_p;
	 
	
	public __construct ($ID, $desc_p, $date_p, $lieu_p) {
		$this->id_p = $ID;
		$this->description_p = $desc_o;
		$this->date_p = $date_p;
		$this->lieu_p = $lieu_p;
		 
	}
	
	public function getId() {
		return $this->id_p;
	}
	public function getDescription () {
		return $this->description_p;
	}
	public function getDate() {
		return $this->date_p;
	}
	public function getLieu() {
		return $this->lieu_p;
	}
	 
	
}
?>
 

















