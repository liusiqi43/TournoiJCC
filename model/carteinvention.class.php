<?php
//carte.class.php
require_once 'db.class.php';
require_once 'carte.class.php'; 

class CarteInvention extends carte {

	public $potentielAttaque;
	public $potentielDefense;
	public $coutRessource;

	//Constructor is called whenever a new object is created.
	//Takes an associative array with the DB row as an argument.
	function __construct($data) {
		parent::__construct($data);
		$this->potentielAttaque = (isset($data['potentielAttaque'])) ? $data['potentielAttaque'] : "";
		$this->potentielDefense = (isset($data['potentielDefense'])) ? $data['potentielDefense'] : "";
		$this->coutRessource = (isset($data['coutRessource'])) ? $data['coutRessource'] : "";
	}

	public function save($isNewCard = false) {

		$db = new DB();
		
		//if the user is already registered and we're
		//just updating their info.
		if(!$isNewCard) {
			//set the data array
			$data = array(
				"potentielAttaque" => "'$this->potentielAttaque'",
				"potentielDefense" => "'$this->potentielDefense'",
				"coutRessource" => "'$this->coutRessource'"
			);
			
			//update the row in the database
			$db->exec_sql('UPDATE tcartesinvention set potentielAttaque='.$this->potentielAttaque.', potentielDefense='.$this->potentielDefense.', coutRessource='.$this->coutRessource.' where nom ='.$this->nom.';');
		} else {
		//if the user is being registered for the first time.
			$db->exec_sql('INSERT INTO tcartesinvention VALUES('.$this->nom.', '.$this->potentielAttaque.','.$this->potentielDefense.', '.$this->coutRessource.');');
		}
		return true;
	}
	
}

?>