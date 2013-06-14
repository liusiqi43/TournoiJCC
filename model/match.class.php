<?php
//carte.class.php
require_once 'db.class.php';

class Match {

	public $annee_tournoi;
	public $horaire;
	public $jour;
	public $numeroTable;
	public $numeroSalle;
	public $victoire;
	public $j1;
	public $j2;
	public $key;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		$this->annee_tournoi = (isset($data['annee_tournoi'])) ? $data['annee_tournoi'] : "";
		$this->horaire = (isset($data['horaire'])) ? $data['horaire'] : "";
		$this->jour = (isset($data['jour'])) ? $data['jour'] : "";
		$this->numeroTable = (isset($data['numerotable'])) ? $data['numerotable'] : "";
		$this->numeroSalle = (isset($data['numerosalle'])) ? $data['numerosalle'] : "";
		$this->victoire = (isset($data['victoire'])) ? $data['victoire'] : "0";
		$this->j1 = (isset($data['j1'])) ? $data['j1'] : "";
		$this->j2 = (isset($data['j2'])) ? $data['j2'] : "";
		$this->key = (isset($data['key_column'])) ? $data['key_column'] : "";
	}


	public function save($isNewMatch = false) {

		$db = new DB();
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewMatch) {
			//set the data array
			$db->exec_sql("UPDATE tmatchs set victoire=$this->victoire, horaire='$this->horaire', jour='$this->jour', numerotable=$this->numeroTable, numerosalle=$this->numeroSalle, j1='$this->j1', j2='$this->j2' where key_column = $this->key;");
		} else {
		//if the user is being registered for the first time.
			$db->exec_sql("INSERT INTO tmatchs VALUES($this->annee_tournoi,'$this->horaire', '$this->jour', '$this->numeroTable', '$this->numeroSalle', '$this->victoire', '$this->j1', '$this->j2');");
		}
		return true;
	}
	
}

?>